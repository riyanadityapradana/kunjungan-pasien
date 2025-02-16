<?php
  $tahun = date('Y'); // Atau gunakan date('Y')
  $sql = "SELECT 
              p.nm_poli AS poli,
              MONTH(r.tgl_registrasi) AS bulan,
              COUNT(r.no_reg) AS jumlah
          FROM reg_periksa r -- ubah nama tabel reg_periksa menjadi r
          JOIN poliklinik p -- ubah nama tabel reg_periksa menjadi p
          ON r.kd_poli = p.kd_poli
          WHERE YEAR(r.tgl_registrasi) = '$tahun' 
                AND r.status_lanjut = 'Ralan' -- statusnya khusus rawat jalan
                AND CAST(r.umurdaftar AS UNSIGNED) > 13 -- batas umur lebih dari 20 thn 
                AND CAST(r.umurdaftar AS UNSIGNED) < 19 -- batas umur kurang dari 59 thn
          GROUP BY p.nm_poli, bulan
          ORDER BY p.nm_poli, bulan";

  $result = $mysqli->query($sql);

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
          <li class="breadcrumb-item active">Berdasarkan Remaja</li>
        </ol>
      </div>
    </div>
  </div>
</section>
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
             <h3 class="card-title" style="text-align: center;">Kunjungan Pasien Kategori Remaja</h3>
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
    </div>
  </div>
</section>
<section class="content">
  <div class="container-fluid">
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
  </div>
</section>

<!-- Bagian modal -->
<div class="container">
   <div class="modal" id="proses" role="dialog">
        <div class="modal-dialog">
             <div class="modal-content">
                  <div class="modal-header" align = "center">
                       <h3>PILIH TANGGAL KUNJUNGAN</h3>
                  </div>
                  <div class="modal-body" align = "left">
                       <form role="form" enctype="multipart/form-data" method="post" action="laporan/lap_poli_remaja.php?action=tanggal" target="blank">
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
<script src="../../assets/dist/css/chart4.js"></script>
<!-- Chart.js Library -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->
<script>
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