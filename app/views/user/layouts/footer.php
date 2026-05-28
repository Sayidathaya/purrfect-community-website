<?php if (($view ?? '') === 'user/beranda/index'): ?>
<footer>
  <div class="footer-grid">
    <div class="footer-col">
      <h4>Purrfect Community</h4>
      <p>Komunitas pecinta kucing yang aktif, ramah, dan penuh kasih sayang sejak 2022.</p>
    </div>
    <div class="footer-col">
      <h4>Navigasi</h4>
      <a href="<?= BASE_URL ?>/">Beranda</a>
      <a href="<?= BASE_URL ?>/galeri">Galeri Kucing</a>
      <a href="<?= BASE_URL ?>/komunitas">Komunitas</a>
      <a href="<?= BASE_URL ?>/kontak">Kontak</a>
      <a href="<?= BASE_URL ?>/tentang">Tentang Kami</a>
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
      <p>Email: hello@purrfect.id</p>
      <p>Lokasi: Samarinda, Kalimantan Timur</p>
      <p>@purrfect.community</p>
    </div>
  </div>
  <div class="footer-bottom">&copy; 2025 Purrfect Community - Dibuat dengan cinta untuk para cat lover</div>
</footer>
<?php else: ?>
<footer class="compact">
  <div class="footer-logo">Purrfect Community</div>
  <div class="footer-links">
    <a href="<?= BASE_URL ?>/">Beranda</a>
    <a href="<?= BASE_URL ?>/galeri">Galeri</a>
    <a href="<?= BASE_URL ?>/komunitas">Komunitas</a>
    <a href="<?= BASE_URL ?>/kontak">Kontak</a>
    <a href="<?= BASE_URL ?>/tentang">Tentang</a>
  </div>
  <div class="footer-bottom">&copy; 2025 Purrfect Community - Samarinda, Kalimantan Timur</div>
</footer>
<?php endif; ?>

<script src="<?= BASE_URL ?>/assets/js/main.js"></script>
</body>
</html>
