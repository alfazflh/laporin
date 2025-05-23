<?php
ini_set('session.cookie_path', '/');
session_start();
include '../koneksi.php';

if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
    exit;
}

$id_user = $_SESSION['id_user'];
$username = $_SESSION['username'];

if (isset($_POST['submit'])) {
    $judul   = $_POST['judul'];
    $isi     = $_POST['isi'];
    $tanggal = $_POST['tanggal'];
    $penulis = $_POST['penulis'];

    $gambar = $_FILES['gambar']['name'];
    $tmp    = $_FILES['gambar']['tmp_name'];
    $folderUpload = "../uploads/";

    if (!is_dir($folderUpload)) {
        mkdir($folderUpload, 0755, true);
    }

    $path = $folderUpload . basename($gambar);
    if (move_uploaded_file($tmp, $path)) {
        $query = "INSERT INTO berita (judul, isi, tanggal, penulis, gambar)
                  VALUES ('$judul', '$isi', '$tanggal', '$penulis', '$gambar')";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            echo "<script>alert('Berita berhasil ditambahkan!'); window.location='tabelberita.php';</script>";
        } else {
            echo "Gagal menyimpan ke database: " . mysqli_error($mysqli);
        }
    } else {
        echo "Gagal upload gambar.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Berita</title>
    <link rel="stylesheet" href="stylees.css">
</head>

<body>
    <h2>Tambah Berita</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <label>Judul Berita:</label><br>
        <input type="text" name="judul" required><br><br>

        <label>Isi Berita:</label><br>
        <textarea name="isi" rows="5" cols="50" required></textarea><br><br>

        <label>Tanggal:</label><br>
        <input type="date" name="tanggal" required><br><br>

        <label>Penulis:</label><br>
        <input type="text" name="penulis" required><br><br>

        <label>Upload Gambar:</label><br>
<div id="drop-area" style="border: 2px dashed #aaa; padding: 20px; text-align: center; cursor: pointer;">
    <p>Drag & drop gambar di sini atau klik untuk memilih</p>
    <input type="file" name="gambar" id="fileElem" accept="image/*" style="display:none;" required>
</div>
<br><br>

        <input type="submit" name="submit" value="Tambah Berita">
    </form>
    <script>
const dropArea = document.getElementById("drop-area");
const fileInput = document.getElementById("fileElem");

dropArea.addEventListener("click", () => fileInput.click());

dropArea.addEventListener("dragover", e => {
    e.preventDefault();
    dropArea.style.borderColor = "#00aaff";
});

dropArea.addEventListener("dragleave", () => {
    dropArea.style.borderColor = "#aaa";
});

dropArea.addEventListener("drop", e => {
    e.preventDefault();
    dropArea.style.borderColor = "#aaa";
    const files = e.dataTransfer.files;
    if (files.length > 0) {
        fileInput.files = files; // masukkan file ke input
        dropArea.querySelector("p").innerText = files[0].name;
    }
});
</script>

</body>
</html>
