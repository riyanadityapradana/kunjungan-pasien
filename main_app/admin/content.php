<?php
//Dashboard
if ($_GET['unit'] == "beranda"){
  require_once("unit/beranda.php");
}
//Master
else if ($_GET['unit'] == "grafikpoli_lansia"){
  require_once("unit/grafikpoli_lansia.php");
}
else if ($_GET['unit'] == "grafikpoli_dewasa"){
  require_once("unit/grafikpoli_dewasa.php");
}
else if ($_GET['unit'] == "grafikpoli_anak"){
  require_once("unit/grafikpoli_anak.php");
}
else if ($_GET['unit'] == "lansia"){
  require_once("unit/poli_lansia.php");
}
else if ($_GET['unit'] == "dewasa"){
  require_once("unit/poli_dewasa.php");
}
else if ($_GET['unit'] == "remaja"){
  require_once("unit/poli_remaja.php");
}
else if ($_GET['unit'] == "anak"){
  require_once("unit/poli_anak.php");
}
// Laporan
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


//Pi-Care
else if ($_GET['unit'] == "daftar"){
  require_once("unit/pi-care/pi-care_daftar.php");
}
else if ($_GET['unit'] == "batal"){
  require_once("unit/pi-care/pi-care_batal.php");
}
?>
