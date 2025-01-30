<?php
session_start();
require_once("../configuration/koneksi.php");
$username 	= $_POST['username'];
$password 	= $_POST['password'];

	$qlogin = "SELECT * FROM admin WHERE usere = '$username' AND passworde = '$password'";
	$rlogin = mysqli_query ($mysqli,$qlogin);
	$jumlahdata = mysqli_num_rows($rlogin);
	
	$qlogin2 = "SELECT * FROM poliklinik WHERE kd_poli = '$username' AND kd_poli = '$password'";
	$rlogin2 = mysqli_query ($mysqli,$qlogin2);
	$jumlahdata2 = mysqli_num_rows($rlogin2);
	
	
	if ($jumlahdata > 0) {
		$dlogin = mysqli_fetch_assoc($rlogin);
		//$_SESSION['id_admin'] = $dlogin['id_admin'];
		$_SESSION['username'] = $dlogin['usere'];
		$_SESSION['password'] = $dlogin['passworde'];
		echo "<script>alert('Selamat Datang Admin'); window.location = '../main_app/admin/main_admin_app.php?unit=beranda'</script>";
	}else if ($jumlahdata2 > 0) {
		$dlogin2 = mysqli_fetch_assoc($rlogin2);
		$_SESSION['kd_poli'] = $dlogin2['kd_poli'];
		$_SESSION['username'] = $dlogin2['kd_poli'];
		$_SESSION['password'] = $dlogin2['kd_poli'];
		$_SESSION['nm_poli'] = $dlogin2['nm_poli'];
		$nama = $dlogin2['nm_poli'];
		echo "<script>alert('Selamat Datang $nama'); window.location = '../main_app/poli/main_poli_app.php?unit=beranda'</script>";
	} else {
		echo "<script>alert('Akun Anda Tidak Terdaftar'); window.location = 'form_login.php'</script>";
	}
?>