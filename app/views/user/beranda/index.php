<?php
$ctaHref = (string)($cta['button_href'] ?? '/komunitas');
$ctaHref = str_replace(['index.php', 'galeri.php', 'favorites.php', 'komunitas.php', 'kontak.php', 'tentang.php', 'komunitas.html'], ['/', '/galeri', '/favorit', '/komunitas', '/kontak', '/tentang', '/komunitas'], $ctaHref);
if ($ctaHref === '' || $ctaHref[0] !== '/') {
    $ctaHref = '/' . ltrim($ctaHref, '/');
}
$ctaHref = BASE_URL . $ctaHref;
?>
<section class="hero">
  <div class="hero-badge"><?= htmlspecialchars($heroBadge, ENT_QUOTES, 'UTF-8') ?></div>
  <h1>Selamat Datang di<br><em>Purrfect Community</em></h1>
  <p>Tempat berkumpul para cat lover sejati. Bagikan cerita, temukan teman, dan pelajari cara merawat kucing kesayanganmu!</p>
  <div class="btn-group">
    <a href="<?= BASE_URL ?>/komunitas" class="btn btn-primary">Gabung Komunitas</a>
    <a href="<?= BASE_URL ?>/galeri" class="btn btn-outline">Lihat Galeri</a>
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
