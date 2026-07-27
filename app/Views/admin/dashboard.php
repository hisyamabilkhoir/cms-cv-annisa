<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>

<!-- Welcome Header Row -->
<div class="welcome-header-row mb-4">
    <div>
        <h1 class="welcome-title">Hai, <?= session()->get('admin_name') ?? 'Annisa' ?>! <span class="wave-emoji">👋</span></h1>
        <p class="welcome-subtitle">Kelola konten website dan pantau semua aktivitas dengan mudah.</p>
    </div>
    <div class="date-badge-card">
        <i class="ri-calendar-check-line me-2 text-pink"></i>
        <span><?= date('d M Y') ?>, <?= date('l') == 'Monday' ? 'Senin' : (date('l') == 'Tuesday' ? 'Selasa' : (date('l') == 'Wednesday' ? 'Rabu' : (date('l') == 'Thursday' ? 'Kamis' : (date('l') == 'Friday' ? 'Jumat' : (date('l') == 'Saturday' ? 'Sabtu' : 'Minggu'))))) ?></span>
    </div>
</div>

<!-- 4 Top Stat Cards Row -->
<div class="row g-4 mb-4">
    <!-- Card 1: Total Project -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card stat-card-pink">
            <div class="stat-card-body">
                <div class="stat-icon-wrapper icon-pink">
                    <i class="ri-briefcase-4-fill"></i>
                </div>
                <div class="stat-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="stat-label">Total Project</span>
                        <div class="dropdown">
                            <button class="stat-more-btn" data-bs-toggle="dropdown"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="<?= base_url('admin/projects') ?>">Kelola Project</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="stat-value"><?= $total_projects ?? 0 ?></h2>
                    <div class="stat-trend trend-up">
                        <i class="ri-arrow-up-line"></i> <span>12%</span> <small class="text-muted ms-1">dari bulan lalu</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 2: Total Brand -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card stat-card-purple">
            <div class="stat-card-body">
                <div class="stat-icon-wrapper icon-purple">
                    <i class="ri-vip-diamond-fill"></i>
                </div>
                <div class="stat-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="stat-label">Total Brand</span>
                        <div class="dropdown">
                            <button class="stat-more-btn" data-bs-toggle="dropdown"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="<?= base_url('admin/brands') ?>">Kelola Brand</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="stat-value"><?= $total_brands ?? 0 ?></h2>
                    <div class="stat-trend trend-up">
                        <i class="ri-arrow-up-line"></i> <span>8%</span> <small class="text-muted ms-1">dari bulan lalu</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Pesan Baru -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card stat-card-pink-soft">
            <div class="stat-card-body">
                <div class="stat-icon-wrapper icon-pink-soft">
                    <i class="ri-mail-open-fill"></i>
                </div>
                <div class="stat-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="stat-label">Pesan Baru</span>
                        <div class="dropdown">
                            <button class="stat-more-btn" data-bs-toggle="dropdown"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="<?= base_url('admin/contact-messages') ?>">Lihat Pesan</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="stat-value"><?= $total_messages ?? 0 ?></h2>
                    <div class="stat-trend trend-neutral">
                        <span class="trend-minus">—</span> <small class="text-muted ms-1"><?= ($total_messages ?? 0) > 0 ? $total_messages . ' pesan belum dibaca' : 'Tidak ada pesan baru' ?></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 4: Prestasi Diraih -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="stat-card stat-card-gold">
            <div class="stat-card-body">
                <div class="stat-icon-wrapper icon-gold">
                    <i class="ri-trophy-fill"></i>
                </div>
                <div class="stat-info">
                    <div class="d-flex align-items-center justify-content-between">
                        <span class="stat-label">Prestasi Diraih</span>
                        <div class="dropdown">
                            <button class="stat-more-btn" data-bs-toggle="dropdown"><i class="ri-more-fill"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li><a class="dropdown-item" href="<?= base_url('admin/achievements') ?>">Kelola Prestasi</a></li>
                            </ul>
                        </div>
                    </div>
                    <h2 class="stat-value"><?= $total_achievements ?? 0 ?></h2>
                    <div class="stat-trend trend-up">
                        <i class="ri-arrow-up-line"></i> <span>20%</span> <small class="text-muted ms-1">dari bulan lalu</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Middle Section Row -->
<div class="row g-4 mb-4">
    <!-- Project per Kategori (Donut Chart & List) -->
    <div class="col-12 col-lg-7 col-xl-8">
        <div class="dashboard-card h-100">
            <div class="dashboard-card-header d-flex align-items-center justify-content-between">
                <h3 class="card-title-text mb-0">Project per Kategori</h3>
                <div class="dropdown">
                    <button class="btn btn-sm btn-pink-light rounded-pill px-3 dropdown-toggle" data-bs-toggle="dropdown">
                        Bulan Ini
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                        <li><a class="dropdown-item" href="#">Hari Ini</a></li>
                        <li><a class="dropdown-item" href="#">Minggu Ini</a></li>
                        <li><a class="dropdown-item active" href="#">Bulan Ini</a></li>
                        <li><a class="dropdown-item" href="#">Semua Waktu</a></li>
                    </ul>
                </div>
            </div>
            <div class="dashboard-card-body">
                <div class="row align-items-center">
                    <!-- Donut Graphic Visual -->
                    <div class="col-12 col-md-5 mb-4 mb-md-0 text-center">
                        <div class="donut-chart-container mx-auto">
                            <svg viewBox="0 0 100 100" class="donut-chart-svg">
                                <circle cx="50" cy="50" r="38" class="donut-bg"></circle>
                                <?php 
                                    $totProj = max(1, $total_projects ?? 0);
                                    $colors = ['#ff69b4', '#ab47bc', '#ec407a', '#ffa726', '#26a69a', '#42a5f5', '#7e57c2'];
                                    $offset = 0;
                                    if(!empty($projects_by_category)) {
                                        foreach($projects_by_category as $idx => $cat) {
                                            $pct = ($cat['total'] / $totProj) * 100;
                                            $strokeDash = ($pct * 238.76) / 100;
                                            $color = $colors[$idx % count($colors)];
                                            echo '<circle cx="50" cy="50" r="38" stroke="' . $color . '" stroke-width="12" fill="none" stroke-dasharray="' . $strokeDash . ' 238.76" stroke-dashoffset="-' . $offset . '"></circle>';
                                            $offset += $strokeDash;
                                        }
                                    } else {
                                        echo '<circle cx="50" cy="50" r="38" stroke="#ff69b4" stroke-width="12" fill="none" stroke-dasharray="238.76 238.76"></circle>';
                                    }
                                ?>
                            </svg>
                            <div class="donut-inner-text">
                                <span class="donut-count"><?= $total_projects ?? 0 ?></span>
                                <span class="donut-label">Total Project</span>
                            </div>
                        </div>
                    </div>
                    <!-- Category Breakdown List -->
                    <div class="col-12 col-md-7">
                        <div class="category-breakdown-grid">
                            <?php if(!empty($projects_by_category)): ?>
                                <?php foreach($projects_by_category as $idx => $cat): 
                                    $color = $colors[$idx % count($colors)];
                                    $pct = $totProj > 0 ? round(($cat['total'] / $totProj) * 100) : 0;
                                ?>
                                <div class="category-item-row">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="category-dot" style="background-color: <?= $color ?>;"></span>
                                        <span class="category-name"><?= esc($cat['name']) ?></span>
                                    </div>
                                    <div class="d-flex align-items-center gap-3">
                                        <span class="category-count"><?= $cat['total'] ?></span>
                                        <span class="category-pct"><?= $pct ?>%</span>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-4 text-muted">Belum ada kategori project</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pintasan Menu (Quick Actions) -->
    <div class="col-12 col-lg-5 col-xl-4">
        <div class="dashboard-card h-100">
            <div class="dashboard-card-header">
                <h3 class="card-title-text mb-0">Pintasan Menu</h3>
            </div>
            <div class="dashboard-card-body">
                <div class="quick-actions-list">
                    <!-- Action 1: Tambah Project Baru -->
                    <a href="<?= base_url('admin/projects') ?>" class="quick-action-item">
                        <div class="quick-action-icon action-icon-pink">
                            <i class="ri-add-circle-fill"></i>
                        </div>
                        <div class="quick-action-info">
                            <h4 class="quick-action-title">Tambah Project Baru</h4>
                            <span class="quick-action-desc">Buat project baru sekarang</span>
                        </div>
                        <div class="quick-action-arrow">
                            <i class="ri-arrow-right-s-line"></i>
                        </div>
                    </a>

                    <!-- Action 2: Edit Landing Page Hero -->
                    <a href="<?= base_url('admin/hero') ?>" class="quick-action-item">
                        <div class="quick-action-icon action-icon-purple">
                            <i class="ri-layout-top-2-fill"></i>
                        </div>
                        <div class="quick-action-info">
                            <h4 class="quick-action-title">Edit Landing Page Hero</h4>
                            <span class="quick-action-desc">Perbarui konten hero section</span>
                        </div>
                        <div class="quick-action-arrow">
                            <i class="ri-arrow-right-s-line"></i>
                        </div>
                    </a>

                    <!-- Action 3: Kelola Prestasi -->
                    <a href="<?= base_url('admin/achievements') ?>" class="quick-action-item">
                        <div class="quick-action-icon action-icon-gold">
                            <i class="ri-trophy-fill"></i>
                        </div>
                        <div class="quick-action-info">
                            <h4 class="quick-action-title">Kelola Prestasi</h4>
                            <span class="quick-action-desc">Tambah atau edit pencapaian</span>
                        </div>
                        <div class="quick-action-arrow">
                            <i class="ri-arrow-right-s-line"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bottom Section: Project Terbaru Table -->
<div class="row">
    <div class="col-12">
        <div class="dashboard-card">
            <div class="dashboard-card-header d-flex align-items-center justify-content-between flex-wrap gap-2">
                <div class="d-flex align-items-center gap-2">
                    <div class="header-badge-icon">
                        <i class="ri-briefcase-4-fill"></i>
                    </div>
                    <h3 class="card-title-text mb-0">Project Terbaru</h3>
                </div>
                <a href="<?= base_url('admin/projects') ?>" class="btn-see-all">
                    <span>Lihat Semua</span>
                    <i class="ri-arrow-right-s-line ms-1"></i>
                </a>
            </div>
            <div class="dashboard-card-body p-0">
                <div class="table-responsive">
                    <table class="table table-pink-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th style="width: 35%;">Project</th>
                                <th style="width: 20%;">Kategori</th>
                                <th style="width: 15%;">Status</th>
                                <th style="width: 15%;">Tanggal</th>
                                <th style="width: 15%; text-align: right;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($recent_projects)): ?>
                                <?php foreach($recent_projects as $p): ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="project-table-thumb-wrapper">
                                                <?php if(!empty($p['thumbnail'])): ?>
                                                    <img src="<?= base_url('assets/uploads/projects/' . $p['thumbnail']) ?>" alt="<?= esc($p['title']) ?>" class="project-table-thumb" onerror="this.src='https://placehold.co/100x70/ff69b4/ffffff?text=Project'">
                                                <?php else: ?>
                                                    <div class="project-table-thumb-placeholder">
                                                        <i class="ri-image-2-line"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div>
                                                <h5 class="project-table-title mb-1"><?= esc($p['title']) ?></h5>
                                                <p class="project-table-desc mb-0 text-muted extra-small text-truncate" style="max-width: 280px;"><?= esc($p['description'] ?? 'Project portofolio terbaik') ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge-cat-pink">
                                            <?= esc($p['category_name'] ?? 'General') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <span class="status-pill status-published">
                                            <span class="status-dot"></span> Published
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-muted small"><?= date('d M Y', strtotime($p['created_at'] ?? 'now')) ?></span>
                                    </td>
                                    <td text-align="right">
                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                            <a href="<?= base_url('admin/projects') ?>" class="tbl-action-btn btn-view" title="Lihat">
                                                <i class="ri-eye-line"></i>
                                            </a>
                                            <a href="<?= base_url('admin/projects') ?>" class="tbl-action-btn btn-edit" title="Edit">
                                                <i class="ri-pencil-line"></i>
                                            </a>
                                            <a href="<?= base_url('admin/projects') ?>" class="tbl-action-btn btn-delete" title="Hapus" onclick="return confirm('Yakin ingin menghapus?')">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">Belum ada project terbaru</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

