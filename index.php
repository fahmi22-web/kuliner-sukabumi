<?php
require __DIR__ . '/config.php';
$judul = 'Beranda';
$q = trim($_GET['q'] ?? '');
$kat = trim($_GET['kategori'] ?? '');

$sql = "SELECT * FROM kuliner WHERE 1=1";
$par = [];
if ($q !== '')   { $sql .= " AND (nama LIKE ? OR lokasi LIKE ?)"; $par[] = "%$q%"; $par[] = "%$q%"; }
if ($kat !== '') { $sql .= " AND kategori = ?"; $par[] = $kat; }
$sql .= " ORDER BY nama";
$st = $pdo->prepare($sql); $st->execute($par);
$data = $st->fetchAll();
$kats = $pdo->query("SELECT DISTINCT kategori FROM kuliner ORDER BY kategori")->fetchAll(PDO::FETCH_COLUMN);

// Foto slide otomatis dari folder assets/slide/
$slides = glob(__DIR__ . '/assets/slide/*.{jpg,jpeg,png,webp}', GLOB_BRACE) ?: [];

include __DIR__ . '/includes/header.php';
?>
<section class="hero">
  <div class="slides">
    <?php foreach ($slides as $n => $file): ?>
      <div class="slide <?= $n === 0 ? 'on' : '' ?>"
           style="background-image:url('assets/slide/<?= rawurlencode(basename($file)) ?>')"></div>
    <?php endforeach; ?>
  </div>

  <div class="hero-isi">
    <h1>Food Hunter Sukabumi</h1>
    <p>Kumpulan rekomendasi kuliner streetfood di Kota Sukabumi. Cari, pilih, lalu berangkat!</p>
    <form class="search" method="get">
      <input type="text" name="q" placeholder="Cari nama atau lokasi..." value="<?= e($q) ?>">
      <select name="kategori">
        <option value="">Semua kategori</option>
        <?php foreach ($kats as $k): ?>
          <option <?= $k === $kat ? 'selected' : '' ?>><?= e($k) ?></option>
        <?php endforeach; ?>
      </select>
      <button class="btn">Cari</button>
    </form>
  </div>
</section>

<main class="wrap">
  <div class="chips">
    <a class="chip <?= $kat === '' ? 'on' : '' ?>" href="index.php">Semua</a>
    <?php foreach ($kats as $k): ?>
      <a class="chip <?= $k === $kat ? 'on' : '' ?>" href="?kategori=<?= urlencode($k) ?>"><?= ikon($k) ?> <?= e($k) ?></a>
    <?php endforeach; ?>
  </div>

  <?php if (!$data): ?>
    <p class="muted">Belum ada data yang cocok.</p>
  <?php endif; ?>

  <div class="grid">
    <?php foreach ($data as $r): ?>
      <a class="card" href="detail.php?id=<?= (int)$r['id'] ?>">
        <div class="ic"><?= ikon($r['kategori']) ?></div>
        <span class="tag"><?= e($r['kategori']) ?></span>
        <h3><?= e($r['nama']) ?></h3>
        <div class="muted">📍 <?= e($r['lokasi']) ?></div>
        <div class="muted">🕒 <?= e($r['jam_buka'] ?: '-') ?></div>
        <div class="muted">💰 <?= e($r['harga'] ?: '-') ?></div>
      </a>
    <?php endforeach; ?>
  </div>
</main>

<script>
const slides = document.querySelectorAll('.slide');
let idx = 0;
if (slides.length > 1) {
  setInterval(() => {
    slides[idx].classList.remove('on');
    idx = (idx + 1) % slides.length;
    slides[idx].classList.add('on');
  }, 4000);
}
</script>
<?php include __DIR__ . '/includes/footer.php'; ?>