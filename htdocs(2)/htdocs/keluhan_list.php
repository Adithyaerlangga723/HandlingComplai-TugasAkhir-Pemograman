<?php
require 'auth.php';

$data = $conn->query("
    SELECT k.*, 
           d.nama_divisi,
           p.nama_prioritas,
           t.nama_tipe,
           s.nama_status
    FROM keluhan k
    JOIN divisi d ON k.id_divisi = d.id_divisi
    JOIN prioritas p ON k.id_prioritas = p.id_prioritas
    JOIN tipe_keluhan t ON k.id_tipe = t.id_tipe
    JOIN status_keluhan s ON k.id_status = s.id_status
    ORDER BY k.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>List Keluhan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <span>List Keluhan</span>
    <a href="dashboard.php">Dashboard</a>
</div>

<div class="container">
<table>
    <tr>
        <th>Tanggal</th>
        <th>Nama</th>
        <th>Divisi</th>
        <th>Prioritas</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    <?php while ($r = $data->fetch_assoc()): ?>
    <tr>
        <td><?= $r['created_at']; ?></td>
        <td><?= $r['nama']; ?></td>
        <td><?= $r['nama_divisi']; ?></td>
        <td><?= $r['nama_prioritas']; ?></td>
        <td><?= $r['nama_status']; ?></td>
        <td>
            <a href="keluhan_detail.php?id=<?= $r['id_keluhan']; ?>">Detail</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</div>

</body>
</html>
