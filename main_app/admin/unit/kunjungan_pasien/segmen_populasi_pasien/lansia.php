<?php
$tahun = 2024; // Atau gunakan date('Y')
$sql = "SELECT 
            p.nm_poli AS poli,
            MONTH(r.tgl_registrasi) AS bulan,
            COUNT(r.no_reg) AS jumlah
        FROM reg_periksa r
        JOIN poliklinik p ON r.kd_poli = p.kd_poli
        WHERE YEAR(r.tgl_registrasi) = '$tahun' 
              AND r.status_lanjut = 'Ralan' 
              AND CAST(r.umurdaftar AS UNSIGNED) > 60
        GROUP BY p.nm_poli, bulan
        ORDER BY p.nm_poli, bulan";

$result = $mysqli->query($sql);

// Inisialisasi array
$chartData = [];
$tableData = [];

// Buat array kosong untuk setiap poli
while ($row = $result->fetch_assoc()) {
    $poli = $row['poli'];
    $bulan = $row['bulan'];
    $jumlah = (int)$row['jumlah'];

    // Inisialisasi poli jika belum ada
    if (!isset($tableData[$poli])) {
        $tableData[$poli] = array_fill(1, 12, 0); // Buat array bulan (1-12) diisi 0
    }
    $tableData[$poli][$bulan] = $jumlah;
}

// Konversi ke format yang bisa dipakai Chart.js
$labels = range(1, 12); // Label bulan (1-12)
$datasets = [];

foreach ($tableData as $poli => $bulanData) {
    $datasets[] = [
        "label" => $poli,
        "data" => array_values($bulanData), // Ambil nilai per bulan
        "backgroundColor" => sprintf('rgba(%d, %d, %d, 0.6)', rand(50, 200), rand(50, 200), rand(50, 200))
    ];
}

// Encode untuk JavaScript
$jsonLabels = json_encode($labels);
$jsonDatasets = json_encode($datasets);
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
          <li class="breadcrumb-item active">Segmen Populasi Pasien</li>
          <li class="breadcrumb-item active">Berdasarkan Lansia</li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <!-- Kolom untuk Table -->
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
	           <h3 class="card-title" style="text-align: center; color: black;">Kunjungan Pasien Berdasarkan Kategori Anak</h3>
	            <div class="card-tools">
	                <a href="laporan/lap_poli_anak.php" target="_blank" class="btn btn-tool btn-sm" style="background:rgba(69, 77, 85, 1)"> <!-- Mengarah ke laporanya -->
	                      <i class="fas fa-print"></i>
	                 </a>
	                 <a href="#" class="btn btn-tool btn-sm" data-card-widget="collapse" style="background:rgba(69, 77, 85, 1)">
	                      <i class="fas fa-bars"></i>
	                 </a>
	        	</div>
          </div>
          <div class="card-body">
           <table id="example" class="table table-bordered table-striped">
    			<thead style="background:rgba(69, 77, 85, 1)">
			        <tr>
			            <th rowspan="2" style="text-align: center; color: white; vertical-align: middle;">Nama Poli</th>
			            <th colspan="12" style="text-align: center; color: white;">Jumlah Pasien Per Bulan</th>
			            <th rowspan="2" style="text-align: center; color: white; vertical-align: middle;">Total</th>
			        </tr>
			        <tr>
			            <?php for ($i = 1; $i <= 12; $i++) { ?>
			                <th style="text-align: center; color: white;"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></th>
			            <?php } ?>
			        </tr>
    			</thead>
    			<tbody style="background:rgb(214, 223, 227)">
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
      
      <!-- Kolom untuk Chart -->
      <div class="col-md-4">
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
  </div>
</section>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Tambahkan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById("barChart").getContext("2d");

    var barChart = new Chart(ctx, {
        type: "bar",
        data: {
            labels: <?php echo $jsonLabels; ?>, // Label bulan
            datasets: <?php echo $jsonDatasets; ?> // Data per poli
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: { title: { display: true, text: "Bulan" } },
                y: { beginAtZero: true, title: { display: true, text: "Jumlah Pasien" } }
            }
        }
    });
</script>

