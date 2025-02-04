<?php
switch ($_GET['action']) {

	case 'datagrid';
?>
<!-- Content Header (Page header) -->
<section class="content-header">
     <div class="container-fluid">
     <div class="row mb-2">
     <div class="col-sm-8">
          <h1>DATA KUNJUNGAN PASIEN <?=strtoupper($nama);?></h1>
     </div>
     <div class="col-sm-4">
          <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="main_poli_app.php?unit=beranda">Home</a></li>
          <li class="breadcrumb-item active">DataTables</li>
          </ol>
     </div>
     </div>
     </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
     <div class="container-fluid">
     <div class="row">
     <div class="col-12">
          <div class="card">
               <div class="card-header" style="background:rgba(69, 77, 85, 1)">
                    <h3 class="card-title" style="text-align: center; color: white;">Kunjungan Pasien Berdasarkan Kategori Anak</h3>
                    <div class="card-tools">
                        <a href="laporan/lap_poli_anak.php" target="_blank" class="btn btn-tool btn-sm"> <!-- Mengarah ke laporanya -->
                              <i class="fas fa-print"></i>
                         </a>
                         <a href="#" class="btn btn-tool btn-sm" data-card-widget="collapse">
                              <i class="fas fa-bars"></i>
                         </a>
                </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body" style="background:rgb(227, 231, 234)">
                    <table id="example" class="table table-bordered table-striped">
                         <thead style="background:rgba(69, 77, 85, 1)">
                              <tr>
                                   <th rowspan = "2"style="text-align: center; color: white; vertical-align: middle;">Nama Poli</th>
                                   <th colspan = "12"style="text-align: center; color: white;">Jumlah Pasien Per Bulan</th>
                                   <th rowspan = "2"style="text-align: center; color: white; vertical-align: middle;">Total Pasien</th>
                              </tr>
                              <tr>
                                   <th style="text-align: center; color: white;">01</th>
                                   <th style="text-align: center; color: white;">02</th>
                                   <th style="text-align: center; color: white;">03</th>
                                   <th style="text-align: center; color: white;">04</th>
                                   <th style="text-align: center; color: white;">05</th>
                                   <th style="text-align: center; color: white;">06</th>
                                   <th style="text-align: center; color: white;">07</th>
                                   <th style="text-align: center; color: white;">08</th>
                                   <th style="text-align: center; color: white;">09</th>
                                   <th style="text-align: center; color: white;">10</th>
                                   <th style="text-align: center; color: white;">11</th>
                                   <th style="text-align: center; color: white;">12</th>
                              </tr>
                         </thead>
                         <tbody>
                         <?php
                              $id = $_SESSION['kd_poli'];
                              $tahun = 2024;
                              //$tahun = date('Y');
                              $query = mysqli_query($mysqli,"SELECT * FROM poliklinik 
                                                                 WHERE kd_poli = '$id' 
                                                                 ORDER BY nm_poli")or die(mysqli_error($mysqli));
                              while ($a=mysqli_fetch_array($query)) {
                                   // Perhitungan Stok
                              //$idpoli = $a['kd_poli'];
                         ?>
                              <tr>
                              <td align="left"><?php echo $a['nm_poli'] ?></td>
                            <td align="center">
                                <?php
                                    $hitung_01 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '01' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan' AND kd_poli='$id' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12");
                                    $jml01  = mysqli_fetch_assoc($hitung_01);
                                    $jml_01 = $jml01['jumlahbulan'];
                                    echo $jml_01;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                    $hitung_02 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '02' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$id' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12");
                                    $jml02  = mysqli_fetch_assoc($hitung_02);
                                    $jml_02 = $jml02['jumlahbulan'];
                                    echo $jml_02;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                    $hitung_03 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '03' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$id' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12");
                                    $jml03  = mysqli_fetch_assoc($hitung_03);
                                    $jml_03 = $jml03['jumlahbulan'];
                                    echo $jml_03;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                    $hitung_04 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '04' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$id' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12");
                                    $jml04  = mysqli_fetch_assoc($hitung_04);
                                    $jml_04 = $jml04['jumlahbulan'];
                                    echo $jml_04;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                    $hitung_05 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '05' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$id' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12");
                                    $jml05  = mysqli_fetch_assoc($hitung_05);
                                    $jml_05 = $jml05['jumlahbulan'];
                                    echo $jml_05;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                    $hitung_06 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '06' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$id' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12");
                                    $jml06  = mysqli_fetch_assoc($hitung_06);
                                    $jml_06 = $jml06['jumlahbulan'];
                                    echo $jml_06;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                    $hitung_07 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '07' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$id' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12");
                                    $jml07  = mysqli_fetch_assoc($hitung_07);
                                    $jml_07 = $jml07['jumlahbulan'];
                                    echo $jml_07;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                    $hitung_08 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '08' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$id' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12");
                                    $jml08  = mysqli_fetch_assoc($hitung_08);
                                    $jml_08 = $jml08['jumlahbulan'];
                                    echo $jml_08;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                    $hitung_09 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '09' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$id' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12");
                                    $jml09  = mysqli_fetch_assoc($hitung_09);
                                    $jml_09 = $jml09['jumlahbulan'];
                                    echo $jml_09;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                    $hitung_10 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '10' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$id' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12");
                                    $jml10  = mysqli_fetch_assoc($hitung_10);
                                    $jml_10 = $jml10['jumlahbulan'];
                                    echo $jml_10;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                    $hitung_11 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '11' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$id' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12");
                                    $jml11  = mysqli_fetch_assoc($hitung_11);
                                    $jml_11 = $jml11['jumlahbulan'];
                                    echo $jml_11;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                    $hitung_12 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '12' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$id' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12");
                                    $jml12  = mysqli_fetch_assoc($hitung_12);
                                    $jml_12 = $jml12['jumlahbulan'];
                                    echo $jml_12;
                                ?>
                            </td>
                            <td align="center">
                                <?php
                                    $hitung_13 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$id' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 0 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 12");
                                    $jml13  = mysqli_fetch_assoc($hitung_13);
                                    $jml_13 = $jml13['jumlahbulan'];
                                    echo $jml_13;
                                ?>
                            </td>
                              </tr>
                         <?php }//end while?>
                         </tbody>
                    </table>
               </div>
               <!-- /.card-body -->
          </div>
     <!-- /.card -->
     </div>
     </div>
     </div>
</section>
<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
<!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
 

<?php
	break;
}

?>