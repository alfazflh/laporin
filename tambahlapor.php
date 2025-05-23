<?php
ini_set('session.cookie_path', '/'); 
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_user'])) {
    echo "<script>alert('Silakan login terlebih dahulu.'); window.location='login.php';</script>";
    exit;
}

$id_user = $_SESSION['id_user'];
$username = $_SESSION['username'];

if (isset($_POST['submit'])) {
    $keluhan = $_POST['keluhan'];
    $penyebab = $_POST['penyebab'];
    $lokasi   = $_POST['lokasi'];
    $lo       = $_POST['lo'];
    $la       = $_POST['la'];

    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];
    $folderUpload = "uploads/";

    if (!is_dir($folderUpload)) {
        mkdir($folderUpload, 0755, true);
    }

    $path = $folderUpload . basename($foto);
    if (move_uploaded_file($tmp, $path)) {
        $query = "INSERT INTO laporan (id_user, keluhan, penyebab, lokasi, lo, la, foto)
                VALUES ('$id_user', '$keluhan', '$penyebab', '$lokasi', '$lo', '$la', '$foto')";
        $result = mysqli_query($mysqli, $query);

        if ($result) {
            echo "<script>alert('Laporan berhasil ditambahkan!'); window.location='index.php';</script>";
        } else {
            echo "Gagal menyimpan ke database: " . mysqli_error($mysqli);
        }
    } else {
        echo "Gagal upload foto.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Laporan</title>
    <link rel="stylesheet" href="stylees.css">
</head>
<body>
    <h2>Tambah Laporan</h2>

    <form action="" method="post" enctype="multipart/form-data">
        <label>Keluhan:</label><br>
        <textarea name="keluhan" rows="3" cols="50" required></textarea><br><br>

        <label>Penyebab:</label><br>
        <input type="text" name="penyebab" required><br><br>

        <label>Lokasi:</label><br>
        <input type="text" name="lokasi" id="alamat_auto" required readonly><br><br>

        <input type="hidden" name="lo" id="longitude" required>
        <input type="hidden" name="la" id="latitude" required>

        <label>Upload Foto:</label><br>
        <div id="drop-area" style="border: 2px dashed #aaa; padding: 20px; text-align: center; cursor: pointer;">
            <p>Drag & drop gambar di sini atau klik untuk memilih</p>
            <input type="file" name="foto" id="fileElem" accept="image/*" style="display:none;" required>
        </div>
        <br><br>

        <input type="submit" name="submit" value="Tambah Laporan">
    </form>

    <script>
    function reverseGeocode(lat, lon) {
        const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                document.getElementById('alamat_auto').value = data.display_name;
            })
            .catch(err => {
                console.error("Gagal mengambil alamat:", err);
            });
    }

    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lon;
            reverseGeocode(lat, lon);
        }, function(error) {
            alert("Gagal mengambil lokasi: " + error.message);
        });
    } else {
        alert("Browser tidak mendukung GPS");
    }

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
            fileInput.files = files;
            dropArea.querySelector("p").innerText = files[0].name;
        }
    });
    </script>
</body>
</html>
