<?php
require __DIR__ . '/../config.php';
wajib_login();
$base = '../';
$id = (int)($_GET['id'] ?? 0);
$r = ['nama'=>'','kategori'=>'','lokasi'=>'','deskripsi'=>'','harga'=>'','jam_buka'=>'','maps_link'=>''];
if ($id) {
    $st = $pdo->prepare("SELECT * FROM kuliner WHERE id = ?"); $st->execute([$id]);
    $r = $st->fetch() ?: die('Data tidak ditemukan.');
}
$judul = $id ? 'Edit Kuliner' : 'Tambah Kuliner';
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cek_csrf();
    $f = [];
    foreach (['nama','kategori','lokasi','deskripsi','harga','jam_buka','maps_link'] as $k) $f[$k] = trim($_POST[$k] ?? '');
    if ($f['nama'] === '' || $f['kategori'] === '' || $f['lokasi'] === '') {
        $err = 'Nama, kategori, dan lokasi wajib diisi.'; $r = $f;
    } elseif ($f['maps_link'] !== '' && !preg_match('#^https?://#i', $f['maps_link'])) {
        $err = 'Link Maps harus diawali http:// atau https://'; $r = $f;
    } else {
        if ($id) {
            $pdo->prepare("UPDATE kuliner SET nama=?,kategori=?,lokasi=?,deskripsi=?,harga=?,jam_buka=?,maps_link=? WHERE id=?")
                ->execute([...array_values($f), $id]);
        } else {
            $pdo->prepare("INSERT INTO kuliner (nama,kategori,lokasi,deskripsi,harga,jam_buka,maps_link) VALUES (?,?,?,?,?,?,?)")
                ->execute(array_values($f));
        }
        header('Location: index.php?ok=1'); exit;
    }
}
$opsi = ['Sate','Mie','Ayam & Bebek','Nasi & Kwetiaw','Cuankie','Cemilan','Pecel'];
include __DIR__ . '/../includes/header.php';
?>
<main class="wrap">
  <form class="box form" method="post" style="max-width:640px;margin-top:10px">
    <h2><?= e($judul) ?></h2>
    <?php if ($err): ?><div class="alert"><?= e($err) ?></div><?php endif; ?>
    <input type="hidden" name="csrf" value="<?= csrf() ?>">
    <label>Nama</label><input name="nama" value="<?= e($r['nama']) ?>" required>
    <label>Kategori</label>
    <select name="kategori" required>
      <?php foreach ($opsi as $o): ?><option <?= $o === $r['kategori'] ? 'selected' : '' ?>><?= e($o) ?></option><?php endforeach; ?>
    </select>
    <label>Lokasi</label><input name="lokasi" value="<?= e($r['lokasi']) ?>" required>
    <label>Jam buka</label><input name="jam_buka" value="<?= e($r['jam_buka']) ?>" placeholder="mis. 17.00 - 23.00">
    <label>Kisaran harga</label><input name="harga" value="<?= e($r['harga']) ?>" placeholder="mis. Rp 15.000 - 30.000">
    <label>Link Google Maps (opsional)</label><input name="maps_link" value="<?= e($r['maps_link']) ?>">
    <label>Deskripsi</label><textarea name="deskripsi" rows="5"><?= e($r['deskripsi']) ?></textarea>
    <p><button class="btn">Simpan</button> <a class="btn sec" href="index.php">Batal</a></p>
  </form>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
