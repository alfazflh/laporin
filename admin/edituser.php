<?php
    include("../koneksi.php");
    if(!isset($_GET['id'])){ header('Location: index.php');
    }
    $id = $_GET['id'];
    $result = mysqli_query($mysqli, "SELECT * FROM user WHERE id=$id");
    while($user_data = mysqli_fetch_array($result))
    {
    $nama = $user_data['nama'];
    $username = $user_data['username'];
    $alamat = $user_data['alamat'];
    $nomor = $user_data['nomor'];
    $password = $user_data['password'];
    $level=$user_data['level'];
    }
    ?>
    <html>
    <body>
            <div class="container">
            <h3>Form Edit User</h3>

        <form method="POST" action="prosesedituser.php">
            <table>
                <tr>
                    <td>Nama</td>
                    <td><input type="text" name="nama" value="<?php echo $nama; ?>"></td>
                </tr>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username" value="<?php echo $username ?>"></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td><input type="text" name="alamat" value="<?php echo $alamat ?>"></td>
                </tr>
                <tr>
                    <td>Nomor Hp</td>
                    <td><input type="text" name="nomor" value="<?php echo $nomor ?>"></td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password" value="<?php echo $password ?>"></td>
                </tr>
                <tr>
                    <td>level</td>
                    <td>
                        <select name="level" id="level" required>
                            <option > <?php echo $level ?></option>
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </td>
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