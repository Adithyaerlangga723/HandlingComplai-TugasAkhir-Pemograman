<?php
require 'config.php';

$username = $_POST['username'];
$password = $_POST['password'];

$query = $conn->prepare(
    "SELECT * FROM users WHERE username = ? AND password = ?"
);
$query->bind_param("ss", $username, $password);
$query->execute();

$result = $query->get_result();
$user = $result->fetch_assoc();

if ($user) {
    $_SESSION['login'] = true;
    $_SESSION['id_user'] = $user['id_user'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];

    // 🔑 REDIRECT BERDASARKAN ROLE
    if ($user['role'] == 'admin' || $user['role'] == 'petugas') {
        header("Location: dashboard.php");
    } else {
        header("Location: complain.php");
    }

    exit;
} else {
    header("Location: index.php?error=1");
}
