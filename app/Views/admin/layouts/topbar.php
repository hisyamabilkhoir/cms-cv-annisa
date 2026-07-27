<header class="topbar-glass">
    <!-- Left: Mobile Sidebar Toggler -->
    <button class="sidebar-mobile-toggler me-3 d-lg-none">
        <i class="ri-menu-2-line"></i>
    </button>
    
    <!-- Search Bar (as seen in image) -->
    <div class="topbar-search">
        <i class="ri-search-line search-icon"></i>
        <input type="text" class="search-input" placeholder="Search anything..." aria-label="Search">
        <span class="search-shortcut">⌘ K</span>
    </div>

    <!-- Right Side Actions -->
    <div class="topbar-actions">
        <!-- Theme Toggle Button -->
        <button class="action-btn icon-btn" title="Toggle Theme">
            <i class="ri-sun-line"></i>
        </button>

        <!-- Notification Bell Button -->
        <div class="dropdown">
            <button class="action-btn icon-btn position-relative" data-bs-toggle="dropdown" aria-expanded="false" title="Notifications">
                <i class="ri-notification-3-line"></i>
                <span class="badge-dot-pink">3</span>
            </button>
            <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 p-3 mt-2" style="width: 300px;">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h6 class="fw-bold mb-0 text-pink">Notifikasi</h6>
                    <span class="badge bg-pink-soft text-pink">3 Baru</span>
                </div>
                <div class="notification-list">
                    <div class="notification-item py-2 border-bottom">
                        <p class="mb-0 small fw-medium text-dark">Pesan baru dari customer</p>
                        <span class="text-muted extra-small">5 menit yang lalu</span>
                    </div>
                    <div class="notification-item py-2 border-bottom">
                        <p class="mb-0 small fw-medium text-dark">Project "Travel Vlog" telah dikunjungi</p>
                        <span class="text-muted extra-small">1 jam yang lalu</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Website Link Button -->
        <a href="<?= base_url() ?>" target="_blank" class="action-btn view-site-btn d-none d-sm-flex" title="Lihat Website">
            <i class="ri-external-link-line me-1"></i>
            <span>Website</span>
        </a>

        <!-- User Profile Dropdown -->
        <div class="dropdown ms-1">
            <button class="user-profile-btn" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= base_url('assets/logo.jpeg') ?>" alt="Admin Avatar" class="profile-img" onerror="this.src='https://ui-avatars.com/api/?name=Annisa+Esce&background=ff69b4&color=fff'">
                <span class="profile-name d-none d-md-inline"><?= session()->get('admin_name') ?? 'Administrator' ?></span>
                <i class="ri-arrow-down-s-line dropdown-arrow"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-2 p-2">
                <li><a class="dropdown-item rounded-3 py-2" href="<?= base_url('admin/account') ?>"><i class="ri-user-settings-line me-2 text-pink"></i> Profil Saya</a></li>
                <li><a class="dropdown-item rounded-3 py-2" href="<?= base_url('admin/settings') ?>"><i class="ri-settings-3-line me-2 text-pink"></i> Pengaturan Web</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item rounded-3 py-2 text-danger" href="<?= base_url('admin/logout') ?>"><i class="ri-logout-box-r-line me-2"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</header>

