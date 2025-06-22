<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Daftar Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" 
  rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    .card-img-top {
      height: 200px;
      object-fit: cover;
    }
    .nav-link.active {
      font-weight: bold;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-gradient shadow-sm py-3">
  <div class="container">
    <a class="navbar-brand fw-bold" href="<?= site_url('user') ?>">
      <i class="bi bi-book-half me-2"></i>Pelita Literasi
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li>
          <form action="<?= site_url('user') ?>" method="get" class="mb-4 d-flex justify-content-center">
            <input type="text" name="q" class="form-control me-2 w-50" placeholder="Cari judul buku..." value="<?= esc($q ?? '') ?>">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
          </form>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold <?= current_url() == site_url('user') ? 'active text-primary' : '' ?>" href="<?= site_url('user') ?>">
            <i class="bi bi-book me-1"></i>Daftar Buku
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold <?= current_url() == site_url('user/pinjam') ? 'active text-primary' : '' ?>" href="<?= site_url('user/pinjam') ?>">
            <i class="bi bi-journal-arrow-down me-1"></i>Buku yang Dipinjam
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold <?= current_url() == site_url('user/history') ? 'active text-primary' : '' ?>" href="<?= site_url('user/history') ?>">
            <i class="bi bi-clock-history me-1"></i>Riwayat Peminjaman
          </a>
        </li>
        <li class="nav-item ms-3">
          <a class="btn btn-outline-light fw-semibold" href="<?= site_url('logout') ?>">
            <i class="bi bi-box-arrow-right me-1"></i>Logout
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Konten -->
<div class="container py-5">
  <h2 class="mb-4 text-center">Daftar Buku</h2>
  <div class="row row-cols-1 row-cols-md-5 g-4">
    <?php foreach ($books as $book): ?>
      <div class="col">
        <div class="card h-100 shadow-sm">
          <img src="<?= base_url('uploads/' . $book['image']) ?>" class="card-img-top" alt="<?= esc($book['title']) ?>">
          <div class="card-body">
            <h5 class="card-title"><?= esc($book['title']) ?></h5>
            <p class="card-text text-truncate"><?= esc($book['description']) ?></p>
            <a href="<?= site_url('user/detail/' . $book['id']) ?>" class="btn btn-primary">Detail</a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
