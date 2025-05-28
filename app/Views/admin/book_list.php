<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin - Kelola Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
    <h1 class="mb-4 text-center">Kelola Buku</h1>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php elseif (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <a href="<?= site_url('admin/create') ?>" class="btn btn-success mb-3">Tambah Buku</a>
    
    <table class="table table-hover table-bordered shadow-sm">
        <thead class="table-dark">
        <tr>
            <th>Judul</th>
            <th>Author</th>
            <th>Tahun</th>
            <th>Penerbit</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?= esc($book['title']) ?></td>
                <td><?= esc($book['author']) ?></td>
                <td><?= esc($book['year']) ?></td>
                <td><?= esc($book['publisher']) ?></td>
                <td>
                    <?php if($book['status'] == 'available'): ?>
                        <span class="badge bg-success">Tersedia</span>
                    <?php else: ?>
                        <span class="badge bg-danger">Dipinjam</span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= site_url('admin/toggle-status/' . $book['id']) ?>" 
                       class="btn btn-sm btn-warning mb-1"
                       onclick="return confirm('Ubah status buku?')">Toggle Status</a>
                    <a href="<?= site_url('admin/delete/' . $book['id']) ?>" 
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Yakin ingin menghapus buku ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
