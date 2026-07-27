<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>404 - Halaman Tidak Ditemukan</title>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background: #fce4ec; color: #2d2334; text-align: center; padding: 50px 20px; }
        .box { background: white; max-width: 500px; margin: 0 auto; padding: 40px; border-radius: 24px; box-shadow: 0 10px 30px rgba(236,64,122,0.1); }
        h1 { color: #ec407a; font-size: 72px; margin: 0; }
        p { color: #8c7f95; margin-bottom: 24px; }
        a { display: inline-block; background: #ec407a; color: white; text-decoration: none; padding: 12px 24px; border-radius: 12px; font-weight: 600; }
    </style>
</head>
<body>
    <div class="box">
        <h1>404</h1>
        <h2>Halaman Tidak Ditemukan</h2>
        <p>Maaf, halaman yang Anda cari tidak ditemukan atau telah dipindahkan.</p>
        <a href="<?= base_url('admin/dashboard') ?>">Kembali ke Dashboard</a>
    </div>
</body>
</html>
