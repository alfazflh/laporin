<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = mysqli_query($mysqli, "SELECT foto FROM laporan WHERE id = $id");
    $data = mysqli_fetch_assoc($query);
    $foto = $data['foto'];
    $path = "../uploads/$foto";

    echo "Foto: $foto<br>";
    echo "Full path: $path<br>";

    if ($foto && file_exists($path)) {
        if (unlink($path)) {
            echo "✅ File berhasil dihapus<br>";
        } else {
            echo "❌ Gagal menghapus file<br>";
        }
    } else {
        echo "⚠️ File tidak ditemukan atau nama kosong<br>";
    }

    $delete = mysqli_query($mysqli, "DELETE FROM laporan WHERE id = $id");
    if ($delete) {
        echo "✅ Data berhasil dihapus dari database<br>";
        header("Location: tabellapor.php");
    } else {
        echo "❌ Gagal hapus dari database: " . mysqli_error($mysqli);
    }
} else {
    echo "ID tidak ditemukan!";
}
?>
