<?php
require_once("../../../configuration/koneksi.php");
session_start();

// 🔹 Set zona waktu PHP ke WITA
date_default_timezone_set('Asia/Makassar');

// 🔹 Pastikan MySQL menggunakan zona waktu WITA
// $mysqli->query("SET time_zone = 'Asia/Makassar'");

$action = $_GET['action'] ?? ''; // Pastikan action tidak undefined

if ($action === 'tanggal') {
    $tanggal1 = $_POST['tanggalawal'] ?? '';
    $tanggal2 = $_POST['tanggalakhir'] ?? '';

    if (!empty($tanggal1) && !empty($tanggal2)) {
        $tanggal2 .= " 23:59:59";
        
        // 🔹 Tambahkan proteksi SQL Injection dengan prepared statement
        $sql = "SELECT p.nm_poli AS poli,
                    MONTH(r.tgl_registrasi) AS bulan,
                    COUNT(r.no_reg) AS jumlah
                FROM reg_periksa r 
                JOIN poliklinik p 
                ON r.kd_poli = p.kd_poli
                WHERE r.tgl_registrasi BETWEEN ? AND ?  
                AND r.status_lanjut = 'Ralan' 
                AND CAST(r.umurdaftar AS UNSIGNED) > 59 
                AND CAST(r.umurdaftar AS UNSIGNED) < 100
                GROUP BY p.nm_poli, bulan
                ORDER BY p.nm_poli, bulan";

        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss", $tanggal1, $tanggal2);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        die("Tanggal tidak boleh kosong!");
    }
} else {
    die("Aksi tidak valid!");
}

// Inisialisasi array
$tableData = [];
$totalPerBulan = array_fill(1, 12, 0);

// Proses hasil query
while ($row = $result->fetch_assoc()) {
    $poli = $row['poli'];
    $bulan = (int)$row['bulan'];
    $jumlah = (int)$row['jumlah'];

    // Inisialisasi array untuk poli jika belum ada
    if (!isset($tableData[$poli])) {
        $tableData[$poli] = array_fill(1, 12, 0);
    }

    // Simpan data kunjungan per bulan
    $tableData[$poli][$bulan] = $jumlah;
    $totalPerBulan[$bulan] += $jumlah;
}

// Konversi data untuk Chart.js
$datasets = [];
foreach ($tableData as $poli => $bulanData) {
    $datasets[] = [
        "label" => $poli,
        "data" => array_values($bulanData),
        "backgroundColor" => sprintf('rgba(%d, %d, %d, 0.6)', rand(50, 200), rand(50, 200), rand(50, 200))
    ];
}

// Encode data ke JSON untuk JavaScript
$jsonLabels = json_encode(range(1, 12));
$jsonDatasets = json_encode($datasets);
$jsonTotalPerBulan = json_encode(array_values($totalPerBulan));
?>

<html>

<head>
    <title>Laporan</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>RSPI-LTE 3 | Dashboard 2</title>
    <link rel="icon" href="../../../assets/img/icon.png">
    <style>
        table{margin:0 auto;border-collapse:collapse;background:#ffffff;}
        caption h3{}
        th{padding:7px 4px;background: #ffffff;}
        td{padding:4px 15px;}
        .inner-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
        }
        .inner-table th, .inner-table td {
            border: 1px solid black;
            padding: 5px;
        }
        /* Tombol Cetak */
        #printButton {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        #printButton:hover {
            background-color: #0056b3;
        }
        /* Sembunyikan tombol saat mencetak */
        @media print {
            #printButton {
                display: none;
            }
        }
    </style>

    <!-- Bagian modal -->
    
</head>

<body>
    <button id="printButton" onclick="printPage()">Cetak Halaman</button>
    <div>
        <table border='0'>
            <tr>
                <td align="center"><img src="../../../assets/img/logo.JPG" alt="..." width="150" height="150"></td>
                <td align="center" width="90%">
                    <h1>RUMAH SAKIT PELITA INSANI</h1>
                        <h3>Alamat : Jalan Sekumpul No. 66, Martapura, Kalimantan Selatan 70614 Telp. (0511) 4722210</h3>
                </td>
            </tr>
        </table>
        
        <hr>
        <h4 align="center">LAPORAN BULANAN KUNJUNGAN PASIEN <p>BERDASARKAN KATEGORI LANSIA</h4>
    </div>
    
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
              <div class="card-tools">
                  <a href="" data-toggle='modal' data-target='#proses' class="btn btn-tool btn-sm">
                    <i class="fas fa-print"></i>
                  </a>
                  <a href="#" class="btn btn-tool btn-sm" data-card-widget="collapse" style="background:rgba(69, 77, 85, 1)">
                        <i class="fas fa-bars"></i>
                  </a>
              </div>
          </div>
          <div class="card-body">
              <div class="table-responsive">
                <table class="inner-table">
                  <thead>
                    <tr>
                        <th rowspan="2" style="text-align: center; color: black; vertical-align: middle;">Nama Poli</th>
                        <th colspan="12" style="text-align: center; color: black;">Jumlah Pasien Per Bulan</th>
                        <th rowspan="2" style="text-align: center; color: black; vertical-align: middle;">Total</th>
                    </tr>
                    <tr>
                        <?php for ($i = 1; $i <= 12; $i++) { ?>
                            <th style="text-align: center; color: black;"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></th>
                        <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($tableData as $poli => $bulanData) { ?>
                    <tr>
                        <td align="left" style="color: black;"><?php echo $poli; ?></td>
                        <?php 
                        $total = 0;
                        foreach ($bulanData as $jumlah) { 
                            $total += $jumlah;
                        ?>
                            <td align="center" style="color: black;"><?php echo $jumlah; ?></td>
                        <?php } ?>
                        <td align="center" style="color: black; font-weight:bold;"><?php echo $total; ?></td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Grafik Kunjungan</h3>
          </div>
          <div class="card-body">
            <canvas id="barChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <br/><br/>
    <script src="../../../assets/dist/css/chart4.js"></script>
    <!-- Chart.js Library -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
    <script>
    function printPage() {
        window.print(); // Menjalankan perintah cetak
        }
      var ctx = document.getElementById("barChart").getContext("2d");
      var labels = <?php echo $jsonLabels; ?>;
      var datasets = <?php echo $jsonDatasets; ?>;
      var totalPerBulan = <?php echo $jsonTotalPerBulan; ?>;

      datasets.push({
        label: "Total Pasien",
        type: "line",
        data: totalPerBulan,
        borderColor: "rgba(255, 99, 132, 1)",
        backgroundColor: "rgba(255, 99, 132, 0.2)",
        borderWidth: 2,
        fill: false
      });

      new Chart(ctx, {
        type: "bar",
        data: { labels: labels, datasets: datasets },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          plugins: { legend: { position: "top" } },
          scales: {
            x: { title: { display: true, text: "Bulan" } },
            y: { title: { display: true, text: "Jumlah Pasien" } }
          }
        }
      });
    </script>
  </body>
  </html>