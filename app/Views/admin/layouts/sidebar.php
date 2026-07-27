<?php $uri = service('uri'); ?>
<aside class="sidebar">
    <!-- Brand Header -->
    <div class="sidebar-brand">
        <div class="brand-icon">
            <i class="ri-sparkling-fill"></i>
        </div>
        <div class="brand-text">
            <h2 class="brand-title">Annisa CMS</h2>
            <span class="brand-subtitle">Content Management System</span>
        </div>
    </div>
    
    <!-- Navigation Menu -->
    <div class="sidebar-nav">
        <div class="nav-section-title">MAIN MENU</div>
        <a href="<?= base_url('admin/dashboard') ?>" class="nav-item <?= ($uri->getSegment(2) == 'dashboard') ? 'active' : '' ?>">
            <div class="nav-icon"><i class="ri-dashboard-3-fill"></i></div>
            <span class="nav-label">Dashboard</span>
        </a>
        
        <div class="nav-section-title">LANDING PAGE</div>
        <a href="<?= base_url('admin/hero') ?>" class="nav-item <?= ($uri->getSegment(2) == 'hero') ? 'active' : '' ?>">
            <div class="nav-icon"><i class="ri-window-line"></i></div>
            <span class="nav-label">Hero Section</span>
        </a>
        <a href="<?= base_url('admin/about') ?>" class="nav-item <?= ($uri->getSegment(2) == 'about') ? 'active' : '' ?>">
            <div class="nav-icon"><i class="ri-user-smile-line"></i></div>
            <span class="nav-label">About Me</span>
        </a>
        <a href="<?= base_url('admin/brands') ?>" class="nav-item <?= ($uri->getSegment(2) == 'brands') ? 'active' : '' ?>">
            <div class="nav-icon"><i class="ri-vip-diamond-line"></i></div>
            <span class="nav-label">Brands & Partners</span>
        </a>
        
        <div class="nav-section-title">PORTFOLIO</div>
        <a href="<?= base_url('admin/project-categories') ?>" class="nav-item <?= ($uri->getSegment(2) == 'project-categories') ? 'active' : '' ?>">
            <div class="nav-icon"><i class="ri-price-tag-3-line"></i></div>
            <span class="nav-label">Kategori Project</span>
        </a>
        <a href="<?= base_url('admin/projects') ?>" class="nav-item <?= ($uri->getSegment(2) == 'projects') ? 'active' : '' ?>">
            <div class="nav-icon"><i class="ri-briefcase-4-line"></i></div>
            <span class="nav-label">Data Project</span>
        </a>
        <a href="<?= base_url('admin/project-galleries') ?>" class="nav-item <?= ($uri->getSegment(2) == 'project-galleries') ? 'active' : '' ?>">
            <div class="nav-icon"><i class="ri-gallery-line"></i></div>
            <span class="nav-label">Galeri Proyek</span>
        </a>
        
        <div class="nav-section-title">RESUME & ACHIEVEMENTS</div>
        <a href="<?= base_url('admin/achievement-categories') ?>" class="nav-item <?= ($uri->getSegment(2) == 'achievement-categories') ? 'active' : '' ?>">
            <div class="nav-icon"><i class="ri-medal-line"></i></div>
            <span class="nav-label">Kategori Prestasi</span>
        </a>
        <a href="<?= base_url('admin/achievements') ?>" class="nav-item <?= ($uri->getSegment(2) == 'achievements') ? 'active' : '' ?>">
            <div class="nav-icon"><i class="ri-trophy-line"></i></div>
            <span class="nav-label">Data Prestasi</span>
        </a>
        <a href="<?= base_url('admin/resume') ?>" class="nav-item <?= ($uri->getSegment(2) == 'resume') ? 'active' : '' ?>">
            <div class="nav-icon"><i class="ri-file-user-line"></i></div>
            <span class="nav-label">Resume (CV)</span>
        </a>
        
        <div class="nav-section-title">LAINNYA</div>
        <a href="<?= base_url('admin/testimonials') ?>" class="nav-item <?= ($uri->getSegment(2) == 'testimonials') ? 'active' : '' ?>">
            <div class="nav-icon"><i class="ri-chat-heart-line"></i></div>
            <span class="nav-label">Testimonials</span>
        </a>
        <a href="<?= base_url('admin/contacts') ?>" class="nav-item <?= (in_array($uri->getSegment(2), ['contacts', 'contact-messages'])) ? 'active' : '' ?>">
            <div class="nav-icon"><i class="ri-mail-unread-line"></i></div>
            <span class="nav-label">Pesan & Kontak</span>
        </a>
        <a href="<?= base_url('admin/account') ?>" class="nav-item <?= (in_array($uri->getSegment(2), ['settings', 'account'])) ? 'active' : '' ?>">
            <div class="nav-icon"><i class="ri-settings-4-line"></i></div>
            <span class="nav-label">Pengaturan Akun</span>
        </a>
    </div>

    <!-- Bottom Sidebar Profile Widget -->
    <?php 
    $sAvatar = session()->get('admin_avatar');
    $sName   = session()->get('admin_name') ?? 'Administrator';
    $sEmail  = session()->get('admin_email') ?? 'admin@annisa.com';
    $sAvatarUrl = (!empty($sAvatar) && file_exists(FCPATH . 'assets/uploads/avatars/' . $sAvatar)) 
                  ? base_url('assets/uploads/avatars/' . $sAvatar) 
                  : 'https://ui-avatars.com/api/?name=' . urlencode($sName) . '&background=ff69b4&color=fff';
    ?>
    <div class="sidebar-user-card">
        <div class="user-avatar-wrapper">
            <img src="<?= $sAvatarUrl ?>" alt="Admin Avatar" class="user-avatar">
        </div>
        <div class="user-info">
            <h4 class="user-name"><?= esc($sName) ?></h4>
            <span class="user-email"><?= esc($sEmail) ?></span>
        </div>
        <div class="dropdown">
            <button class="user-more-btn" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ri-more-2-fill"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                <li><a class="dropdown-item" href="<?= base_url('admin/account') ?>"><i class="ri-user-settings-line me-2"></i> Pengaturan Akun</a></li>
                <li><a class="dropdown-item" href="<?= base_url() ?>" target="_blank"><i class="ri-external-link-line me-2"></i> Lihat Website</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-danger btn-logout" href="<?= base_url('admin/logout') ?>"><i class="ri-logout-box-r-line me-2"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</aside>

