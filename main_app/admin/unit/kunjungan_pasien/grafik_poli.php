<?php
    // Ambil data dari database
    //$kdpoli = $_SESSION['kd_poli']; // SESSION berdasarkan login
    //$tahun = date('Y');  //Otomatis tahun sekarang
    $tahun = 2024;
    $sql = "SELECT MONTH(reg_periksa.tgl_registrasi) AS bulan,  
                   MONTHNAME(reg_periksa.tgl_registrasi) AS namabulan, 
                   COUNT(no_reg) AS jumlah 
            FROM reg_periksa 
            WHERE YEAR(reg_periksa.tgl_registrasi) = '$tahun' 
                  AND reg_periksa.status_lanjut = 'Ralan' 
                  AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 60
            GROUP BY bulan 
            ORDER BY bulan";

     $sql2 = "SELECT MONTH(reg_periksa.tgl_registrasi) AS bulan,  
                    MONTHNAME(reg_periksa.tgl_registrasi) AS namabulan, 
                    COUNT(no_reg) AS jumlah 
               FROM reg_periksa 
               WHERE YEAR(reg_periksa.tgl_registrasi) = '$tahun'
                    AND reg_periksa.status_lanjut = 'Ralan' 
                    AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 
                    AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59
               GROUP BY bulan 
               ORDER BY bulan";

     $sql3 = "SELECT MONTH(reg_periksa.tgl_registrasi) AS bulan,  
                    MONTHNAME(reg_periksa.tgl_registrasi) AS namabulan, 
                    COUNT(no_reg) AS jumlah 
               FROM reg_periksa 
               WHERE YEAR(reg_periksa.tgl_registrasi) = '$tahun'
                    AND reg_periksa.status_lanjut = 'Ralan' 
                    AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 12 
                    AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 19
               GROUP BY bulan 
               ORDER BY bulan";

     $sql4 = "SELECT MONTH(reg_periksa.tgl_registrasi) AS bulan,  
                    MONTHNAME(reg_periksa.tgl_registrasi) AS namabulan, 
                    COUNT(no_reg) AS jumlah 
               FROM reg_periksa 
               WHERE YEAR(reg_periksa.tgl_registrasi) = '$tahun'
                    AND reg_periksa.status_lanjut = 'Ralan' 
                    AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 
                    AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12
               GROUP BY bulan 
               ORDER BY bulan";

    $result = $mysqli->query($sql);

    $labels = [];
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['namabulan']; // Gunakan nama bulan untuk tampilan lebih baik
        $data[] = (int)$row['jumlah']; // Pastikan nilai dikonversi ke integer
    }

    $result = $mysqli->query($sql2);

    $labels2 = [];
    $data2 = [];

    while ($row2 = $result->fetch_assoc()) {
     $labels2[] = $row2['namabulan']; // Gunakan nama bulan untuk tampilan lebih baik
     $data2[] = (int)$row2['jumlah']; // Pastikan nilai dikonversi ke integer
     }

     $result = $mysqli->query($sql3);

    $labels3 = [];
    $data3 = [];

    while ($row3 = $result->fetch_assoc()) {
     $labels3[] = $row3['namabulan']; // Gunakan nama bulan untuk tampilan lebih baik
     $data3[] = (int)$row3['jumlah']; // Pastikan nilai dikonversi ke integer
     }

     $result = $mysqli->query($sql4);

    $labels4 = [];
    $data4 = [];

    while ($row4 = $result->fetch_assoc()) {
     $labels4[] = $row4['namabulan']; // Gunakan nama bulan untuk tampilan lebih baik
     $data4[] = (int)$row4['jumlah']; // Pastikan nilai dikonversi ke integer
     }

    $mysqli->close();
?>
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>GRAFIK KUNJUNGAN PASIEN</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="main_admin_app.php?unit=beranda">Home</a></li>
          <li class="breadcrumb-item active">ChartJS</li>
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
                <a href="" data-toggle='modal' data-target='#proses' class="btn btn-tool btn-sm"> 
                    <i class="fas fa-print"></i>
                </a>
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
                    <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Chart Kategori Dewasa</h3>

                <div class="card-tools">
                <a href="" data-toggle='modal' data-target='#proses2' class="btn btn-tool btn-sm"> 
                    <i class="fas fa-print"></i>
                </a>
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                    <canvas id="barChart2" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Chart Kategori Remaja</h3>

                <div class="card-tools">
                <a href="" data-toggle='modal' data-target='#proses3' class="btn btn-tool btn-sm"> 
                    <i class="fas fa-print"></i>
                </a>
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
                    <canvas id="barChart3" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Chart Kategori Anak</h3>

                <div class="card-tools">
                <a href="" data-toggle='modal' data-target='#proses4' class="btn btn-tool btn-sm"> 
                    <i class="fas fa-print"></i>
                </a>
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
                  <canvas id="barChart4" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
                         <form role="form" enctype="multipart/form-data" method="post" action="laporan/lap_picaredaftar.php?action=tanggal" target="blank">
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

  <!-- Bagian modal -->
  <div class="container">
     <div class="modal" id="proses2" role="dialog">
          <div class="modal-dialog">
               <div class="modal-content">
                    <div class="modal-header" align = "center">
                         <h3>PILIH TANGGAL KUNJUNGAN</h3>
                    </div>
                    <div class="modal-body" align = "left">
                         <form role="form" enctype="multipart/form-data" method="post" action="laporan/lap_picaredaftar.php?action=tanggal" target="blank">
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

  <!-- Bagian modal -->
  <div class="container">
     <div class="modal" id="proses3" role="dialog">
          <div class="modal-dialog">
               <div class="modal-content">
                    <div class="modal-header" align = "center">
                         <h3>PILIH TANGGAL KUNJUNGAN</h3>
                    </div>
                    <div class="modal-body" align = "left">
                         <form role="form" enctype="multipart/form-data" method="post" action="laporan/lap_picaredaftar.php?action=tanggal" target="blank">
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

  <!-- Bagian modal -->
  <div class="container">
     <div class="modal" id="proses4" role="dialog">
          <div class="modal-dialog">
               <div class="modal-content">
                    <div class="modal-header" align = "center">
                         <h3>PILIH TANGGAL KUNJUNGAN</h3>
                    </div>
                    <div class="modal-body" align = "left">
                         <form role="form" enctype="multipart/form-data" method="post" action="laporan/lap_picaredaftar.php?action=tanggal" target="blank">
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

<!-- ChartJS -->
<script src="../../assets/plugins/chart.js/Chart.min.js"></script>
<script src="../../assets/dist/css/chart4.js"></script>
<link rel="stylesheet" href="../../assets/dist/css/bootstrap.min.css">
<script>
        // Ambil data dari PHP
        var labels = <?php echo json_encode($labels); ?>;
        var data = <?php echo json_encode($data); ?>;

        // Fungsi untuk menghasilkan warna acak
        function getRandomColor() {
            return 'rgba(' + (Math.floor(Math.random() * 255)) + ',' +
                             (Math.floor(Math.random() * 255)) + ',' +
                             (Math.floor(Math.random() * 255)) + ', 0.7)';
        }

        // Buat array warna acak sebanyak jumlah data
        var backgroundColors = labels.map(() => getRandomColor());
        var borderColors = backgroundColors.map(color => color.replace('0.5', '1'));

        var ctx = document.getElementById("barChart").getContext("2d");

        var barChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [{
                    label: "Jumlah Pasien Dengan Ketegori Lansia",
                    data: data,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

     <script>
        // Ambil data dari PHP
        var labels2 = <?php echo json_encode($labels2); ?>;
        var data2 = <?php echo json_encode($data2); ?>;

        // Fungsi untuk menghasilkan warna acak
        function getRandomColor() {
            return 'rgba(' + (Math.floor(Math.random() * 255)) + ',' +
                             (Math.floor(Math.random() * 255)) + ',' +
                             (Math.floor(Math.random() * 255)) + ', 0.7)';
        }

        // Buat array warna acak sebanyak jumlah data
        var backgroundColors = labels2.map(() => getRandomColor());
        var borderColors = backgroundColors.map(color => color.replace('0.5', '1'));

        var ctx = document.getElementById("barChart2").getContext("2d");

        var barChart2 = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels2,
                datasets: [{
                    label: "Jumlah Pasien Dengan Ketegori Dewasa",
                    data: data2,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

     <script>
        // Ambil data dari PHP
        var labels3 = <?php echo json_encode($labels3); ?>;
        var data3 = <?php echo json_encode($data3); ?>;

        // Fungsi untuk menghasilkan warna acak
        function getRandomColor() {
            return 'rgba(' + (Math.floor(Math.random() * 255)) + ',' +
                             (Math.floor(Math.random() * 255)) + ',' +
                             (Math.floor(Math.random() * 255)) + ', 0.7)';
        }

        // Buat array warna acak sebanyak jumlah data
        var backgroundColors = labels3.map(() => getRandomColor());
        var borderColors = backgroundColors.map(color => color.replace('0.5', '1'));

        var ctx = document.getElementById("barChart3").getContext("2d");

        var barChart3 = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels3,
                datasets: [{
                    label: "Jumlah Pasien Dengan Ketegori Remaja",
                    data: data3,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>

     <script>
        // Ambil data dari PHP
        var labels4 = <?php echo json_encode($labels4); ?>;
        var data4 = <?php echo json_encode($data4); ?>;

        // Fungsi untuk menghasilkan warna acak
        function getRandomColor() {
            return 'rgba(' + (Math.floor(Math.random() * 255)) + ',' +
                             (Math.floor(Math.random() * 255)) + ',' +
                             (Math.floor(Math.random() * 255)) + ', 0.7)';
        }

        // Buat array warna acak sebanyak jumlah data
        var backgroundColors = labels4.map(() => getRandomColor());
        var borderColors = backgroundColors.map(color => color.replace('0.5', '1'));

        var ctx = document.getElementById("barChart4").getContext("2d");

        var barChart4 = new Chart(ctx, {
            type: "bar",
            data: {
                labels: labels4,
                datasets: [{
                    label: "Jumlah Pasien Dengan Ketegori Anak",
                    data: data4,
                    backgroundColor: backgroundColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    </script>
