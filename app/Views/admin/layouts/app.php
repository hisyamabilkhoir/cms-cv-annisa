<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard' ?> - Annisa CMS</title>
    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="<?= base_url('assets/uploads/logo.jpeg') ?>">
    <link rel="shortcut icon" type="image/jpeg" href="<?= base_url('assets/uploads/logo.jpeg') ?>">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <!-- Google Fonts: Plus Jakarta Sans & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600;1,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('admin-assets/css/admin.css?v=' . time()) ?>">
    <?= $this->renderSection('styles') ?>
</head>
<body class="pink-theme">
    
    <!-- Background Decorative Elements -->
    <div class="bg-decorations" aria-hidden="true">
        <div class="bg-blob blob-1"></div>
        <div class="bg-blob blob-2"></div>
        <div class="bg-blob blob-3"></div>
        <!-- Floating Floral / Sparkle Background Art -->
        <div class="floral-art floral-bottom-right"></div>
        <div class="floral-art floral-top-right"></div>
        <div class="butterfly-art butterfly-top-left">
            <svg width="42" height="42" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 12C10 8 5 4 2 7C-1 10 3 15 12 12Z" fill="#ff69b4" fill-opacity="0.3"/>
                <path d="M12 12C14 8 19 4 22 7C25 10 21 15 12 12Z" fill="#ec407a" fill-opacity="0.3"/>
                <path d="M12 12C10 16 6 20 4 18C2 16 6 13 12 12Z" fill="#ab47bc" fill-opacity="0.25"/>
                <path d="M12 12C14 16 18 20 20 18C22 16 18 13 12 12Z" fill="#ab47bc" fill-opacity="0.25"/>
            </svg>
        </div>
    </div>

    <div class="admin-wrapper">
        <!-- Sidebar -->
        <?= $this->include('admin/layouts/sidebar') ?>

        <!-- Main Content Wrapper -->
        <div class="main-content">
            <!-- Topbar -->
            <?= $this->include('admin/layouts/topbar') ?>

            <!-- Content Container -->
            <div class="content-container">
                <?php if (session()->getFlashdata('success')) : ?>
                    <div class="alert alert-pink-success alert-dismissible fade show mb-4" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-pink-error alert-dismissible fade show mb-4" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </div>
        </div>
    </div>

    <!-- Floating Action Sparkle Button (as seen in image bottom-right) -->
    <div class="floating-sparkle-btn" title="Quick Actions">
        <i class="ri-sparkling-fill"></i>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom JS -->
    <script src="<?= base_url('admin-assets/js/admin.js?v=' . time()) ?>"></script>
    <script src="<?= base_url('admin-assets/js/datatable.js') ?>"></script>

    <!-- Magical Flying Butterflies Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fabBtn = document.querySelector('.floating-sparkle-btn');
        if (!fabBtn) return;

        fabBtn.addEventListener('click', function(e) {
            // Add pop bounce effect to button
            fabBtn.classList.remove('btn-pop');
            void fabBtn.offsetWidth;
            fabBtn.classList.add('btn-pop');

            const rect = fabBtn.getBoundingClientRect();
            const startX = rect.left + rect.width / 2;
            const startY = rect.top + rect.height / 2;

            // Gradient Colors palette for butterflies
            const colors = [
                { l: '#ff69b4', r: '#ec407a' },
                { l: '#ff80ab', r: '#ff4081' },
                { l: '#f48fb1', r: '#d81b60' },
                { l: '#f06292', r: '#c2185b' },
                { l: '#ba68c8', r: '#ab47bc' },
                { l: '#ffd54f', r: '#ffb300' }
            ];

            const count = 50; // 50 ekor kupu-kupu beterbangan lama hingga ke sidebar!

            for (let i = 0; i < count; i++) {
                setTimeout(() => {
                    createButterfly(startX, startY, colors[i % colors.length]);
                }, i * 35);
            }
        });

        function createButterfly(startX, startY, color) {
            const butterfly = document.createElement('div');
            butterfly.className = 'butterfly-particle';

            const size = Math.floor(Math.random() * 26) + 24; // 24px - 50px
            const flapSpeed = (Math.random() * 0.10 + 0.12).toFixed(2); // 0.12s - 0.22s

            butterfly.style.width = size + 'px';
            butterfly.style.height = size + 'px';
            butterfly.style.left = (startX - size / 2) + 'px';
            butterfly.style.top = (startY - size / 2) + 'px';

            // Butterfly SVG markup
            butterfly.innerHTML = `
                <div class="butterfly-body">
                    <svg class="butterfly-wing-l" width="${size/2}" height="${size}" viewBox="0 0 50 80" style="animation-duration: ${flapSpeed}s;">
                        <path d="M50 40 C30 0, 0 10, 5 35 C10 50, 45 45, 50 40 Z M50 42 C30 50, 10 65, 20 78 C35 85, 48 55, 50 42 Z" fill="${color.l}" opacity="0.95"/>
                        <circle cx="30" cy="25" r="4" fill="#ffffff" opacity="0.85"/>
                        <circle cx="20" cy="35" r="2.5" fill="#ffffff" opacity="0.85"/>
                    </svg>
                    <svg class="butterfly-wing-r" width="${size/2}" height="${size}" viewBox="0 0 50 80" style="animation-duration: ${flapSpeed}s;">
                        <path d="M0 40 C20 0, 50 10, 45 35 C40 50, 5 45, 0 40 Z M0 42 C20 50, 40 65, 30 78 C15 85, 2 55, 0 42 Z" fill="${color.r}" opacity="0.95"/>
                        <circle cx="20" cy="25" r="4" fill="#ffffff" opacity="0.85"/>
                        <circle cx="30" cy="35" r="2.5" fill="#ffffff" opacity="0.85"/>
                    </svg>
                </div>
            `;

            document.body.appendChild(butterfly);

            // Vector targets: fly across entire screen including Sidebar (left) and Topbar (top)
            const targetX = - (Math.random() * (window.innerWidth - 100)); // Menyapu ke kiri hingga menyeberangi Sidebar!
            const targetY = - (Math.random() * (window.innerHeight + 300) + 400); // Melayang tinggi ke atas
            const rotation = (Math.random() - 0.5) * 120;
            const duration = Math.random() * 3000 + 4500; // Melayang lama: 4.5 detik s.d. 7.5 detik!
            const swirlAmp = (Math.random() - 0.5) * 220;

            const animation = butterfly.animate([
                {
                    transform: `translate(0px, 0px) rotate(0deg) scale(0.3)`,
                    opacity: 1
                },
                {
                    transform: `translate(${targetX * 0.25 + swirlAmp}px, ${targetY * 0.25}px) rotate(${rotation * 0.4}deg) scale(1.1)`,
                    opacity: 0.95,
                    offset: 0.25
                },
                {
                    transform: `translate(${targetX * 0.6 - swirlAmp}px, ${targetY * 0.6}px) rotate(${rotation * 0.8}deg) scale(1)`,
                    opacity: 0.85,
                    offset: 0.6
                },
                {
                    transform: `translate(${targetX * 0.85 + swirlAmp * 0.5}px, ${targetY * 0.85}px) rotate(${rotation * 1.1}deg) scale(0.85)`,
                    opacity: 0.5,
                    offset: 0.85
                },
                {
                    transform: `translate(${targetX}px, ${targetY}px) rotate(${rotation}deg) scale(0.4)`,
                    opacity: 0
                }
            ], {
                duration: duration,
                easing: 'cubic-bezier(0.2, 0.4, 0.4, 1)',
                fill: 'forwards'
            });

            animation.onfinish = function() {
                butterfly.remove();
            };
        }
    });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>
