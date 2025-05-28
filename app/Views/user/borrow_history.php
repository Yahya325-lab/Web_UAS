<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Riwayat Peminjaman</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">Riwayat Peminjaman Buku</h2>
  <a href="<?= site_url('user') ?>" class="btn btn-secondary mb-3">Kembali</a>

  <?php if (empty($history)) : ?>
    <div class="alert alert-info">Belum ada riwayat peminjaman.</div>
  <?php else : ?>
    <table class="table table-bordered table-hover">
      <thead class="table-dark">
        <tr>
          <th>Judul Buku</th>
          <th>Tanggal Pinjam</th>
          <th>Tanggal Kembali</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($history as $item) : ?>
          <tr>
            <td><?= esc($item['title']) ?></td>
            <td><?= date('d M Y H:i', strtotime($item['borrow_date'])) ?></td>
            <td>
              <?= $item['return_date'] ? date('d M Y H:i', strtotime($item['return_date'])) : '-' ?>
            </td>
            <td>
              <?php if ($item['return_date']) : ?>
                <span class="badge bg-success">Dikembalikan</span>
              <?php else : ?>
                <span class="badge bg-warning text-dark">Dipinjam</span>
              <?php endif; ?>
            </td>
            <td>
              <?php if (!$item['return_date']) : ?>
                <a href="<?= site_url('user/return/' . $item['id']) ?>" class="btn btn-sm btn-warning" onclick="return confirm('Yakin ingin mengembalikan buku ini?')">Kembalikan</a>
              <?php else : ?>
                <span class="text-muted">-</span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <?php endif ?>
</div>
</body>
</html>
