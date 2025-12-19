<?php
require 'config.php';

$divisi = $conn->query("SELECT * FROM divisi");
$prioritas = $conn->query("SELECT * FROM prioritas ORDER BY sort_order");
$tipe = $conn->query("SELECT * FROM tipe_keluhan");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Keluhan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="page-center">
    <div class="form-card">
        <h2>Form Keluhan</h2>

        <form action="complain_save.php" method="post">

            <label>Nama</label>
            <input type="text" name="nama" required>

            <label>No Telp</label>
            <input type="text" name="no_telp">

            <label>Perusahaan</label>
            <input type="text" name="perusahaan">

            <label>Lantai</label>
            <input type="text" name="lantai">

            <label>Unit</label>
            <input type="text" name="unit">

            <label>Divisi Tujuan</label>
            <select name="id_divisi" required>
                <?php while ($d = $divisi->fetch_assoc()): ?>
                    <option value="<?= $d['id_divisi']; ?>">
                        <?= $d['nama_divisi']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label>Prioritas</label>
            <select name="id_prioritas" required>
                <?php while ($p = $prioritas->fetch_assoc()): ?>
                    <option value="<?= $p['id_prioritas']; ?>">
                        <?= $p['nama_prioritas']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label>Tipe Keluhan</label>
            <select name="id_tipe" required>
                <?php while ($t = $tipe->fetch_assoc()): ?>
                    <option value="<?= $t['id_tipe']; ?>">
                        <?= $t['nama_tipe']; ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label>Deskripsi Keluhan</label>
            <textarea name="deskripsi" required></textarea>

            <button type="submit">Kirim Keluhan</button>

        </form>
    </div>
</div>

</body>
</html>
