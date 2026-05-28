<?php
$pageTitle = $title ?? 'Admin Purrfect Community';
$admin = $_SESSION['admin'] ?? ['nama' => 'Admin', 'username' => 'admin'];
$initial = strtoupper(substr((string)($admin['nama'] ?? 'A'), 0, 1));
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= h($pageTitle) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/admin.css">
</head>
<body>
<div class="admin-shell">
  <aside class="admin-sidebar">
    <div class="admin-brand">Purrfect<span>Admin</span></div>
    <div class="d-flex align-items-center gap-3 mb-4">
      <div class="admin-avatar"><?= h($initial) ?></div>
      <div>
        <div class="fw-bold"><?= h($admin['nama'] ?? 'Admin') ?></div>
        <small class="text-white-50">@<?= h($admin['username'] ?? 'admin') ?></small>
      </div>
    </div>
    <nav class="admin-nav">
      <a href="<?= BASE_URL ?>/admin/dashboard">Dashboard</a>
      <a href="<?= BASE_URL ?>/admin/beranda">Beranda</a>
      <a href="<?= BASE_URL ?>/admin/galeri">Galeri</a>
      <a href="<?= BASE_URL ?>/admin/komunitas">Komunitas</a>
      <a href="<?= BASE_URL ?>/admin/kontak">Kontak</a>
      <a href="<?= BASE_URL ?>/admin/tentang">Tentang</a>
      <form method="POST" action="<?= BASE_URL ?>/admin/logout" class="mt-3">
        <?= csrf_field() ?>
        <button type="submit" class="admin-logout">Logout</button>
      </form>
    </nav>
  </aside>
  <main class="admin-main">
    <div class="d-flex align-items-center justify-content-between gap-3 mb-4">
      <div>
        <h1 class="h3 mb-1"><?= h($pageTitle) ?></h1>
        <div class="text-muted">Kelola konten Purrfect Community.</div>
      </div>
      <a href="<?= BASE_URL ?>/" class="btn btn-outline-secondary" target="_blank">Lihat Situs</a>
    </div>

    <?php if (!empty($_SESSION['success'])): ?>
      <div class="alert alert-success"><?= h($_SESSION['success']) ?></div>
    <?php endif; ?>
    <?php if (!empty($_SESSION['error'])): ?>
      <div class="alert alert-danger"><?= h($_SESSION['error']) ?></div>
    <?php endif; ?>
