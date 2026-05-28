<?php
$pageTitle = $title ?? 'Purrfect Community';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= h($pageTitle) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="icon" href="<?= BASE_URL ?>/assets/favicon.svg" type="image/svg+xml">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<nav>
  <a href="<?= BASE_URL ?>/" class="logo">Purrfect<span>Community</span></a>
  <ul class="nav-links" id="navLinks">
    <li><a href="<?= BASE_URL ?>/">Beranda</a></li>
    <li><a href="<?= BASE_URL ?>/galeri">Galeri Kucing</a></li>
    <li><a href="<?= BASE_URL ?>/favorit">Favorit</a></li>
    <li><a href="<?= BASE_URL ?>/komunitas">Komunitas</a></li>
    <li><a href="<?= BASE_URL ?>/kontak">Kontak</a></li>
    <li><a href="<?= BASE_URL ?>/tentang">Tentang Kami</a></li>
  </ul>
  <button class="hamburger" id="hamburger" aria-label="menu">
    <span></span><span></span><span></span>
  </button>
</nav>
