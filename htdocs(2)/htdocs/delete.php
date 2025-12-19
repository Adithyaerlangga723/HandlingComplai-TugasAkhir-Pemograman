<?php
require_once 'koneksi.php';

$id = intval($_GET['id']);
$conn->query("DELETE FROM keluhan WHERE id_keluhan=$id");

header("Location: keluhan_list.php");
exit;
