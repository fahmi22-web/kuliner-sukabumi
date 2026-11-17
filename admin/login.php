<?php
require __DIR__ . '/../config.php';
$base = '../'; $judul = 'Login Admin';
if (!empty($_SESSION['admin'])) { header('Location: index.php'); exit; }
$err = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cek_csrf();
    $st = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $st->execute([trim($_POST['username'] ?? '')]);
    $u = $st->fetch();
    if ($u && password_verify($_POST['password'] ?? '', $u['password'])) {
        session_regenerate_id(true);
        $_SESSION['admin'] = $u['username'];
        header('Location: index.php'); exit;
    }
    $err = 'Username atau password salah.';
}
include __DIR__ . '/../includes/header.php';
?>
<main class="wrap">
  <form class="box form" method="post">
    <h2>🔐 Login Admin</h2>
    <?php if ($err): ?><div class="alert"><?= e($err) ?></div><?php endif; ?>
    <input type="hidden" name="csrf" value="<?= csrf() ?>">
    <label>Username</label><input name="username" required autofocus>
    <label>Password</label><input type="password" name="password" required>
    <p><button class="btn">Masuk</button></p>
  </form>
</main>
<?php include __DIR__ . '/../includes/footer.php'; ?>
