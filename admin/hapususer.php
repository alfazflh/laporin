<?php
include '../koneksi.php';
$id = $_GET['id']; 


$hapus = mysqli_query($mysqli, "DELETE FROM user WHERE id = '$id'") or die(mysqli_error($mysqli));

if($hapus) {
    header("Location: index.php");
    exit();
} else {
    echo "Gagal menghapus user.";
}
?>