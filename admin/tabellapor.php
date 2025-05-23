<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabel Laporan</title>
    <link rel="stylesheet" href="stylees.css">
    <link rel="icon" href="../icon.jpg">
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
    <h1 class="heading">Data Laporan</h1>
    <table border="1" class="table">
        <tr>
            <th>Nomor</th>
            <th>Nama Pelapor</th>
            <th>Alamat</th>
            <th>Nomor HP</th>
            <th>Keluhan</th>
            <th>Penyebab</th>
            <th>Lokasi</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Foto</th>
            <th>Action</th> 
            <th>Action</th> 
        </tr>
        <?php
        include '../koneksi.php';
        $query_mysql = mysqli_query($mysqli, 
            "SELECT laporan.*, user.nama, user.alamat, user.nomor 
                FROM laporan 
                JOIN user ON laporan.id_user = user.id") or die(mysqli_error($mysqli));
        $nomor = 1;
        while($data = mysqli_fetch_array($query_mysql)) { 
        ?>
        <tr>
            <td><?php echo $nomor++; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['alamat']; ?></td>
            <td><?php echo $data['nomor']; ?></td>
            <td><?php echo $data['keluhan']; ?></td>
            <td><?php echo $data['penyebab']; ?></td>
            <td><?php echo $data['lokasi']; ?></td>
            <td><?php echo $data['lo']; ?></td>
            <td><?php echo $data['la']; ?></td>
            <td>
    <?php
    $foto = $data['foto'];
    $folder = "../uploads/";
    $path_foto = $folder . $foto;

    if (!empty($foto) && file_exists($path_foto)) {
        echo '<img src="' . $path_foto . '" alt="Foto Laporan" width="100">';
    } else {
        echo '<span style="color:red;">(Tidak ada foto)</span>';
    }
    ?>
</td>


            <td><a href="editlapor.php?id=<?php echo $data['id']; ?>" class="btn-update">Edit</a></td>
            <td><a href="hapuslapor.php?id=<?php echo $data['id']; ?>" class="btn-hapus">Delete</a></td>
        </tr>
        <?php } ?>
    </table>
    <br><br>
    <div class='btn-log'>
        <a href="../tambahlapor.php" class="btn">Tambah Laporan</a>
    </div>
</section>

</body>
</html>
