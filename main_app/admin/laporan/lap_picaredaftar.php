<?php
require_once("../../../configuration/koneksi.php");
ob_start();
session_start();

// 🔹 Set zona waktu PHP ke WITA
date_default_timezone_set('Asia/Makassar');

// 🔹 Pastikan MySQL menggunakan zona waktu WITA
$mysqli2->query("SET time_zone = 'Asia/Makassar'");


$action = $_GET['action'] ?? ''; // Pastikan action tidak undefined
$labels = [];
$jumlahPasien = [];

if ($action === 'tanggal') {
    $tanggal1 = $_POST['tanggalawal'] ?? '';
    $tanggal2 = $_POST['tanggalakhir'] ?? '';

    if (!empty($tanggal1) && !empty($tanggal2)) {
        $tanggal2 .= " 23:59:59";
        $stmt = $mysqli2->prepare("
            SELECT COUNT(*) AS jumlah, DATE(insert_at) AS tanggal
            FROM daftar_pasien 
            WHERE is_verified <> '1' 
            AND insert_at BETWEEN ? AND ? 
            GROUP BY tanggal
            ORDER BY tanggal ASC
        ");
        $stmt->bind_param("ss", $tanggal1, $tanggal2);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($row = $result->fetch_assoc()) {
            $labels[] = $row['tanggal'];
            $jumlahPasien[] = (int)$row['jumlah'];
        }
        $stmt->close();
    }
}

$mysqli2->close();

$totalPasien = !empty($jumlahPasien) ? array_sum($jumlahPasien) : 0;
$jumlahHari = count($jumlahPasien);
$rataRata = $jumlahHari > 0 ? number_format($totalPasien / $jumlahHari, 2) : 0;
$maxPasien = !empty($jumlahPasien) ? max($jumlahPasien) : 0;
$minPasien = !empty($jumlahPasien) ? min($jumlahPasien) : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSPI-LTE 3 | ADMIN IT 2</title>
    <link rel="icon" href="../../../../assets/img/mLITE.png">
    <link rel="stylesheet" href="../../../assets/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../../../assets/dist/css/report.css">
    <script src="../../../assets/plugins/chart.js/chart2.js"></script>
    <style>
        table {
            width: 100%;
            border: none !important;
        }
        td {
            padding: 10px;
        }
        .inner-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid black;
        }
        .inner-table th, .inner-table td {
            border: 1px solid black;
            padding: 5px;
        }
        .chart-container {
            width: 100%;
            position: relative;
        }
        .canvas {
            width: 100% !important;
            height: auto !important;
        }
        .col-1 { width: 40%; }
        .col-2 { 
            width: 60%; 
            text-align: left;
            padding: 10px;
        }
        .no-border {
            border: none !important;
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
</head>
<body>
    <button id="printButton" onclick="printPage()">Cetak Halaman</button>

    <div class="header">
        <img src="../../../assets/img/logo.JPG" alt="Logo Rumah Sakit">
        <h2>RUMAH SAKIT HUSADA BORNEO BANJARBARU</h2>
        <p>Jalan A. Yani KM.30,5 No.4, Guntung Manggis, Kec. Landasan Ulin, Kota Banjarbaru, Kalimantan Selatan 70712</p>
        <hr>
        <h4>LAPORAN KUNJUNGAN PASIEN SEMUA POLIKLINIK</h4>
    </div>
    <br>
    <table class="no-border">
        <tr>
            <td class="col-1" rowspan="2">
                <h3>Data Kunjungan Pasien</h3>
                <table class="inner-table">
                    <tr>
                        <th>Tanggal</th>
                        <th>Jumlah Pasien</th>
                    </tr>
                    <?php if (!empty($jumlahPasien)) : ?>
                        <?php foreach ($labels as $index => $tanggal) : ?>
                        <tr>
                            <td><?= htmlspecialchars($tanggal); ?></td>
                            <td><?= $jumlahPasien[$index]; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="2">Tidak ada data</td></tr>
                    <?php endif; ?>
                </table>
            </td>
            <td class="col-2">
                <div class="chart-container">
                    <canvas id="barChart"></canvas>
                </div>
            </td>
        </tr>
        <tr>
            <td class="col-2">
               <p>Jumlah Total Pendaftar: <span id="total"><?= $totalPasien; ?></span></p>
               <p>Rata-Rata Pendaftar Per Hari: <span id="average"><?= $rataRata; ?></span></p>
               <p>Jumlah Pendaftar Maksimal Per Hari: <span id="max"><?= $maxPasien; ?></span></p>
               <p>Jumlah Pendaftar Minimal Per Hari: <span id="min"><?= $minPasien; ?></span></p>
               <p>Jumlah Hari Layanan: <span id="days"><?= $jumlahHari; ?></span></p>
            </td>
        </tr>
    </table>

    <script>
        function printPage() {
            window.print(); // Menjalankan perintah cetak
        }

        document.addEventListener("DOMContentLoaded", function () {
            const labels = <?= json_encode($labels); ?>;
            const data = <?= json_encode($jumlahPasien); ?>;

            if (labels.length > 0) {
                const ctx = document.getElementById("barChart").getContext("2d");
                new Chart(ctx, {
                    type: "bar",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: "Jumlah Pasien",
                            data: data,
                            backgroundColor: "rgba(54, 162, 235, 0.7)",
                            borderColor: "rgba(54, 162, 235, 1)",
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { stepSize: 1 }
                            }
                        },
                        plugins: {
                            legend: { display: true },
                            tooltip: { enabled: true }
                        }
                    }
                });
            } else {
                document.getElementById("barChart").style.display = "none";
            }
        });
    </script>
</body>
</html>
