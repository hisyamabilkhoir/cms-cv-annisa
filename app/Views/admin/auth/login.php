<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CMS Annisa ESCE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('admin-assets/css/admin.css') ?>">
    <style>
        body {
            background: linear-gradient(135deg, #ff69b4, #9c27b0);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 400px;
        }
        .login-card h3 {
            color: #ff69b4;
            font-weight: 700;
        }
        .btn-pink {
            background-color: #ff69b4;
            color: white;
            border: none;
        }
        .btn-pink:hover {
            background-color: #e66377;
            color: white;
        }
        .form-control:focus {
            border-color: #ff69b4;
            box-shadow: 0 0 0 0.25rem rgba(255, 105, 180, 0.25);
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <h3>Login Admin</h3>
            <p class="text-muted">Portfolio Annisa ESCE</p>
        </div>
        
        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('admin/login/process') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required autofocus>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-pink w-100 py-2 fw-bold">Login</button>
        </form>
    </div>
</body>
</html>
