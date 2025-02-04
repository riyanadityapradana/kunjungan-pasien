<?php
	require_once("../../../configuration/koneksi.php");
	session_start();
	$nama = $_SESSION['nm_poli'];
     $kdpoli = $_SESSION['kd_poli'];
    $tahun = date('Y');
	$query = mysqli_query($mysqli,"SELECT * FROM poliklinik WHERE kd_poli = '$kdpoli' ORDER BY nm_poli")or die(mysqli_error($mysqli));

    $query2 = "SELECT * FROM reg_periksa LEFT JOIN dokter ON reg_periksa.kd_dokter=dokter.kd_dokter";
    $admin = mysqli_fetch_array(mysqli_query($mysqli,$query2));
    $nm_dokter = $admin['nm_dokter'];
?>
<html>

<head>
	<title>Laporan</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<style>
		table{margin:0 auto;border-collapse:collapse;background:#ffffff;}
		caption h3{}
		th{padding:7px 4px;background: #ffffff;}
		td{padding:4px 15px;}
	</style>
</head>

<body>
	<div>
		<table border='0'>
			<tr>
				<td align="center"><img src="../../../assets/img/logo.JPG" alt="..." width="150" height="150"></td>
				<td align="center" width="90%">
					<h2>RUMAH SAKIT PELITA INSANI</h2>
						Alamat : Jalan Sekumpul No. 66, Martapura, Kalimantan Selatan 70614 Telp. (0511) 4722210
				</td>
			</tr>
		</table>
		
		<hr>
		<h4 align="center">LAPORAN KUNJUNGAN PASIEN <?=strtoupper($nama);?> <p>BERDASARKAN KATEGORI LANJUT DEWASA</h4>
    </div>
	
    <table border ="1" width="95%">
    <thead style="background:rgb(49, 88, 230)">
        <tr>
            <th rowspan = "2" style="text-align: center;">No</th>
            <th rowspan = "2"style="text-align: center;">Nama Poli</th>
            <th colspan = "12"style="text-align: center;">Jumlah Pasien Per Bulan</th>
            <th rowspan = "2"style="text-align: center;">Total Pasien</th>
        </tr>
        <tr>
            <th style="text-align: center;">01</th>
            <th style="text-align: center;">02</th>
            <th style="text-align: center;">03</th>
            <th style="text-align: center;">04</th>
            <th style="text-align: center;">05</th>
            <th style="text-align: center;">06</th>
            <th style="text-align: center;">07</th>
            <th style="text-align: center;">08</th>
            <th style="text-align: center;">09</th>
            <th style="text-align: center;">10</th>
            <th style="text-align: center;">11</th>
            <th style="text-align: center;">12</th>
        </tr>
    </thead>
    <tbody>
    <?php
        $n=1;
        //$tahun = 2024;
        $tahun = date('Y');
        $query = mysqli_query($mysqli,"SELECT * FROM poliklinik WHERE kd_poli = '$kdpoli' ORDER BY nm_poli")or die(mysqli_error($mysqli));
        //$query = mysqli_query($mysqli,"SELECT * FROM poliklinik ORDER BY nm_poli")or die(mysqli_error($mysqli));
        while ($a=mysqli_fetch_array($query)) {
            // Perhitungan Stok
        $idpoli = $a['kd_poli'];
        $nn=$n++;
    ?>
        <tr class="gradeU">
            <td align="center"><?php echo $nn ?></td>
            <td align="center"><?php echo $a['nm_poli'] ?></td>
            <td align="center">
                <?php
                    $hitung_01 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '01' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan' AND kd_poli='$idpoli' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59");
                    $jml01  = mysqli_fetch_assoc($hitung_01);
                    $jml_01 = $jml01['jumlahbulan'];
                    echo $jml_01;
                ?>
            </td>
            <td align="center">
                <?php
                    $hitung_02 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '02' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$idpoli' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59");
                    $jml02  = mysqli_fetch_assoc($hitung_02);
                    $jml_02 = $jml02['jumlahbulan'];
                    echo $jml_02;
                ?>
            </td>
            <td align="center">
                <?php
                    $hitung_03 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '03' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$idpoli' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59");
                    $jml03  = mysqli_fetch_assoc($hitung_03);
                    $jml_03 = $jml03['jumlahbulan'];
                    echo $jml_03;
                ?>
            </td>
            <td align="center">
                <?php
                    $hitung_04 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '04' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$idpoli' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59");
                    $jml04  = mysqli_fetch_assoc($hitung_04);
                    $jml_04 = $jml04['jumlahbulan'];
                    echo $jml_04;
                ?>
            </td>
            <td align="center">
                <?php
                    $hitung_05 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '05' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$idpoli' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59");
                    $jml05  = mysqli_fetch_assoc($hitung_05);
                    $jml_05 = $jml05['jumlahbulan'];
                    echo $jml_05;
                ?>
            </td>
            <td align="center">
                <?php
                    $hitung_06 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '06' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$idpoli' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59");
                    $jml06  = mysqli_fetch_assoc($hitung_06);
                    $jml_06 = $jml06['jumlahbulan'];
                    echo $jml_06;
                ?>
            </td>
            <td align="center">
                <?php
                    $hitung_07 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '07' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$idpoli' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59");
                    $jml07  = mysqli_fetch_assoc($hitung_07);
                    $jml_07 = $jml07['jumlahbulan'];
                    echo $jml_07;
                ?>
            </td>
            <td align="center">
                <?php
                    $hitung_08 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '08' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$idpoli' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59");
                    $jml08  = mysqli_fetch_assoc($hitung_08);
                    $jml_08 = $jml08['jumlahbulan'];
                    echo $jml_08;
                ?>
            </td>
            <td align="center">
                <?php
                    $hitung_09 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '09' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$idpoli' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59");
                    $jml09  = mysqli_fetch_assoc($hitung_09);
                    $jml_09 = $jml09['jumlahbulan'];
                    echo $jml_09;
                ?>
            </td>
            <td align="center">
                <?php
                    $hitung_10 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '10' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$idpoli' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59");
                    $jml10  = mysqli_fetch_assoc($hitung_10);
                    $jml_10 = $jml10['jumlahbulan'];
                    echo $jml_10;
                ?>
            </td>
            <td align="center">
                <?php
                    $hitung_11 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '11' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$idpoli' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59");
                    $jml11  = mysqli_fetch_assoc($hitung_11);
                    $jml_11 = $jml11['jumlahbulan'];
                    echo $jml_11;
                ?>
            </td>
            <td align="center">
                <?php
                    $hitung_12 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE MONTH(reg_periksa.tgl_registrasi) = '12' AND YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$idpoli' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59");
                    $jml12  = mysqli_fetch_assoc($hitung_12);
                    $jml_12 = $jml12['jumlahbulan'];
                    echo $jml_12;
                ?>
            </td>
            <td align="center">
                <?php
                    $hitung_13 = mysqli_query($mysqli, "SELECT count(no_reg) AS jumlahbulan from reg_periksa WHERE YEAR(reg_periksa.tgl_registrasi)='$tahun' AND reg_periksa.status_lanjut = 'Ralan'AND kd_poli='$idpoli' AND CAST(reg_periksa.umurdaftar AS UNSIGNED) > 20 AND CAST(reg_periksa.umurdaftar AS UNSIGNED) < 59");
                    $jml13  = mysqli_fetch_assoc($hitung_13);
                    $jml_13 = $jml13['jumlahbulan'];
                    echo $jml_13;
                ?>
            </td>
        </tr>
    <?php }//end while?>
    </tbody>
    </table>
	<br/><br/>
	<div>
		<table width="100%">
			<thead></thead>
			<body>
				<tr>
					<td align="center">
						<table border='0'>
							<tr align="center">
								<td style="color: #000000; padding-bottom: 0">Mengetahui,</td>
							</tr>
							<tr align="center">
								<td style="color: #000000; padding-top: 0">DOKTER <?=strtoupper($nama);?></td>
							</tr>
							<tr align="center">
								<td><br/><br/><br/></td>
							</tr>
							<tr align="center">
                                <td style="color: #000000; padding-bottom: 0"><?=strtoupper($nm_dokter);?></td>
							</tr>
						</table>
					</td>
					<td align="center">
						<table border="0">
							<tr align="center">
								<td style="color: #000000; padding-bottom: 0">Banjarbaru, <?php echo date ('d/m/Y');?></td>
							</tr>
							<tr align="center">
								<td style="color: #000000; padding-top: 0">STAFF IT</td>
							</tr>
							<tr>
								<td><br/><br/><br/></td>
							</tr>
							<tr align="center">
								<td style="color: #000000">RIYAN ADITYA PRADANA</td>
							</tr>
						</table>
					</td>
				</tr>
			</body>
		</table>
	</div>
  </body>
  <script>
		window.print();
	</script>
  </html>