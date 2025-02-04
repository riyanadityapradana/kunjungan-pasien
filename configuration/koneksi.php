<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "sik";

$mysqli = mysqli_connect($server,$username,$password,$database);
// Cek koneksi database pertama
if ($mysqli->connect_error) {
     die("Koneksi ke database1 gagal: " . $mysqli->connect_error);
 }

$server2 = "localhost";
$username2 = "root";
$password2 = "";
$database2 = "pendaftaran_pasien";

$mysqli2 = mysqli_connect($server2,$username2,$password2,$database2);
// Cek koneksi database pertama
if ($mysqli2->connect_error) {
     die("Koneksi ke database1 gagal: " . $mysqli2->connect_error);
 }
?>
