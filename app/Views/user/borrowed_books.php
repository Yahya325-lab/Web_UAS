<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Buku yang Sedang Dipinjam</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4">Buku yang Sedang Dipinjam</h2>
  <a href="<?= site_url('user') ?>" class="btn btn-secondary mb-3">Kembali ke Daftar Buku</a>

  <?php if (empty($books)) : ?>
    <div class="alert alert-info">Kamu belum meminjam buku apapun.</div>
  <?php else : ?>
    <div class="row row-cols-1 row-cols-md-5 g-4">
      <?php foreach ($books as $book): ?>
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="<?= base_url('uploads/' . $book['image']) ?>" class="card-img-top" alt="<?= esc($book['title']) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= esc($book['title']) ?></h5>
              <p class="card-text"><small>Dipinjam pada: <?= date('d M Y H:i', strtotime($book['borrow_date'])) ?></small></p>
              <a href="<?= site_url('user/returnBook/' . $book['borrow_id']) ?>" class="btn btn-danger" onclick="return confirm('Kembalikan buku ini?')">Kembalikan</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
</body>
</html>
