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
  <?php
    $racesById = [];
    foreach ($catRaces as $r) {
        $raceId = (int)($r['id'] ?? 0);
        if ($raceId > 0) {
            $racesById[$raceId] = $r;
        }
    }
  ?>
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
<script>
document.addEventListener('DOMContentLoaded', () => {
  const FAVORITES_KEY = 'purrfect_favorites_race_ids_v1';
  const grid = document.getElementById('favorites-grid');
  const empty = document.getElementById('favorites-empty');
  const clearAll = document.getElementById('favorites-clear-all');
  const racesById = window.__CAT_RACES_BY_ID__ || {};
  const esc = (value) => String(value ?? '').replace(/[&<>"']/g, (c) => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[c]));

  function readFavorites() {
    try {
      const raw = localStorage.getItem(FAVORITES_KEY);
      const arr = raw ? JSON.parse(raw) : [];
      return Array.isArray(arr) ? arr.map(String) : [];
    } catch {
      return [];
    }
  }

  function writeFavorites(ids) {
    localStorage.setItem(FAVORITES_KEY, JSON.stringify(ids));
  }

  function render() {
    if (!grid) return;
    const ids = readFavorites();
    grid.innerHTML = '';
    if (!ids.length) {
      if (empty) empty.style.display = 'block';
      return;
    }
    if (empty) empty.style.display = 'none';
    ids.forEach((id) => {
      const race = racesById[id];
      if (!race) return;
      const card = document.createElement('div');
      card.className = 'cat-card';
      card.innerHTML = `
        <div class="cat-emoji-wrap" style="background:${esc(race.color_bg || '#FFF1E6')};">
          <span>${esc(race.emoji)}</span>
          <span class="cat-badge">${esc(race.category)}</span>
        </div>
        <div class="cat-info">
          <div class="cat-name-row" style="display:flex; align-items:center; justify-content:space-between; gap:12px;">
            <div class="cat-name">${esc(race.name)}</div>
            <button type="button" class="fav-toggle" data-race-id="${esc(id)}" aria-label="Hapus favorit" aria-pressed="true" title="Hapus favorit">â˜…</button>
          </div>
          <div class="cat-origin">${esc(race.origin)}</div>
          <div class="cat-desc">${esc(race.description)}</div>
          <div class="cat-traits"></div>
        </div>`;
      grid.appendChild(card);
    });
    grid.querySelectorAll('.fav-toggle').forEach((btn) => {
      btn.addEventListener('click', () => {
        const id = String(btn.getAttribute('data-race-id') || '');
        writeFavorites(readFavorites().filter((item) => item !== id));
        render();
      });
    });
  }

  clearAll?.addEventListener('click', () => {
    writeFavorites([]);
    render();
  });
  render();
});
</script>
