<?php
require 'config.php';

$nama       = $_POST['nama'];
$no_telp    = $_POST['no_telp'];
$perusahaan = $_POST['perusahaan'];
$lantai     = $_POST['lantai'];
$unit       = $_POST['unit'];
$id_divisi  = $_POST['id_divisi'];
$id_prioritas = $_POST['id_prioritas'];
$id_tipe    = $_POST['id_tipe'];
$deskripsi  = $_POST['deskripsi'];

$ip = $_SERVER['REMOTE_ADDR'];
$id_status = 1; // Before

$query = $conn->prepare("
    INSERT INTO keluhan
    (id_divisi, nama, no_telp, lantai, perusahaan, unit,
     id_prioritas, id_tipe, deskripsi, reporter_ip, id_status)
    VALUES (?,?,?,?,?,?,?,?,?,?,?)
");

$query->bind_param(
    "isssssisssi",
    $id_divisi,
    $nama,
    $no_telp,
    $lantai,
    $perusahaan,
    $unit,
    $id_prioritas,
    $id_tipe,
    $deskripsi,
    $ip,
    $id_status
);

$query->execute();

header("Location: complain_success.php");
