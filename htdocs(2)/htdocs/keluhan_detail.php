<?php
require 'auth.php';

$id = $_GET['id'];

$data = $conn->query("
    SELECT k.*, 
           d.nama_divisi,
           p.nama_prioritas,
           t.nama_tipe
    FROM keluhan k
    JOIN divisi d ON k.id_divisi = d.id_divisi
    JOIN prioritas p ON k.id_prioritas = p.id_prioritas
    JOIN tipe_keluhan t ON k.id_tipe = t.id_tipe
    WHERE k.id_keluhan = $id
")->fetch_assoc();

$status = $conn->query("SELECT * FROM status_keluhan");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Keluhan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <span>Detail Keluhan</span>
    <a href="keluhan_list.php">Kembali</a>
</div>

<div class="container">
<h3>Informasi Keluhan</h3>

<p><b>Nama:</b> <?= $data['nama']; ?></p>
<p><b>Divisi:</b> <?= $data['nama_divisi']; ?></p>
<p><b>Prioritas:</b> <?= $data['nama_prioritas']; ?></p>
<p><b>Tipe:</b> <?= $data['nama_tipe']; ?></p>
<p><b>Deskripsi:</b><br><?= nl2br($data['deskripsi']); ?></p>

<hr>

<h3>Update Status & Perhitungan</h3>

<form method="post" action="keluhan_update.php">
    <input type="hidden" name="id_keluhan" value="<?= $id; ?>">

    <label>Status</label>
    <select name="id_status">
        <?php while ($s = $status->fetch_assoc()): ?>
            <option value="<?= $s['id_status']; ?>"
                <?= ($s['id_status'] == $data['id_status']) ? 'selected' : ''; ?>>
                <?= $s['nama_status']; ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label>Estimasi Biaya</label>
    <input type="number" name="estimasi_biaya" value="<?= $data['estimasi_biaya']; ?>">

    <label>Estimasi Waktu (Jam)</label>
    <input type="number" name="estimasi_waktu_jam" value="<?= $data['estimasi_waktu_jam']; ?>">

    <label>Nilai Kerugian</label>
    <input type="number" name="nilai_kerugian" value="<?= $data['nilai_kerugian']; ?>">

    <button type="submit">SIMPAN</button>
</form>
</div>

</body>
</html>
