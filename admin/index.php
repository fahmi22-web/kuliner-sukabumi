<?php
require __DIR__ . '/../config.php';
wajib_login();
$base = '../'; $judul = 'Dashboard Admin';
$data = $pdo->query("SELECT id, nama, kategori, lokasi FROM kuliner ORDER BY id DESC")->fetchAll();
include __DIR__ . '/../includes/header.php';
?>
<main class="wrap">
  <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:10px">
    <h2>Dashboard Admin (<?= e($_SESSION['admin']) ?>)</h2>
    <div><a class="btn" href="form.php">+ Tambah</a> <a class="btn sec" href="logout.php">Logout</a></div>
  </div>
  <?php if (isset($_GET['ok'])): ?><div class="alert ok">Perubahan berhasil disimpan.</div><?php endif; ?>
  <div class="box" style="overflow-x:auto">
    <table>
      <tr><th>Nama</th><th>Kategori</th><th>Lokasi</th><th>Aksi</th></tr>
      <?php foreach ($data as $r): ?>
      <tr>
        <td><?= e($r['nama']) ?></td><td><?= e($r['kategori']) ?></td><td><?= e($r['lokasi']) ?></td>
        <td style="white-space:nowrap">
          <a class="btn sec" href="form.php?id=<?= (int)$r['id'] ?>">Edit</a>
          <form method="post" action="hapus.php" style="display:inline" onsubmit="return confirm('Hapus data ini?')">
            <input type="hidden" name="csrf" value="<?= csrf() ?>">
            <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
            <button class="btn del">Hapus</button>
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
