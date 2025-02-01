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
      <div class="col-md-12">
        <!-- AREA CHART -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Area Chart</h3>
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
              <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- jQuery -->
<script src="../../assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../assets/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="../../assets/dist/js/adminlte.min.js"></script>
<script src="../../assets/dist/css/chart4.js"></script>
<link rel="stylesheet" href="../../assets/dist/css/bootstrap.min.css">
    

   <?php
    // Ambil data dari database
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

    $result = $mysqli->query($sql);

    $labels = [];
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['namabulan']; // Gunakan nama bulan untuk tampilan lebih baik
        $data[] = (int)$row['jumlah']; // Pastikan nilai dikonversi ke integer
    }

    $mysqli->close();
    ?>

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



