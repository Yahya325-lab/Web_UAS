<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Tambah Buku</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
    <h1 class="mb-4 text-center">Tambah Buku Baru</h1>
    <form action="<?= site_url('admin/store') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="title" class="form-label">Judul Buku</label>
            <input type="text" name="title" id="title" class="form-control" required />
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" name="author" id="author" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Tahun</label>
            <input type="number" name="year" id="year" class="form-control" min="1900" max="<?= date('Y') ?>" />
        </div>
        <div class="mb-3">
            <label for="publisher" class="form-label">Penerbit</label>
            <input type="text" name="publisher" id="publisher" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea name="description" id="description" class="form-control" rows="4"></textarea>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Gambar Buku</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*" />
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select">
                <option value="available" selected>Tersedia</option>
                <option value="borrowed">Dipinjam</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?= site_url('admin') ?>" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
