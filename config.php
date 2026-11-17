<?php
session_start();

// === UBAH BAGIAN INI SAAT HOSTING ===
define('DB_HOST', 'localhost');
define('DB_NAME', 'kuliner_sukabumi');
define('DB_USER', 'root');
define('DB_PASS', '');
// ====================================

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die('Koneksi database gagal. Periksa config.php dan pastikan MySQL menyala.');
}

function e($s) { return htmlspecialchars((string)$s, ENT_QUOTES, 'UTF-8'); }

function csrf() {
    if (empty($_SESSION['csrf'])) $_SESSION['csrf'] = bin2hex(random_bytes(16));
    return $_SESSION['csrf'];
}
function cek_csrf() {
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) die('Token tidak valid.');
}
function wajib_login() {
    if (empty($_SESSION['admin'])) { header('Location: login.php'); exit; }
}
function ikon($k) {
    $m = ['Sate'=>'🍢','Mie'=>'🍜','Ayam & Bebek'=>'🍗','Nasi & Kwetiaw'=>'🍳','Cuankie'=>'🥟','Pecel'=>'🥗','Cemilan'=>'🍿'];
    return $m[$k] ?? '🍽️';
}
