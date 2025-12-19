<?php
session_start();
require_once 'koneksi.php';

if ($_SESSION['role'] !== 'admin') {
    die('Akses ditolak');
}

$id = intval($_GET['id']);
$conn->query("DELETE FROM keluhan WHERE id_keluhan=$id");

header("Location: keluhan_list.php");
exit;
