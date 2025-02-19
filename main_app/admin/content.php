<?php
//Dashboard
if ($_GET['unit'] == "beranda"){
  require_once("unit/beranda.php");
}
//Master segmen populasi pasien (Beradasarkan Usia Pasien)
else if ($_GET['unit'] == "lansia"){
  require_once("unit/kunjungan_pasien/segmen_populasi_pasien/lansia.php");
}
else if ($_GET['unit'] == "dewasa"){
  require_once("unit/kunjungan_pasien/segmen_populasi_pasien/dewasa.php");
}
else if ($_GET['unit'] == "remaja"){
  require_once("unit/kunjungan_pasien/segmen_populasi_pasien/remaja.php");
}
else if ($_GET['unit'] == "anak"){
  require_once("unit/kunjungan_pasien/segmen_populasi_pasien/anak.php");
}
// Laporan
else if ($_GET['unit'] == "lap_grafik_lansia"){
  require_once("laporan/lap_grafik_lansia.php");
}
else if ($_GET['unit'] == "lap_lansia"){
  require_once("laporan/lap_poli_lansia.php");
}
else if ($_GET['unit'] == "lap_dewasa"){
  require_once("laporan/lap_poli_dewasa.php");
}
else if ($_GET['unit'] == "lap_remaja"){
  require_once("laporan/lap_poli_remaja.php");
}
else if ($_GET['unit'] == "lap_anak"){
  require_once("laporan/lap_poli_anak.php");
}
//Master segmen pembiyaan pasien (Beradasarkan Usia Pasien)
else if ($_GET['unit'] == "pembiayaan_pasien"){
  require_once("unit/kunjungan_pasien/segmen_pembiayaan_pasien/pembiayaan_pasien.php");
}
//Pi-Care
else if ($_GET['unit'] == "daftar"){
  require_once("unit/pi-care/pi-care_daftar.php");
}
else if ($_GET['unit'] == "batal"){
  require_once("unit/pi-care/pi-care_batal.php");
}
?>
