<?php
// Query untuk mengambil data pendaftaran pasien
$tahun = date('Y');
$tanggal_awal = "$tahun-01-01"; // Awal tahun
$tanggal_sekarang = date('Y-m-d'); // Tanggal hari ini
$sql = "SELECT DATE_FORMAT(insert_at, '%Y-%m') AS bulan, COUNT(*) AS jumlah 
        FROM batal_daftar
        WHERE insert_at >= '$tanggal_awal' 
        AND insert_at < '$tanggal_sekarang' 
        AND is_verified <> '0' 
        GROUP BY bulan 
        ORDER BY bulan ASC";

// Eksekusi query
$result = $mysqli2->query($sql);
if (!$result) {
    die("Query error: " . $mysqli2->error);
}

// Ambil data dan konversi ke array
$labels = [];
$jumlahPasien = [];
while ($row = $result->fetch_assoc()) {
    $labels[] = $row['bulan'];
    $jumlahPasien[] = (int)$row['jumlah'];
}

// Tutup koneksi
$mysqli2->close();
?>

<!-- Content Header -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>DATA PEMBATALAN PASIEN DI PI-CARE</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="main_admin_app.php?unit=beranda">Home</a></li>
          <li class="breadcrumb-item active">Pi-Care</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<!-- Main content -->
<section class="content">
     <div class="container-fluid">
          <div class="row">
               <div class="col-md-6">
                    <!-- AREA CHART -->
                    <div class="card card-primary">
                    <div class="card-header">
                         <h3 class="card-title">Chart Kategori Lansia</h3>
                         <div class="card-tools">
                              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                   <i class="fas fa-minus"></i>
                              </button>
                              <button type="button" class="btn btn-tool" data-card-widget="remove">
                                   <i class="fas fa-times"></i>
                              </button>
                         </div>
                    </div>
                    <div class="card-body">
                         <div class="chart">
                              <canvas id="barChart" style="min-height: 400px; height: 400px; max-height: 400px; max-width: 100%;"></canvas>
                         </div>
                    </div>
                    </div>
               </div>

               <!-- Tabel Data -->
               <div class="col-md-6">
                    <div class="card">
                    <div class="card-header" style="background:rgb(0, 123, 255, 1)">
                         <h3 class="card-title" style="color: white;">DATA PASIEN</h3>
                         <div class="card-tools">
                         <a href="" data-toggle='modal' data-target='#proses' class="btn btn-tool btn-sm"> 
                              <i class="fas fa-print"></i>
                         </a>
                         <a href="#" class="btn btn-tool btn-sm" data-card-widget="collapse">
                              <i class="fas fa-bars"></i>
                         </a>
                         </div>
                    </div>
                    <div class="card-body" style="background:rgb(250, 255, 255)">
                         <table id="example-picare" class="table table-bordered table-striped">
                              <thead style="background:rgb(0, 123, 255, 1)">
                                   <tr>
                                        <th style="text-align: center; color: white;">Tanggal Pelayanan</th>
                                        <th style="text-align: center; color: white;">Jumlah Pasien</th>
                                   </tr>
                              </thead>
                              <tbody>
                              <?php for ($i = 0; $i < count($labels); $i++) { ?>
                                   <tr>
                                   <td align='center'><?php echo $labels[$i]; ?></td>
                                   <td align='center'><?php echo $jumlahPasien[$i]; ?></td>
                                   </tr>
                              <?php } ?>
                              </tbody>
                         </table>
                    </div>
               </div>
          </div>
     </div>
</section>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<!-- Bagian modal -->
<div class="container">
     <div class="modal" id="proses" role="dialog">
          <div class="modal-dialog">
               <div class="modal-content">
                    <div class="modal-header" align = "center">
                         <h3>PILIH TANGGAL KUNJUNGAN</h3>
                    </div>
                    <div class="modal-body" align = "left">
                         <form role="form" enctype="multipart/form-data" method="post" action="laporan/lap_picarebatal.php?action=tanggal" target="blank">
                              <div class="row">
                                   <div class="form-group col-lg-6">
                                        <input type="date" name="tanggalawal" class="form-control" placeholder="<?=date('Y-m-d');?>">
                                   </div>
                                   <div class="form-group col-lg-6">
                                        <input type="date" name="tanggalakhir" class="form-control" placeholder="<?=date('Y-m-d');?>">
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-lg-6">
                                        <button type="submit" class="btn btn-block btn-success">PROSES</button>
                                   </div>
                                   <div class="col-lg-6">
                                        <button type="button" class="btn btn-block btn-warning" data-dismiss="modal">TUTUP</button>
                                   </div>
                              </div>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>
<!-- Bagian modal -->

<!-- Script Chart -->
<script src="../../assets/plugins/chart.js/chart2.js"></script>
<script>
    // Data dari PHP
    var labels = <?php echo json_encode($labels); ?>;
    var data = <?php echo json_encode($jumlahPasien); ?>;

    // Warna tetap
    var backgroundColors = [
        'rgba(54, 162, 235, 0.7)',  
        'rgba(255, 99, 132, 0.7)',  
        'rgba(255, 206, 86, 0.7)',  
        'rgba(75, 192, 192, 0.7)',  
        'rgba(153, 102, 255, 0.7)', 
        'rgba(255, 159, 64, 0.7)'   
    ];

    var dynamicColors = labels.map((_, index) => backgroundColors[index % backgroundColors.length]);
    var borderColors = dynamicColors.map(color => color.replace('0.7', '1'));

    // Inisialisasi Chart
    var ctx = document.getElementById("barChart").getContext("2d");
    var barChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "Jumlah Pasien",
                data: data,
                backgroundColor: dynamicColors,
                borderColor: borderColors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: { beginAtZero: true }
            },
            plugins: {
                legend: { display: true },
                tooltip: { enabled: true }
            }
        }
    });
</script>
