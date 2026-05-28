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
        $traits = $race['traits'] ?? [];
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
  <a href="<?= BASE_URL ?>/kontak" class="btn btn-sage">Hubungi Kami</a>
</div>
