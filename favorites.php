<?php
declare(strict_types=1);
require_once __DIR__ . '/server/queries.php';

// We fetch races only so we can display names/emojis/colors for favorites.
// This is read-only; it does not modify SQL or schema.
$catRaces = get_cat_races();

// Map for quick lookup by id
$racesById = [];
foreach ($catRaces as $r) {
  $raceId = (int)($r['id'] ?? 0);
  if ($raceId > 0) $racesById[$raceId] = $r;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Favorit Kucing – Purrfect Community</title>
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
  <h1>★ Ras Kucing Favorit Kamu</h1>
  <p>Daftar ras yang kamu simpan dari halaman Galeri. Akan tetap tersimpan setelah refresh.</p>
</div>

<section>
  <div class="content-wrap">
    <div class="main-col">
      <div class="section-title">💖 Koleksi Favorit</div>

      <div id="favorites-empty" style="margin-top:14px; display:none;">
        Kamu belum menyimpan favorit apa pun. Coba pilih bintang (☆/★) di halaman Galeri.
      </div>

      <div id="favorites-grid" class="cat-grid" style="margin-top:16px;"></div>
    </div>

    <div class="side-col">
      <div class="join-card">
        <h3>🎯 Tips Cepat</h3>
        <p>Kamu bisa menghapus favorit langsung dari daftar ini (klik ★ pada card).</p>
        <button type="button" class="btn btn-light" id="favorites-clear-all">
          Hapus semua favorit
        </button>
      </div>
    </div>
  </div>
</section>

<script>
  // Expose races data for client rendering without extra HTTP calls.
  window.__CAT_RACES_BY_ID__ = <?=
    json_encode(
      array_map(static function($r) {
        return [
          'id' => (int)($r['id'] ?? 0),
          'name' => (string)($r['name'] ?? ''),
          'origin' => (string)($r['origin'] ?? ''),
          'description' => (string)($r['description'] ?? ''),
          'category' => (string)($r['category'] ?? ''),
          'emoji' => (string)($r['emoji'] ?? ''),
          'color_bg' => (string)($r['color_bg'] ?? '')
        ];
      }, $racesById),
      JSON_UNESCAPED_UNICODE
    )
  ?>;
</script>

<script src="js/main.js"></script>
</body>
</html>
