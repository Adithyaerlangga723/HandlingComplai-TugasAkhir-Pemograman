<?php
require 'config.php';

if (isset($_SESSION['login'])) {
    header("Location: dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-box">
    <h2>Login Admin</h2>

    <?php if (isset($_GET['error'])): ?>
        <div class="error">Username atau password salah</div>
    <?php endif; ?>

    <form action="login.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">LOGIN</button>
    </form>
</div>

</body>
</html>
