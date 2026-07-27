<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Dashboard' ?> - Annisa CMS</title>
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
    <?= $this->renderSection('scripts') ?>
</body>
</html>
