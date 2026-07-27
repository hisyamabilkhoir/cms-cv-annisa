<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Annisa CMS</title>
    <meta name="description" content="Login ke panel admin CMS Annisa ESCE untuk mengelola konten portfolio.">
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400;1,500;1,600&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css" rel="stylesheet">
    <style>
        /* ── Reset & Base ── */
        *,
        *::before,
        *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            font-size: 16px;
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            min-height: 100vh;
            background-image: url('<?= base_url('admin-assets/images/bg-login-desktop.png') ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            overflow-x: hidden;
        }

        /* ── Layout Container ── */
        .login-wrapper {
            display: flex;
            align-items: stretch;
            width: 100%;
            max-width: 960px;
            min-height: 580px;
            border-radius: 28px;
            overflow: hidden;
            /* Subtle glassmorphism on the overall container */
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(6px);
            -webkit-backdrop-filter: blur(6px);
            box-shadow: 0 8px 32px rgba(180, 80, 150, 0.18);
            animation: fadeInUp 0.7s ease-out both;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ── Left Panel (Info) ── */
        .login-info {
            flex: 1 1 45%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 2.5rem 2.25rem;
            position: relative;
            color: #4a1942;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .brand-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: linear-gradient(135deg, #e040a0, #b44cd8);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.25rem;
            box-shadow: 0 4px 14px rgba(200, 60, 160, 0.35);
        }

        .brand-text h4 {
            font-size: 1.05rem;
            font-weight: 700;
            color: #6b2060;
            line-height: 1.2;
        }

        .brand-text span {
            font-size: 0.72rem;
            color: #9b5090;
            letter-spacing: 0.02em;
        }

        .hero-text {
            margin-top: 1rem;
        }

        .hero-text h1 {
            font-size: 2rem;
            font-weight: 800;
            line-height: 1.22;
            color: #3d1035;
        }

        .hero-text h1 .italic-line {
            font-style: italic;
            background: linear-gradient(90deg, #d64eaa, #a040d0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-text h1 .sparkle {
            -webkit-text-fill-color: initial;
            background: none;
            font-style: normal;
        }

        .hero-text p {
            margin-top: 0.75rem;
            font-size: 0.85rem;
            color: #704068;
            line-height: 1.65;
            max-width: 320px;
        }

        /* Feature list */
        .features {
            margin-top: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
        }

        .feature-icon {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .feature-icon.pink {
            background: #ffe0f0;
            color: #d64eaa;
        }

        .feature-icon.purple {
            background: #f0e0ff;
            color: #9b40d0;
        }

        .feature-icon.orange {
            background: #ffe8e0;
            color: #e06040;
        }

        .feature-item h5 {
            font-size: 0.82rem;
            font-weight: 700;
            color: #3d1035;
            margin-bottom: 0.1rem;
        }

        .feature-item span {
            font-size: 0.72rem;
            color: #886080;
            line-height: 1.4;
        }

        /* Footer */
        .info-footer {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 1.5rem;
            padding-top: 1rem;
        }

        .info-footer img {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 2px solid rgba(200, 80, 160, 0.3);
            object-fit: cover;
        }

        .info-footer-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(200, 80, 160, 0.3);
            flex-shrink: 0;
        }

        .info-footer p {
            font-size: 0.7rem;
            color: #886080;
            line-height: 1.5;
        }

        .info-footer p strong {
            color: #6b2060;
        }

        /* ── Right Panel (Form) ── */
        .login-form-panel {
            flex: 1 1 55%;
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 2.5rem 2.5rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .form-container {
            width: 100%;
            max-width: 380px;
        }

        /* Logo icon */
        .form-logo {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e040a0, #c850c0);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 6px 20px rgba(200, 60, 160, 0.35);
            animation: pulse 2.5s ease-in-out infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                box-shadow: 0 6px 20px rgba(200, 60, 160, 0.35);
            }

            50% {
                box-shadow: 0 6px 30px rgba(200, 60, 160, 0.55);
            }
        }

        .form-logo i {
            font-size: 1.5rem;
            color: #fff;
        }

        .form-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-header h2 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #2d0a2e;
        }

        .form-header p {
            font-size: 0.82rem;
            color: #9b7090;
            margin-top: 0.25rem;
        }

        /* Sparkle divider */
        .sparkle-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
            color: #d080c0;
            font-size: 0.7rem;
        }

        .sparkle-divider::before,
        .sparkle-divider::after {
            content: '';
            height: 1px;
            width: 40px;
            background: linear-gradient(90deg, transparent, #e0a0d0, transparent);
        }

        /* Alert */
        .alert {
            padding: 0.7rem 1rem;
            border-radius: 10px;
            font-size: 0.8rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .alert-danger {
            background: #fff0f0;
            color: #c0392b;
            border: 1px solid #fdd;
        }

        /* Form */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            color: #3d1035;
            margin-bottom: 0.4rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i.field-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #c090b0;
            font-size: 1rem;
            pointer-events: none;
            transition: color 0.2s;
        }

        .input-wrapper input {
            width: 100%;
            padding: 0.72rem 2.8rem 0.72rem 2.6rem;
            border: 1.5px solid #f0d0e8;
            border-radius: 12px;
            font-size: 0.85rem;
            font-family: inherit;
            color: #3d1035;
            background: #fff;
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s;
        }

        .input-wrapper input::placeholder {
            color: #c8a0b8;
        }

        .input-wrapper input:focus {
            border-color: #d64eaa;
            box-shadow: 0 0 0 3px rgba(214, 78, 170, 0.12);
        }

        .input-wrapper input:focus~i.field-icon {
            color: #d64eaa;
        }

        /* Password toggle */
        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #c090b0;
            font-size: 1.05rem;
            cursor: pointer;
            padding: 4px;
            transition: color 0.2s;
        }

        .toggle-password:hover {
            color: #d64eaa;
        }

        /* Remember & Forgot */
        .form-options {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 1.25rem;
            font-size: 0.78rem;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            cursor: pointer;
            color: #5a3050;
        }

        .remember-me input[type="checkbox"] {
            appearance: none;
            -webkit-appearance: none;
            width: 18px;
            height: 18px;
            border: 1.5px solid #d0a0c0;
            border-radius: 5px;
            cursor: pointer;
            position: relative;
            transition: all 0.2s;
            flex-shrink: 0;
        }

        .remember-me input[type="checkbox"]:checked {
            background: linear-gradient(135deg, #e040a0, #c850c0);
            border-color: transparent;
        }

        .remember-me input[type="checkbox"]:checked::after {
            content: '\2713';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-size: 0.7rem;
            font-weight: 700;
        }

        .forgot-link {
            color: #d64eaa;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #b03090;
        }

        /* Login Button */
        .btn-login {
            width: 100%;
            padding: 0.8rem;
            border: none;
            border-radius: 14px;
            font-family: inherit;
            font-size: 0.9rem;
            font-weight: 700;
            color: #fff;
            background: linear-gradient(135deg, #e040a0, #c850c0, #a040d0);
            background-size: 200% 200%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 4px 18px rgba(200, 60, 160, 0.35);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            right: 0;
            bottom: 0;
            width: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover {
            background-position: 100% 100%;
            box-shadow: 0 6px 24px rgba(200, 60, 160, 0.5);
            transform: translateY(-1px);
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Divider */
        .or-divider {
            text-align: center;
            font-size: 0.75rem;
            color: #a08090;
            margin: 1.25rem 0;
            position: relative;
        }

        .or-divider::before,
        .or-divider::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 30%;
            height: 1px;
            background: #e8d0e0;
        }

        .or-divider::before {
            left: 0;
        }

        .or-divider::after {
            right: 0;
        }

        /* Google button */
        .btn-google {
            width: 100%;
            padding: 0.7rem;
            border: 1.5px solid #e8d0e0;
            border-radius: 14px;
            background: #fff;
            font-family: inherit;
            font-size: 0.82rem;
            font-weight: 600;
            color: #3d1035;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            transition: all 0.25s;
        }

        .btn-google:hover {
            border-color: #d64eaa;
            background: #fdf0f8;
        }

        .btn-google img {
            width: 18px;
            height: 18px;
        }

        /* Footer text */
        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-size: 0.78rem;
            color: #886080;
        }

        .form-footer a {
            color: #d64eaa;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .form-footer a:hover {
            color: #b03090;
        }

        /* ── MOBILE RESPONSIVE ── */
        @media (max-width: 768px) {
            body {
                background-image: url('<?= base_url('admin-assets/images/bg-login-mobile.png') ?>');
                background-size: 100% 100%;
                padding: 0;
                align-items: flex-start;
            }

            .login-wrapper {
                flex-direction: column;
                max-width: 100%;
                min-height: auto;
                border-radius: 0;
                background: transparent;
                backdrop-filter: none;
                -webkit-backdrop-filter: none;
                box-shadow: none;
            }

            .login-info {
                padding: 1.5rem 1.5rem 1.25rem;
                flex: none;
            }

            .hero-text h1 {
                font-size: 1.65rem;
            }

            .features {
                display: none;
            }

            .info-footer {
                display: none;
            }

            .login-form-panel {
                flex: none;
                border-radius: 28px;
                padding: 2rem 1.5rem 2.5rem;
                margin: 0 2.9rem;
                background: rgba(255, 255, 255, 0.95);
            }
        }

        @media (max-width: 400px) {
            .hero-text h1 {
                font-size: 1.4rem;
            }

            .form-header h2 {
                font-size: 1.25rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-wrapper">
        <!-- ─── Left Panel: Info ─── -->
        <div class="login-info">
            <div>
                <div class="brand">
                    <div class="brand-icon">
                        <i class="ri-sparkling-2-fill"></i>
                    </div>
                    <div class="brand-text">
                        <h4>Annisa CMS</h4>
                        <span>Content Management System</span>
                    </div>
                </div>

                <div class="hero-text">
                    <h1>
                        Kelola Konten,<br>
                        Bangun Cerita,<br>
                        <span class="italic-line">Wujudkan Karya</span> <span class="sparkle">✨</span>
                    </h1>
                    <p>Dashboard ini membantumu mengelola konten dengan mudah, cepat, dan terstruktur.</p>
                </div>

                <div class="features">
                    <div class="feature-item">
                        <div class="feature-icon pink">
                            <i class="ri-layout-grid-fill"></i>
                        </div>
                        <div>
                            <h5>Kelola Konten</h5>
                            <span>Atur semua konten website dengan mudah</span>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon purple">
                            <i class="ri-bar-chart-box-fill"></i>
                        </div>
                        <div>
                            <h5>Pantau Performa</h5>
                            <span>Lihat statistik dan perkembangan konten</span>
                        </div>
                    </div>
                    <div class="feature-item">
                        <div class="feature-icon orange">
                            <i class="ri-shield-check-fill"></i>
                        </div>
                        <div>
                            <h5>Aman & Terpercaya</h5>
                            <span>Keamanan data terjamin dengan sistem kami</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="info-footer">
                <?php $heroPhoto = !empty($hero['photo']) ? base_url('assets/uploads/hero/' . $hero['photo']) : base_url('assets/uploads/hero/header.jpg'); ?>
                <img src="<?= $heroPhoto ?>" alt="Annisa ESCE" class="info-footer-avatar">
                <p>Dikembangkan dengan <span style="color:#e040a0">♥</span> oleh <strong>Annisa ESCE</strong><br>&copy;
                    <?= date('Y') ?> Annisa CMS. All rights reserved.
                </p>
            </div>
        </div>

        <!-- ─── Right Panel: Form ─── -->
        <div class="login-form-panel">
            <div class="form-container">
                <div class="form-logo">
                    <i class="ri-sparkling-2-fill"></i>
                </div>
                <div class="form-header">
                    <h2>Login Admin</h2>
                    <p>Portfolio Annisa ESCE</p>
                </div>

                <div class="sparkle-divider">✦</div>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <i class="ri-error-warning-fill"></i>
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('admin/login/process') ?>" method="post" id="loginForm" autocomplete="off">
                    <?= csrf_field() ?>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <div class="input-wrapper">
                            <i class="ri-user-line field-icon"></i>
                            <input type="text" id="username" name="username" placeholder="Masukkan username" required
                                autofocus>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <div class="input-wrapper">
                            <i class="ri-lock-2-line field-icon"></i>
                            <input type="password" id="password" name="password" placeholder="Masukkan password"
                                required>
                            <button type="button" class="toggle-password" id="togglePassword"
                                aria-label="Toggle password visibility">
                                <i class="ri-eye-off-line"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-options">
                        <label class="remember-me">
                            <input type="checkbox" name="remember">
                            Ingat saya
                        </label>

                    </div>

                    <button type="submit" class="btn-login" id="btnLogin">
                        <i class="ri-login-circle-line"></i>
                        Login
                    </button>
                </form>


            </div>
        </div>
    </div>

    <script>
        // Toggle password visibility
        const toggleBtn = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        toggleBtn.addEventListener('click', function () {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            const icon = this.querySelector('i');
            icon.classList.toggle('ri-eye-off-line');
            icon.classList.toggle('ri-eye-line');
        });
    </script>
</body>

</html>