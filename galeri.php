<?php
declare(strict_types=1);
require_once __DIR__ . '/server/queries.php';

$catRaces = get_cat_races();
$raceIds = array_map(static fn($r) => (int)$r['id'], $catRaces);
$traitsByRaceId = get_cat_race_traits_by_race_ids($raceIds);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Galeri Kucing – Purrfect Community</title>
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

<div class="page-hero">
  <h1>🐱 Galeri Ras Kucing</h1>
  <p>Kenali berbagai ras kucing populer beserta sifat dan keunikannya masing-masing.</p>
</div>

<div class="filter-bar" role="group" aria-label="Filter Ras Kucing">
  <button class="filter-btn active" type="button">Semua</button>
  <button class="filter-btn" type="button">Ras Lokal</button>
  <button class="filter-btn" type="button">Ras Impor</button>
  <button class="filter-btn" type="button">Berbulu Panjang</button>
  <button class="filter-btn" type="button">Berbulu Pendek</button>
</div>

<section>
  <div class="cat-grid">
    <?php foreach ($catRaces as $race): ?>
      <?php
        $raceId = (int)($race['id'] ?? 0);
        $badge = (string)($race['category'] ?? '');
        $emoji = (string)($race['emoji'] ?? '');
        $colorBg = (string)($race['color_bg'] ?? '#FFF1E6');
        $traits = $traitsByRaceId[$raceId] ?? [];
      ?>
      <div class="cat-card">
        <div class="cat-emoji-wrap" style="background:<?= htmlspecialchars($colorBg, ENT_QUOTES, 'UTF-8') ?>;">
          <span><?= htmlspecialchars($emoji, ENT_QUOTES, 'UTF-8') ?></span>
          <span class="cat-badge"><?= htmlspecialchars($badge, ENT_QUOTES, 'UTF-8') ?></span>
        </div>
        <div class="cat-info">
          <div class="cat-name-row" style="display:flex; align-items:center; justify-content:space-between; gap:12px;">
            <div class="cat-name"><?= htmlspecialchars((string)$race['name'], ENT_QUOTES, 'UTF-8') ?></div>
            <button
              type="button"
              class="fav-toggle"
              data-race-id="<?= (int)$raceId ?>"
              aria-label="Simpan favorit"
              aria-pressed="false"
              title="Simpan favorit"
            >
              ☆
            </button>
          </div>
          <div class="cat-origin"><?= htmlspecialchars((string)$race['origin'], ENT_QUOTES, 'UTF-8') ?></div>
          <div class="cat-desc"><?= htmlspecialchars((string)$race['description'], ENT_QUOTES, 'UTF-8') ?></div>
          <div class="cat-traits">
            <?php foreach ($traits as $trait): ?>
              <span class="trait"><?= htmlspecialchars($trait, ENT_QUOTES, 'UTF-8') ?></span>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<div class="adopt-section">
  <h2>🏠 Mau Adopsi Kucing?</h2>
  <p>Bergabung dengan program adopsi komunitas kami dan berikan rumah hangat untuk kucing yang membutuhkan kasih sayang.</p>
  <a href="kontak.php" class="btn btn-sage">Hubungi Kami</a>
</div>

<footer class="compact">
  <div class="footer-logo">Purrfect Community</div>
  <div class="footer-links">
    <a href="index.php">Beranda</a>
    <a href="galeri.php">Galeri</a>
    <a href="komunitas.php">Komunitas</a>
    <a href="kontak.php">Kontak</a>
    <a href="tentang.php">Tentang</a>
  </div>
  <div class="footer-bottom">© 2025 Purrfect Community · Samarinda, Kalimantan Timur</div>
</footer>

<script src="js/main.js"></script>
</body>
</html>
