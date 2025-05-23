<?php
include("../koneksi.php");
if (isset( $_POST['simpan'] )) {
$id = $_POST['id'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$alamat = $_POST['alamat'];
$nomor = $_POST['nomor'];
$password = $_POST['password'];
$level = $_POST['level'];
$result = mysqli_query($mysqli, "UPDATE user
SET nama='$nama' , username='$username' , alamat='$alamat' , nomor='$nomor' , password='$password' , level='$level' WHERE id=$id");
header('Location: index.php');}
else {
    die("Akses Dilarang...");
}
?>