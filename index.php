<?php
declare(strict_types=1);
require_once __DIR__ . '/server/queries.php';

$heroBadge = $heroBadge ?? get_hero_badge();
$stats = $stats ?? get_stats();
$popularArticles = $popularArticles ?? get_popular_articles();
$tips = $tips ?? get_tips();
$cta = $cta ?? get_cta_banner();
$ctaHref = (string)($cta['button_href'] ?? 'komunitas.php');
if ($ctaHref !== '' && $ctaHref[0] === '/') {
  $ctaHref = substr($ctaHref, 1);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Purrfect Community – Komunitas Pecinta Kucing</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Nunito:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<nav>
  <a href="index.php" class="logo">Purrfect<span>Community</span></a>
  <ul class="nav-links" id="navLinks">
    <li><a href="index.php">🏠 Beranda</a></li>
    <li><a href="galeri.php">🐱 Galeri Kucing</a></li>
    <li><a href="favorites.php">★ Favorit</a></li>
    <li><a href="komunitas.php">💬 Komunitas</a></li>
    <li><a href="kontak.php">📬 Kontak</a></li>
    <li><a href="tentang.php">ℹ️ Tentang Kami</a></li>
  </ul>
  <button class="hamburger" id="hamburger" aria-label="menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<section class="hero">
  <div class="hero-badge"><?= htmlspecialchars($heroBadge, ENT_QUOTES, 'UTF-8') ?></div>
  <h1>Selamat Datang di<br><em>Purrfect Community</em></h1>
  <p>Tempat berkumpul para cat lover sejati. Bagikan cerita, temukan teman, dan pelajari cara merawat kucing kesayanganmu!</p>
  <div class="btn-group">
    <a href="komunitas.php" class="btn btn-primary">Gabung Komunitas</a>
    <a href="galeri.php" class="btn btn-outline">Lihat Galeri</a>
  </div>
</section>

<div class="stats">
  <?php foreach ($stats as $stat): ?>
    <div class="stat-item">
      <div class="stat-number"><?= htmlspecialchars($stat['number_text'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
      <div class="stat-label"><?= htmlspecialchars($stat['label_text'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
    </div>
  <?php endforeach; ?>
</div>

<section>
  <div class="section-header">
    <div class="section-title">📰 Artikel Populer</div>
    <p class="section-sub">Kumpulan tips & cerita menarik dari sesama cat lover.</p>
  </div>

  <div class="cards-flex">
    <?php foreach ($popularArticles as $article): ?>
      <div class="card">
        <div class="card-img" style="background:#FFF1E6;">🍽️</div>
        <div class="card-body">
          <span class="card-tag"><?= htmlspecialchars($article['tag'] ?? '', ENT_QUOTES, 'UTF-8') ?></span>
          <div class="card-title"><?= htmlspecialchars($article['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
          <p class="card-text"><?= htmlspecialchars($article['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<div class="tips-bg">
  <div class="section-header">
    <div class="section-title">💡 Tips Merawat Kucing</div>
    <p class="section-sub">Hal-hal penting yang perlu kamu ketahui sebagai cat owner.</p>
  </div>

  <div class="tips-grid">
    <?php foreach ($tips as $tip): ?>
      <div class="tip-card">
        <div class="tip-icon"><?= htmlspecialchars($tip['icon'] ?? '', ENT_QUOTES, 'UTF-8') ?></div>
        <h3><?= htmlspecialchars($tip['title'] ?? '', ENT_QUOTES, 'UTF-8') ?></h3>
        <p><?= htmlspecialchars($tip['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<div class="cta-banner">
  <h2><?= htmlspecialchars($cta['heading'] ?? '', ENT_QUOTES, 'UTF-8') ?></h2>
  <p><?= htmlspecialchars($cta['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></p>
  <a href="<?= htmlspecialchars($ctaHref, ENT_QUOTES, 'UTF-8') ?>" class="btn">
    <?= htmlspecialchars($cta['button_text'] ?? 'Daftar', ENT_QUOTES, 'UTF-8') ?>
  </a>
</div>

<footer>
  <div class="footer-grid">
    <div class="footer-col">
      <h4>Purrfect Community</h4>
      <p>Komunitas pecinta kucing yang aktif, ramah, dan penuh kasih sayang sejak 2022.</p>
    </div>
    <div class="footer-col">
      <h4>Navigasi</h4>
      <a href="index.php">Beranda</a>
      <a href="galeri.php">Galeri Kucing</a>
      <a href="komunitas.php">Komunitas</a>
      <a href="kontak.php">Kontak</a>
      <a href="tentang.php">Tentang Kami</a>
    </div>
    <div class="footer-col">
      <h4>Topik</h4>
      <a href="#">Kesehatan Kucing</a>
      <a href="#">Nutrisi & Makanan</a>
      <a href="#">Ras Kucing</a>
      <a href="#">Grooming</a>
    </div>
    <div class="footer-col">
      <h4>Kontak</h4>
      <p>📧 hello@purrfect.id</p>
      <p>📍 Samarinda, Kalimantan Timur</p>
      <p>📱 @purrfect.community</p>
    </div>
  </div>
  <div class="footer-bottom">© 2025 Purrfect Community · Dibuat dengan ❤️ untuk para cat lover</div>
</footer>

<script src="js/main.js"></script>
</body>
</html>
