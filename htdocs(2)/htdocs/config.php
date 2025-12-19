<?php
$host     = "sql100.infinityfree.com";
$user     = "if0_40721913";
$password = "aNBCuaP48hc";
$database = "if0_40721913_complain";
$port     = 3306;

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

session_start();
