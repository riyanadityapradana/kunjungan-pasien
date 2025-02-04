<?php
//Dashboard
if ($_GET['unit'] == "beranda"){
  require_once("unit/beranda.php");
}
//Master
else if ($_GET['unit'] == "grafik_poli"){
     require_once("unit/grafik_poli.php");
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
//laporan
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
?>
