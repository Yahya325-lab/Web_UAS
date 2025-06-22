<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Sign Up</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
<div class="container py-5">
  <h2 class="mb-4 text-center">Sign Up</h2>

  <?php if(session()->getFlashdata('errors')): ?>
    <div class="alert alert-danger">
      <ul>
        <?php foreach(session()->getFlashdata('errors') as $error): ?>
          <li><?= esc($error) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
  <?php endif; ?>

  <?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
  <?php endif; ?>

  <form action="<?= site_url('register/process') ?>" method="post" class="mx-auto" style="max-width: 400px;">
    <?= csrf_field() ?>
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" id="username" name="username" required />
    </div>
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" id="password" name="password" required />
    </div>
    <div class="mb-3">
      <label for="confirm_password" class="form-label">Konfirmasi Password</label>
      <input type="password" class="form-control" id="confirm_password" name="confirm_password" required />
    </div>
    <button type="submit" class="btn btn-success w-100">Buat Akun</button>
    <p class="text-center mt-3">Sudah punya akun? <a href="<?= site_url('login') ?>">Login</a></p>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
