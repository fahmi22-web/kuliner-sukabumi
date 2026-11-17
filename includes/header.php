<?php $base = $base ?? ''; ?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($judul ?? 'Jajan Sukabumi') ?> | Streetfood Sukabumi</title>
<link rel="stylesheet" href="<?= $base ?>assets/style.css">
</head>
<body>
<header class="nav">
  <a class="logo" href="<?= $base ?>index.php">FOOD HUNTER SUKABUMI</a>
  <nav>
    <a href="<?= $base ?>index.php">Beranda</a>
    <a href="<?= $base ?>admin/">Admin</a>
  </nav>
</header>
