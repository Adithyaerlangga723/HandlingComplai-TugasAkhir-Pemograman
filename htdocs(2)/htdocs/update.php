<?php
require_once 'koneksi.php';

$id = intval($_GET['id']);
$data = $conn->query("SELECT * FROM keluhan WHERE id_keluhan=$id")->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $deskripsi = $_POST['deskripsi'];
    $id_prioritas = intval($_POST['id_prioritas']);

    $stmt = $conn->prepare("
        UPDATE keluhan 
        SET nama=?, deskripsi=?, id_prioritas=? 
        WHERE id_keluhan=?
    ");
    $stmt->bind_param("ssii", $nama, $deskripsi, $id_prioritas, $id);
    $stmt->execute();

    header("Location: keluhan_list.php");
    exit;
}

$prioritas = $conn->query("SELECT * FROM prioritas");
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Keluhan</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-4">
<h3>Edit Keluhan</h3>

<form method="POST">
  <div class="mb-3">
    <label>Nama</label>
    <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>">
  </div>

  <div class="mb-3">
    <label>Prioritas</label>
    <select name="id_prioritas" class="form-select">
      <?php while($p=$prioritas->fetch_assoc()): ?>
        <option value="<?= $p['id_prioritas'] ?>" 
          <?= $p['id_prioritas']==$data['id_prioritas']?'selected':'' ?>>
          <?= htmlspecialchars($p['nama_prioritas']) ?>
        </option>
      <?php endwhile; ?>
    </select>
  </div>

  <div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="deskripsi" class="form-control"><?= htmlspecialchars($data['deskripsi']) ?></textarea>
  </div>

  <button class="btn btn-success">Update</button>
  <a href="keluhan_list.php" class="btn btn-secondary">Kembali</a>
</form>
</div>
</body>
</html>
