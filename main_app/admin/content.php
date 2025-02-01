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
// Laporan

?>
