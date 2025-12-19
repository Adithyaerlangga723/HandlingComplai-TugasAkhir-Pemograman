<?php
require_once 'koneksi.php';

$keyword = $_GET['q'] ?? '';

$sql = "
SELECT k.*, d.nama_divisi, p.nama_prioritas, t.nama_tipe, s.nama_status
FROM keluhan k
JOIN divisi d ON k.id_divisi = d.id_divisi
JOIN prioritas p ON k.id_prioritas = p.id_prioritas
JOIN tipe_keluhan t ON k.id_tipe = t.id_tipe
JOIN status_keluhan s ON k.id_status = s.id_status
WHERE 
    k.nama LIKE ?
    OR k.perusahaan LIKE ?
    OR k.unit LIKE ?
    OR t.nama_tipe LIKE ?
ORDER BY k.created_at DESC
";

$stmt = $conn->prepare($sql);
$search = "%$keyword%";
$stmt->bind_param("ssss", $search, $search, $search, $search);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Daftar Keluhan</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-4">
<h3>Daftar Keluhan Tenant</h3>

<form class="mb-3" method="GET">
  <div class="input-group">
    <input type="text" name="q" class="form-control" placeholder="Cari nama / perusahaan / unit / tipe" value="<?= htmlspecialchars($keyword) ?>">
    <button class="btn btn-primary">Search</button>
  </div>
</form>

<table class="table table-bordered table-striped">
<thead class="table-dark">
<tr>
  <th>No</th>
  <th>Nama</th>
  <th>Perusahaan</th>
  <th>Unit</th>
  <th>Divisi</th>
  <th>Tipe</th>
  <th>Prioritas</th>
  <th>Status</th>
  <th>Aksi</th>
</tr>
</thead>
<tbody>
<?php $no=1; while($row = $result->fetch_assoc()): ?>
<tr>
  <td><?= $no++ ?></td>
  <td><?= htmlspecialchars($row['nama']) ?></td>
  <td><?= htmlspecialchars($row['perusahaan']) ?></td>
  <td><?= htmlspecialchars($row['unit']) ?></td>
  <td><?= htmlspecialchars($row['nama_divisi']) ?></td>
  <td><?= htmlspecialchars($row['nama_tipe']) ?></td>
  <td><?= htmlspecialchars($row['nama_prioritas']) ?></td>
  <td><?= htmlspecialchars($row['nama_status']) ?></td>
  <td>
    <a href="keluhan_edit.php?id=<?= $row['id_keluhan'] ?>" class="btn btn-sm btn-warning">Edit</a>
    <a href="keluhan_delete.php?id=<?= $row['id_keluhan'] ?>" 
       onclick="return confirm('Hapus data ini?')" 
       class="btn btn-sm btn-danger">Hapus</a>
  </td>
</tr>
<?php endwhile; ?>
</tbody>
</table>
</div>
</body>
</html>
