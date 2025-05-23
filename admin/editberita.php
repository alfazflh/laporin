<?php
include '../koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: tabelberita.php");
    exit;
}

$id = $_GET['id'];

$query = mysqli_query($mysqli, "SELECT * FROM berita WHERE id = $id");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Berita tidak ditemukan.");
}

if (isset($_POST['submit'])) {
    $judul   = $_POST['judul'];
    $isi     = $_POST['isi'];
    $tanggal = $_POST['tanggal'];
    $penulis = $_POST['penulis'];

    $gambarLama = $data['gambar'];
    $gambarBaru = $_FILES['gambar']['name'];
    $tmp        = $_FILES['gambar']['tmp_name'];
    $folder     = "../uploads/";

    if (!empty($gambarBaru)) {
        if (file_exists($folder . $gambarLama)) {
            unlink($folder . $gambarLama);
        }

        $path = $folder . basename($gambarBaru);
        if (!move_uploaded_file($tmp, $path)) {
            die("Gagal upload gambar baru.");
        }
        $gambarFinal = $gambarBaru;
    } else {
        $gambarFinal = $gambarLama;
    }

    $update = mysqli_query($mysqli, "UPDATE berita SET 
        judul = '$judul',
        isi = '$isi',
        tanggal = '$tanggal',
        penulis = '$penulis',
        gambar = '$gambarFinal'
        WHERE id = $id");

    if ($update) {
        echo "<script>alert('Berita berhasil diupdate!'); window.location='tabelberita.php';</script>";
    } else {
        echo "Gagal update data: " . mysqli_error($mysqli);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Berita</title>
    <link rel="stylesheet" href="stylees.css">
</head>
<body>
    <h2>Edit Berita</h2>

    <form method="POST" action="" enctype="multipart/form-data">
        <label>Judul Berita:</label><br>
        <input type="text" name="judul" value="<?= $data['judul']; ?>" required><br><br>

        <label>Isi Berita:</label><br>
        <textarea name="isi" rows="5" cols="50" required><?= $data['isi']; ?></textarea><br><br>

        <label>Tanggal:</label><br>
        <input type="date" name="tanggal" value="<?= $data['tanggal']; ?>" required><br><br>

        <label>Penulis:</label><br>
        <input type="text" name="penulis" value="<?= $data['penulis']; ?>" required><br><br>

        <label>Gambar Saat Ini:</label><br>
        <?php if (!empty($data['gambar']) && file_exists("../uploads/" . $data['gambar'])): ?>
            <img src="../uploads/<?= $data['gambar']; ?>" width="150"><br>
        <?php else: ?>
            <span>Tidak ada gambar</span><br>
        <?php endif; ?>

        <label>Upload Gambar Baru?</label><br>
        <input type="file" name="gambar" accept="image/*"><br><br>

        <input type="submit" name="submit" value="Simpan Perubahan">
    </form>
</body>
</html>
