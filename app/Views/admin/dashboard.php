<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>

<!-- Welcome Header Row -->
<div class="admin-page-header">
    <div>
        <h1 class="mb-1">Hai, <?= session()->get('admin_name') ?? 'Annisa' ?>! <span class="wave-emoji">👋</span></h1>
        <p class="text-muted mb-0">Kelola konten website dan pantau semua aktivitas dengan mudah.</p>
    </div>
    <div class="date-badge-card d-flex align-items-center">
        <i class="ri-time-line me-2 text-pink fs-5"></i>
        <span id="realtimeClockText" class="fw-semibold"></span>
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
                                <li><a class="dropdown-item" href="<?= base_url('admin/contacts') ?>">Lihat Pesan</a></li>
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
                <div class="row align-items-start">
                    <!-- Donut Graphic Visuals (Project & Galeri) -->
                    <div class="col-12 col-md-5 mb-4 mb-md-0 text-center d-flex flex-column align-items-center gap-4">
                        <!-- Donut 1: Total Project -->
                        <div>
                            <div class="donut-chart-container mx-auto">
                                <svg viewBox="0 0 100 100" class="donut-chart-svg">
                                    <circle cx="50" cy="50" r="38" class="donut-bg"></circle>
                                    <?php 
                                        $totProj = max(1, $total_projects ?? 0);
                                        $colors = [
                                            '#ff3385', '#8e44ad', '#ff6b6b', '#f39c12', 
                                            '#1abc9c', '#2980b9', '#e84393', '#00b894', 
                                            '#fdcb6e', '#6c5ce7', '#e17055', '#0984e3', 
                                            '#d63031', '#fd79a8', '#00cec9', '#9c27b0',
                                            '#ff9800', '#4caf50'
                                        ];

                                        if (!function_exists('getCatColor')) {
                                            function getCatColor($index, $palette) {
                                                if ($index < count($palette)) {
                                                    return $palette[$index];
                                                }
                                                $hue = ($index * 137.5) % 360;
                                                return "hsl(" . round($hue) . ", 80%, 60%)";
                                            }
                                        }

                                        $offset = 0;
                                        if(!empty($projects_by_category)) {
                                            foreach($projects_by_category as $idx => $cat) {
                                                $pct = ($cat['total'] / $totProj) * 100;
                                                $strokeDash = ($pct * 238.76) / 100;
                                                $color = getCatColor($idx, $colors);
                                                echo '<circle cx="50" cy="50" r="38" stroke="' . $color . '" stroke-width="12" fill="none" stroke-dasharray="' . $strokeDash . ' 238.76" stroke-dashoffset="-' . $offset . '"></circle>';
                                                $offset += $strokeDash;
                                            }
                                        } else {
                                            echo '<circle cx="50" cy="50" r="38" stroke="#ff3385" stroke-width="12" fill="none" stroke-dasharray="238.76 238.76"></circle>';
                                        }
                                    ?>
                                </svg>
                                <div class="donut-inner-text">
                                    <span class="donut-count"><?= $total_projects ?? 0 ?></span>
                                    <span class="donut-label">Total Project</span>
                                </div>
                            </div>
                        </div>

                        <!-- Donut 2: Total Galeri di Semua Project -->
                        <div>
                            <div class="donut-chart-container mx-auto">
                                <svg viewBox="0 0 100 100" class="donut-chart-svg">
                                    <circle cx="50" cy="50" r="38" class="donut-bg"></circle>
                                    <?php 
                                        $totGal = max(1, $total_galleries ?? 0);
                                        $offsetGal = 0;
                                        if(!empty($galleries_by_category)) {
                                            foreach($galleries_by_category as $idx => $cat) {
                                                $pctG = ($cat['total'] / $totGal) * 100;
                                                $strokeDashG = ($pctG * 238.76) / 100;
                                                $colorG = getCatColor($idx, $colors);
                                                echo '<circle cx="50" cy="50" r="38" stroke="' . $colorG . '" stroke-width="12" fill="none" stroke-dasharray="' . $strokeDashG . ' 238.76" stroke-dashoffset="-' . $offsetGal . '"></circle>';
                                                $offsetGal += $strokeDashG;
                                            }
                                        } else {
                                            echo '<circle cx="50" cy="50" r="38" stroke="#e84393" stroke-width="12" fill="none" stroke-dasharray="238.76 238.76"></circle>';
                                        }
                                    ?>
                                </svg>
                                <div class="donut-inner-text">
                                    <span class="donut-count text-pink"><?= $total_galleries ?? 0 ?></span>
                                    <span class="donut-label">Total Galeri</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Category & Gallery Breakdown List (Samping Donut) -->
                    <div class="col-12 col-md-7">
                        <!-- Header Nav Tabs untuk beralih antara Kategori & Per Project -->
                        <div class="d-flex align-items-center justify-content-between mb-3 pb-2 border-bottom flex-wrap gap-2">
                            <div class="fw-bold small text-dark d-flex align-items-center">
                                <i class="ri-pie-chart-2-fill text-pink me-1.5 fs-6"></i>
                                <span>Rincian Proyek & Galeri</span>
                            </div>
                            <div class="nav-pill-wrapper">
                                <ul class="nav nav-pills border-0 gap-1 p-0 m-0" id="chartBreakdownTabs" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="cat-tab" data-bs-toggle="tab" data-bs-target="#catBreakdown" type="button" role="tab">Proyek</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="proj-gal-tab" data-bs-toggle="tab" data-bs-target="#projGalBreakdown" type="button" role="tab">Galeri</button>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="tab-content" id="chartBreakdownContent">
                            <!-- TAB 1: BREAKDOWN KATEGORI PROJECT -->
                            <div class="tab-pane fade show active" id="catBreakdown" role="tabpanel">
                                <div class="category-breakdown-grid" style="max-height: 290px; overflow-y: auto;">
                                    <?php if(!empty($projects_by_category)): ?>
                                        <?php foreach($projects_by_category as $idx => $cat): 
                                            $color = getCatColor($idx, $colors);
                                            $pct = $totProj > 0 ? round(($cat['total'] / $totProj) * 100) : 0;
                                        ?>
                                        <div class="category-item-row py-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="category-dot" style="background-color: <?= $color ?>;"></span>
                                                <span class="category-name fw-semibold text-dark"><?= esc($cat['name']) ?></span>
                                            </div>
                                            <div class="d-flex align-items-center gap-3">
                                                <span class="category-count fw-bold"><?= $cat['total'] ?> Project</span>
                                                <span class="category-pct text-muted"><?= $pct ?>%</span>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="text-center py-4 text-muted">Belum ada data kategori</div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- TAB 2: BREAKDOWN TOTAL GALERI PER PROJECT -->
                            <div class="tab-pane fade" id="projGalBreakdown" role="tabpanel">
                                <div class="project-gallery-breakdown-list" style="max-height: 290px; overflow-y: auto;">
                                    <?php if(!empty($galleries_by_project)): ?>
                                        <?php foreach($galleries_by_project as $gProj): ?>
                                        <div class="category-item-row py-2 d-flex align-items-center justify-content-between border-bottom border-light">
                                            <div class="overflow-hidden me-2">
                                                <div class="fw-bold small text-dark text-truncate" style="max-width: 170px;">
                                                    <i class="ri-folder-image-line me-1 text-pink"></i><?= esc($gProj['project_title']) ?>
                                                </div>
                                                <span class="badge bg-pink-soft text-pink extra-small" style="font-size: 10px; padding: 2px 6px; border-radius: 6px;"><?= esc($gProj['category_name'] ?? 'Umum') ?></span>
                                            </div>
                                            <div class="text-end flex-shrink-0">
                                                <span class="badge bg-pink-gradient text-white fw-bold shadow-sm" style="background: linear-gradient(135deg, #ff69b4 0%, #ec407a 100%); font-size: 11px; padding: 4px 8px; border-radius: 8px;">
                                                    <i class="ri-image-line me-1"></i><?= $gProj['total_media'] ?> Media
                                                </span>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="text-center py-3 text-muted">
                                            <i class="ri-image-add-line fs-3 text-pink opacity-50 d-block mb-1"></i>
                                            <span class="small">Belum ada foto/video di galeri project</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
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

                    <!-- Action 4: Kelola Galeri Proyek -->
                    <a href="<?= base_url('admin/projects') ?>" class="quick-action-item">
                        <div class="quick-action-icon action-icon-teal">
                            <i class="ri-gallery-fill"></i>
                        </div>
                        <div class="quick-action-info">
                            <h4 class="quick-action-title">Kelola Galeri Proyek</h4>
                            <span class="quick-action-desc">Kelola foto & video karya di galeri</span>
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

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    function updateRealtimeClock() {
        const clockEl = document.getElementById('realtimeClockText');
        if (!clockEl) return;

        const now = new Date();
        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        const dayName = days[now.getDay()];
        const dayDate = now.getDate();
        const monthName = months[now.getMonth()];
        const year = now.getFullYear();

        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        clockEl.innerHTML = `${dayDate} ${monthName} ${year}, ${dayName} <span class="mx-1 text-pink fw-bold">•</span> ${hours}:${minutes}:${seconds} WIB`;
    }

    setInterval(updateRealtimeClock, 1000);
    updateRealtimeClock();
});
</script>
<?= $this->endSection() ?>

