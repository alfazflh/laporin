<?php
include("../koneksi.php");
if (isset( $_POST['simpan'] )) {
$id = $_POST['id'];
$keluhan = $_POST['keluhan'];
$penyebab = $_POST['penyebab'];
$lokasi = $_POST['lokasi'];
$lo = $_POST['lo'];
$la = $_POST['la'];
$result = mysqli_query($mysqli, "UPDATE laporan
SET keluhan='$keluhan' , penyebab='$penyebab' , lokasi='$lokasi' , lo='$lo' , la='$la' WHERE id=$id");
header('Location: tabellapor.php');}
else {
    die("Akses Dilarang...");
}
?>