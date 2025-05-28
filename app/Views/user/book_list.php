<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Daftar Buku</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
.card-img-top {
    height: 200px;
    object-fit: cover;
}
</style>
</head>
<body>
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-center">Daftar Buku</h1>
        <a href="<?= site_url('user/history') ?>" class="btn btn-outline-dark">Riwayat Peminjaman</a>
    </div>

    <div class="row row-cols-1 row-cols-md-5 g-4">
        <?php foreach ($books as $book): ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="<?= base_url('writable/uploads/' . $book['image']) ?>" class="card-img-top" alt="<?= esc($book['title']) ?>">
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
