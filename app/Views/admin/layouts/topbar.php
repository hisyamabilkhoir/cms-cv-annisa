<?php 
$msgModel = new \App\Models\ContactMessageModel();
$unreadMessages = $msgModel->where('is_read', 0)->orderBy('created_at', 'DESC')->findAll(5);
$unreadCount = count($unreadMessages);

if (!function_exists('timeAgoFriendlyTop')) {
    function timeAgoFriendlyTop($datetime) {
        if (empty($datetime)) return 'Baru saja';
        $time = strtotime($datetime);
        $diff = time() - $time;
        if ($diff < 60) return 'Baru saja';
        if ($diff < 3600) return floor($diff / 60) . 'm lalu';
        if ($diff < 86400) return floor($diff / 3600) . 'j lalu';
        if ($diff < 172800) return 'Kemarin';
        return date('d M', $time);
    }
}
?>
<header class="topbar-glass">
    <!-- Left: Mobile Sidebar Toggler -->
    <button class="sidebar-mobile-toggler me-3 d-lg-none">
        <i class="ri-menu-2-line"></i>
    </button>
    
    <!-- Search Bar (Menu Autocomplete) -->
    <div class="topbar-search position-relative">
        <i class="ri-search-line search-icon"></i>
        <input type="text" id="menuSearchInput" class="search-input" placeholder="Cari menu..." aria-label="Cari menu" autocomplete="off">
        <span class="search-shortcut">⌘ K</span>

        <!-- Autocomplete Dropdown Result Box -->
        <div id="menuSearchResults" class="dropdown-menu shadow-lg border-0 rounded-4 p-2 mt-2" style="position: absolute; top: 100%; left: 0; right: 0; width: 100%; max-height: 320px; overflow-y: auto; z-index: 99999; display: none;">
        </div>
    </div>

    <!-- Right Side Actions -->
    <div class="topbar-actions">
        <!-- Theme Toggle Button (Hidden/Commented Out) -->
        <!-- <button class="action-btn icon-btn" title="Toggle Theme">
            <i class="ri-sun-line"></i>
        </button> -->

        <!-- Notification Bell Button -->
        <div class="dropdown">
            <button class="action-btn icon-btn position-relative" data-bs-toggle="dropdown" aria-expanded="false" title="Notifications">
                <i class="ri-notification-3-line"></i>
                <?php if ($unreadCount > 0): ?>
                    <span class="badge-dot-pink"><?= $unreadCount ?></span>
                <?php endif; ?>
            </button>
            <div class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 p-3 mt-2" style="width: 320px;">
                <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                    <h6 class="fw-bold mb-0 text-pink">Pesan Masuk (Unread)</h6>
                    <?php if ($unreadCount > 0): ?>
                        <span class="badge bg-pink-soft text-pink fw-bold"><?= $unreadCount ?> Baru</span>
                    <?php else: ?>
                        <span class="badge bg-secondary-subtle text-secondary">0 Baru</span>
                    <?php endif; ?>
                </div>
                <div class="notification-list" style="max-height: 280px; overflow-y: auto;">
                    <?php if ($unreadCount > 0): ?>
                        <?php foreach($unreadMessages as $uMsg): ?>
                            <a href="<?= base_url('admin/contacts') ?>" class="notification-item py-2 border-bottom d-block text-decoration-none px-1 rounded-2">
                                <div class="d-flex align-items-center justify-content-between">
                                    <p class="mb-0 small fw-bold text-dark text-truncate" style="max-width: 190px;">
                                        <i class="ri-sparkling-fill text-pink me-1"></i><?= esc($uMsg['name']) ?>
                                    </p>
                                    <span class="text-pink extra-small fw-semibold" style="font-size: 11px;"><?= timeAgoFriendlyTop($uMsg['created_at']) ?></span>
                                </div>
                                <p class="mb-0 text-muted extra-small text-truncate mt-1" style="max-width: 280px; font-size: 12px;">
                                    <?= esc($uMsg['message']) ?>
                                </p>
                            </a>
                        <?php endforeach; ?>
                        <div class="text-center pt-2 mt-1">
                            <a href="<?= base_url('admin/contacts') ?>" class="small text-pink fw-bold text-decoration-none">
                                Lihat Semua Pesan <i class="ri-arrow-right-line ms-1"></i>
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-3 text-muted">
                            <i class="ri-checkbox-circle-fill fs-2 text-pink opacity-50 d-block mb-1"></i>
                            <span class="small fw-medium">Semua pesan sudah dibaca! ✨</span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- View Website Link Button -->
        <a href="<?= base_url() ?>" target="_blank" class="action-btn view-site-btn d-none d-sm-flex" title="Lihat Website">
            <i class="ri-external-link-line me-1"></i>
            <span>Website</span>
        </a>

        <!-- User Profile Dropdown -->
        <?php 
        $tAvatar = session()->get('admin_avatar');
        $tName   = session()->get('admin_name') ?? 'Administrator';
        $tAvatarUrl = (!empty($tAvatar) && file_exists(FCPATH . 'assets/uploads/avatars/' . $tAvatar)) 
                      ? base_url('assets/uploads/avatars/' . $tAvatar) 
                      : 'https://ui-avatars.com/api/?name=' . urlencode($tName) . '&background=ff69b4&color=fff';
        ?>
        <div class="dropdown ms-1">
            <button class="user-profile-btn" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= $tAvatarUrl ?>" alt="Admin Avatar" class="profile-img">
                <span class="profile-name d-none d-md-inline"><?= esc($tName) ?></span>
                <i class="ri-arrow-down-s-line dropdown-arrow"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-4 mt-2 p-2">
                <li><a class="dropdown-item rounded-3 py-2" href="<?= base_url('admin/account') ?>"><i class="ri-user-settings-line me-2 text-pink"></i> Profil Saya</a></li>
                <li><a class="dropdown-item rounded-3 py-2" href="<?= base_url('admin/settings') ?>"><i class="ri-settings-3-line me-2 text-pink"></i> Pengaturan Web</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item rounded-3 py-2 text-danger btn-logout" href="<?= base_url('admin/logout') ?>"><i class="ri-logout-box-r-line me-2"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('menuSearchInput');
    const searchResults = document.getElementById('menuSearchResults');

    const ADMIN_MENUS = [
        { title: 'Dashboard', url: '<?= base_url("admin/dashboard") ?>', icon: 'ri-dashboard-line', desc: 'Ringkasan statistik & aktivitas web', keywords: 'dashboard home beranda utama' },
        { title: 'Hero Section', url: '<?= base_url("admin/hero") ?>', icon: 'ri-layout-top-line', desc: 'Kelola judul, foto, & teks hero', keywords: 'hero headline foto cv banner utama' },
        { title: 'About Me', url: '<?= base_url("admin/about") ?>', icon: 'ri-user-heart-line', desc: 'Kelola tentang saya, statistik, & kartu mini', keywords: 'about tentang saya profil bio mini stats' },
        { title: 'Brands & Clients', url: '<?= base_url("admin/brands") ?>', icon: 'ri-building-line', desc: 'Kelola logo brand & mitra kerja', keywords: 'brands brand sponsor logo mitra klien client' },
        { title: 'Projects / Portfolio', url: '<?= base_url("admin/projects") ?>', icon: 'ri-folder-user-line', desc: 'Kelola project karya & galeri media', keywords: 'projects project portofolio karya video youtube galeri' },
        { title: 'Kategori Projects', url: '<?= base_url("admin/project-categories") ?>', icon: 'ri-price-tag-3-line', desc: 'Kelola kategori portfolio & project', keywords: 'kategori project category portofolio' },
        { title: 'Achievements / Milestones', url: '<?= base_url("admin/achievements") ?>', icon: 'ri-trophy-line', desc: 'Kelola pencapaian & milestone prestasi', keywords: 'achievements achievement pencapaian milestone prestasi penghargaan' },
        { title: 'Kategori Achievements', url: '<?= base_url("admin/achievement-categories") ?>', icon: 'ri-award-line', desc: 'Kelola kategori pencapaian', keywords: 'kategori achievement category milestone' },
        { title: 'Resume, Skills & Tools', url: '<?= base_url("admin/resume") ?>', icon: 'ri-file-text-line', desc: 'Kelola pengalaman kerja, keahlian, & tools', keywords: 'resume cv pengalaman kerja skills keahlian tools kemampuan' },
        { title: 'Testimonials', url: '<?= base_url("admin/testimonials") ?>', icon: 'ri-feedback-line', desc: 'Kelola ulasan & testimoni brand', keywords: 'testimonials testimoni ulasan review kata mereka' },
        { title: 'Kontak & Pesan Masuk', url: '<?= base_url("admin/contacts") ?>', icon: 'ri-contacts-book-line', desc: 'Kelola pesan masuk, sosmed, & google maps', keywords: 'kontak pesan inbox whatsapp social media sosmed instagram tiktok youtube maps' },
        { title: 'Profil Saya / Akun', url: '<?= base_url("admin/account") ?>', icon: 'ri-user-settings-line', desc: 'Kelola nama, password, & foto profil admin', keywords: 'account akun profil admin password ubah sandi avatar' },
        { title: 'Pengaturan Web', url: '<?= base_url("admin/settings") ?>', icon: 'ri-settings-3-line', desc: 'Kelola judul web, logo, & SEO', keywords: 'settings pengaturan web logo title website seo' }
    ];

    function renderMenuSearch(query) {
        if (!query) {
            searchResults.style.display = 'none';
            return;
        }

        const q = query.toLowerCase().trim();
        const filtered = ADMIN_MENUS.filter(menu => 
            menu.title.toLowerCase().includes(q) || 
            menu.desc.toLowerCase().includes(q) || 
            menu.keywords.toLowerCase().includes(q)
        );

        if (filtered.length > 0) {
            let html = '';
            filtered.forEach((item, idx) => {
                html += `
                    <a href="${item.url}" class="dropdown-item py-2 px-3 rounded-3 d-flex align-items-center gap-2 mb-1">
                        <div class="rounded-circle p-2 bg-pink-soft text-pink d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; flex-shrink: 0;">
                            <i class="${item.icon}"></i>
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="fw-bold small text-dark mb-0 text-truncate">${item.title}</div>
                            <div class="text-muted extra-small text-truncate" style="font-size: 11px;">${item.desc}</div>
                        </div>
                        <i class="ri-arrow-right-s-line text-pink fs-5 ms-auto"></i>
                    </a>
                `;
            });
            searchResults.innerHTML = html;
            searchResults.style.display = 'block';
        } else {
            searchResults.innerHTML = `
                <div class="text-center py-3 text-muted">
                    <i class="ri-search-eye-line fs-3 text-pink opacity-50 d-block mb-1"></i>
                    <span class="small">Menu "<strong>${query}</strong>" tidak ditemukan.</span>
                </div>
            `;
            searchResults.style.display = 'block';
        }
    }

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            renderMenuSearch(this.value);
        });

        searchInput.addEventListener('focus', function() {
            if (this.value.trim() !== '') {
                renderMenuSearch(this.value);
            }
        });

        // Redirect on Enter
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                const activeItem = searchResults.querySelector('.dropdown-item');
                if (activeItem) {
                    window.location.href = activeItem.getAttribute('href');
                }
            }
        });

        // Close on click outside
        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResults.contains(e.target)) {
                searchResults.style.display = 'none';
            }
        });
    }

    // Keyboard shortcut Ctrl + K / Cmd + K
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            if (searchInput) {
                searchInput.focus();
                searchInput.select();
                if (searchInput.value.trim() !== '') {
                    renderMenuSearch(searchInput.value);
                }
            }
        }
    });
});
</script>

