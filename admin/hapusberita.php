<?php
include '../koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $get = mysqli_query($mysqli, "SELECT gambar FROM berita WHERE id = $id");
    $data = mysqli_fetch_assoc($get);
    $gambar = $data['gambar'];

    $path = "../uploads/" . $gambar;
    if (!empty($gambar) && file_exists($path)) {
        unlink($path); 
    }

    $delete = mysqli_query($mysqli, "DELETE FROM berita WHERE id = $id");

    if ($delete) {
        echo "<script>alert('✅ Berita berhasil dihapus!'); window.location='tabelberita.php';</script>";
    } else {
        echo "❌ Gagal menghapus berita: " . mysqli_error($mysqli);
    }
} else {
    echo "❌ ID berita tidak ditemukan!";
}
?>
