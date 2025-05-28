<!DOCTYPE html> 
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Detail Buku</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
.img-book {
    max-height: 300px;
    object-fit: cover;
}
</style>
</head>
<body>
<div class="container py-5">
    <a href="<?= site_url('user') ?>" class="btn btn-secondary mb-4">Kembali</a>
    <div class="card shadow-lg">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?= base_url('uploads/' . $book['image']) ?>" class="img-fluid img-book" alt="<?= esc($book['title']) ?>">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h2 class="card-title"><?= esc($book['title']) ?></h2>
                    <p><strong>Author:</strong> <?= esc($book['author']) ?></p>
                    <p><strong>Tahun:</strong> <?= esc($book['year']) ?></p>
                    <p><strong>Penerbit:</strong> <?= esc($book['publisher']) ?></p>
                    <p><strong>Status:</strong> 
                        <?php if($book['status'] == 'available'): ?>
                            <span class="badge bg-success">Tersedia</span>
                            <a href="<?= site_url('user/borrow/' . $book['id']) ?>" 
                               class="btn btn-primary btn-sm ms-2"
                               onclick="return confirm('Pinjam buku ini?')">Pinjam</a>
                        <?php else: ?>
                            <span class="badge bg-danger">Dipinjam</span>
                        <?php endif; ?>
                    </p>
                    <p class="card-text"><?= nl2br(esc($book['description'])) ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
