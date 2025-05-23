<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="icon.jpg">
</head>
<body>

<div class="container">
    <h1>Log - in</h1>
    <form class="form" action="koneksilogin.php" method="post">
    <input type="text" name="Username" placeholder="Username" required>
    <input type="password" name="Password" placeholder="Password" required>
    <a href="#">Forgot your password?</a>
    <a href="register.php">Register</a>
    <button type="submit">Login</button>
</form>
    </div>
</body>
</html>