<?php
require __DIR__ . '/../config.php';
wajib_login();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    cek_csrf();
    $pdo->prepare("DELETE FROM kuliner WHERE id = ?")->execute([(int)($_POST['id'] ?? 0)]);
}
header('Location: index.php?ok=1');
