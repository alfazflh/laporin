<?php
    include("../koneksi.php");
    if(!isset($_GET['id'])){ header('Location: tabellapor.php');
    }
    $id = $_GET['id'];
    $result = mysqli_query($mysqli, "SELECT * FROM laporan WHERE id=$id");
    while($user_data = mysqli_fetch_array($result))
    {
    $keluhan = $user_data['keluhan'];
    $penyebab = $user_data['penyebab'];
    $lokasi = $user_data['lokasi'];
    $lo = $user_data['lo'];
    $la = $user_data['la'];
    }
    ?>
    <html>
    <body>
            <div class="container">
            <h3>Form Edit User</h3>

        <form method="POST" action="proseseditlapor.php">
            <table>
                <tr>
                    <td>Keluhan</td>
                    <td><input type="text" name="keluhan" value="<?php echo $keluhan; ?>"></td>
                </tr>
                <tr>
                    <td>Penyebab</td>
                    <td><input type="text" name="penyebab" value="<?php echo $penyebab ?>"></td>
                </tr>
                <tr>
                    <td>Lokasi</td>
                    <td><input type="text" name="lokasi" value="<?php echo $lokasi ?>"></td>
                </tr>
                <tr>
                    <td>Longitude</td>
                    <td><input type="text" name="lo" value="<?php echo $lo ?>"></td>
                </tr>
                <tr>
                    <td>Latitude</td>
                    <td><input type="text" name="la" value="<?php echo $la ?>"></td>
                </tr>
                <tr>
                    <td><input type="hidden" name="id" value=<?php echo $_GET['id'];?>></td>
                    <td><input type="submit" name="simpan" value="Simpan"></td>
                </tr>
            </table>
        </form>
        </div>
    </body>

    </html>