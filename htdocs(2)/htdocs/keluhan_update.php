<?php
require 'auth.php';

$id     = $_POST['id_keluhan'];
$status = $_POST['id_status'];
$biaya  = $_POST['estimasi_biaya'];
$waktu  = $_POST['estimasi_waktu_jam'];
$rugi   = $_POST['nilai_kerugian'];

$query = $conn->prepare("
    UPDATE keluhan 
    SET id_status = ?, 
        estimasi_biaya = ?, 
        estimasi_waktu_jam = ?, 
        nilai_kerugian = ?
    WHERE id_keluhan = ?
");

$query->bind_param("ididi", $status, $biaya, $waktu, $rugi, $id);
$query->execute();

header("Location: keluhan_detail.php?id=$id");
