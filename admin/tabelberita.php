<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Berita</title>
    <link rel="stylesheet" href="stylees.css">
    <style>
        img.thumb {
            width: 100px;
            height: auto;
            border-radius: 6px;
            object-fit: cover;
        }
    </style>
</head>
<body>
<header>
    <nav>
        <a class="item" href="index.php">Tabel User</a>
        <a class="item" href="tabellapor.php">Tabel Laporan</a>
        <a class="item" href="tabelberita.php">Tabel Berita</a>
    </nav>
</header>

<section class="user">
    <h1 class="heading">Data Berita</h1>
    <table border="1" class="table">
        <tr>
            <th>Nomor</th>
            <th>Judul Berita</th>
            <th>Isi Berita</th>
            <th>Tanggal</th>
            <th>Penulis Berita</th>
            <th>Gambar</th> 
            <th>Action</th> 
            <th>Action</th> 
        </tr>
        <?php
        include '../koneksi.php';
        $query_mysql = mysqli_query($mysqli, "SELECT * FROM berita") or die(mysqli_error($mysqli));
        $nomor = 1;
        while($data = mysqli_fetch_array($query_mysql)) { 
        ?>
        <tr>
            <td><?= $nomor++; ?></td>
            <td><?= $data['judul']; ?></td>
            <td><?= $data['isi']; ?></td>
            <td><?= $data['tanggal']; ?></td>
            <td><?= $data['penulis']; ?></td>
            <td>
                <?php if (!empty($data['gambar']) && file_exists("../uploads/" . $data['gambar'])): ?>
                    <img src="../uploads/<?= $data['gambar']; ?>" class="thumb" alt="Gambar Berita">
                <?php else: ?>
                    <span>Tidak ada gambar</span>
                <?php endif; ?>
            </td>
            <td><a href="editberita.php?id=<?= $data['id']; ?>" class="btn-update">Edit</a></td>
            <td><a href="hapusberita.php?id=<?= $data['id']; ?>" class="btn-hapus">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
    <br><br>
    <div class='btn-log'>
        <a href="tambahberita.php" class="btn">Tambah Berita</a>
    </div>
</section>
</body>
</html>
