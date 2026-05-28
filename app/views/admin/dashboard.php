<?php
$labels = array_map(static fn($row) => (string)$row['month_label'], $chartRows ?? []);
$chartData = array_map(static fn($row) => (int)$row['total'], $chartRows ?? []);
?>
<div class="row g-3 mb-3">
  <div class="col-md-3">
    <div class="admin-card metric-card">
      <div class="text-muted">Ras Kucing</div>
      <div class="metric-value"><?= (int)($counts['cat_races'] ?? 0) ?></div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="admin-card metric-card">
      <div class="text-muted">Diskusi Forum</div>
      <div class="metric-value"><?= (int)($counts['threads'] ?? 0) ?></div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="admin-card metric-card">
      <div class="text-muted">Event</div>
      <div class="metric-value"><?= (int)($counts['events'] ?? 0) ?></div>
    </div>
  </div>
  <div class="col-md-3">
    <div class="admin-card metric-card">
      <div class="text-muted">Pesan Belum Dibaca</div>
      <div class="metric-value"><?= (int)($counts['unread_messages'] ?? 0) ?></div>
    </div>
  </div>
</div>

<div class="row g-3">
  <div class="col-lg-7">
    <div class="admin-card">
      <h2 class="h5 mb-3">Grafik Upload per Bulan</h2>
      <canvas id="monthlyChart" height="130"></canvas>
    </div>
  </div>
  <div class="col-lg-5">
    <div class="admin-card">
      <h2 class="h5 mb-3">5 Pesan Terbaru</h2>
      <div class="table-responsive">
        <table class="table table-sm">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Topik</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($latestMessages as $message): ?>
              <tr>
                <td><?= h($message['name'] ?? '') ?></td>
                <td><?= h($message['topic'] ?? '') ?></td>
                <td><?= h($message['created_at'] ?? '') ?></td>
              </tr>
            <?php endforeach; ?>
            <?php if (empty($latestMessages)): ?>
              <tr><td colspan="3" class="text-muted">Belum ada pesan.</td></tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const ctx = document.getElementById('monthlyChart');
  if (!ctx) return;
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?= json_encode($labels) ?>,
      datasets: [{
        label: 'Upload',
        data: <?= json_encode($chartData) ?>,
        borderColor: '#6c5ce7',
        backgroundColor: 'rgba(108, 92, 231, .12)',
        tension: .35,
        fill: true
      }]
    },
    options: {
      responsive: true,
      plugins: { legend: { display: false } },
      scales: { y: { beginAtZero: true, ticks: { precision: 0 } } }
    }
  });
});
</script>
