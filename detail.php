<?php
require __DIR__ . '/config.php';
$st = $pdo->prepare("SELECT * FROM kuliner WHERE id = ?");
$st->execute([(int)($_GET['id'] ?? 0)]);
$r = $st->fetch();
if (!$r) { http_response_code(404); die('Data tidak ditemukan. <a href="index.php">Kembali</a>'); }
$judul = $r['nama'];
include __DIR__ . '/includes/header.php';
?>
<main class="wrap">
  <a href="index.php">← Kembali</a>
  <div class="box" style="margin-top:14px">
    <div style="font-size:3rem"><?= ikon($r['kategori']) ?></div>
    <span class="tag"><?= e($r['kategori']) ?></span>
    <h1><?= e($r['nama']) ?></h1>
    <p>📍 <?= e($r['lokasi']) ?></p>
    <p>🕒 Jam buka: <?= e($r['jam_buka'] ?: '-') ?></p>
    <p>💰 Kisaran harga: <?= e($r['harga'] ?: '-') ?></p>
    <p><?= nl2br(e($r['deskripsi'])) ?></p>
    <?php $maps = $r['maps_link'] ?: 'https://www.google.com/maps/search/' . urlencode($r['nama'] . ' Sukabumi'); ?>
    <a class="btn" target="_blank" rel="noopener" href="<?= e($maps) ?>">Buka di Google Maps</a>
  </div>
</main>
<?php include __DIR__ . '/includes/footer.php'; ?>
