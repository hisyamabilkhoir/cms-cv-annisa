<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0 fw-bold text-dark">Pengelolaan About Me Section</h1>
</div>

<!-- Nav Tabs -->
<ul class="nav nav-pills custom-tabs mb-4" id="aboutTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">
            <i class="ri-settings-4-line me-1"></i> Pengaturan Utama
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="icons-tab" data-bs-toggle="tab" data-bs-target="#icons" type="button" role="tab">
            <i class="ri-grid-fill me-1"></i> Strategi & Icons
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="ministats-tab" data-bs-toggle="tab" data-bs-target="#ministats" type="button" role="tab">
            <i class="ri-bar-chart-2-line me-1"></i> Mini Stats
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="cards-tab" data-bs-toggle="tab" data-bs-target="#cards" type="button" role="tab">
            <i class="ri-layout-grid-line me-1"></i> Kartu Fitur & Keahlian
        </button>
    </li>
</ul>

<div class="tab-content" id="aboutTabsContent">
    <!-- TAB 1: PENGATURAN UTAMA -->
    <div class="tab-pane fade show active" id="settings" role="tabpanel">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="ri-user-heart-line me-2 text-pink"></i> Edit Teks & Background About</h5>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/about/update') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="row g-4">
                        <div class="col-md-8">
                            <!-- Teks Badge -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Teks Badge (Pill)</label>
                                <input type="text" class="form-control" name="pill_text" value="<?= esc($about['pill_text'] ?? 'About Me') ?>" required>
                            </div>

                            <!-- Split Judul Fields -->
                            <div class="p-3 rounded-4 mb-3" style="background: rgba(255, 240, 246, 0.35); border: 1px solid rgba(255, 105, 180, 0.2);">
                                <label class="form-label fw-bold text-pink mb-2"><i class="ri-heading me-1"></i> Pengaturan Judul About</label>
                                
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold">Judul Baris 1 (Teks Utama)</label>
                                        <input type="text" class="form-control" name="title_line1" value="<?= esc($parsedTitle['title_line1'] ?? '') ?>" required placeholder="Contoh: Menciptakan konten yang">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-pink"><i class="ri-magic-line me-1"></i> Kata Berwarna Pink (Highlight)</label>
                                        <input type="text" class="form-control border-pink" name="title_pink" value="<?= esc($parsedTitle['title_pink'] ?? '') ?>" placeholder="Contoh: berkesan">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label small fw-bold">Judul Baris 2 (Garis Baru)</label>
                                        <input type="text" class="form-control" name="title_line2" value="<?= esc($parsedTitle['title_line2'] ?? '') ?>" placeholder="Contoh: bukan hanya sekadar viral.">
                                    </div>
                                </div>
                                <small class="text-muted d-block mt-2"><i class="ri-information-line me-1"></i> Kata berwarna pink akan otomatis di-highlight dengan efek gradasi pink tanpa perlu mengetik kode HTML.</small>
                            </div>

                            <!-- Deskripsi -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control" name="description" rows="4" required><?= esc($about['description'] ?? '') ?></textarea>
                            </div>
                        </div>

                        <!-- Right Column: Media Uploads (BG Desktop & BG Mobile) -->
                        <div class="col-md-4">
                            <!-- Background Desktop -->
                            <div class="p-3 rounded-4 mb-3" style="background: rgba(255, 240, 246, 0.35); border: 1px solid rgba(255, 105, 180, 0.2);">
                                <label class="form-label fw-bold">Background Desktop</label>
                                <input type="file" class="form-control image-preview-input mb-2" name="bg_image" data-preview="bg-image-preview" accept="image/*">
                                <small class="text-muted d-block mb-2">Biarkan kosong jika tidak ingin mengubah.</small>

                                <div class="preview-img-container text-center rounded-3 overflow-hidden p-1" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(255,105,180,0.15);">
                                    <?php if(!empty($about['bg_image'])): ?>
                                        <img id="bg-image-preview" src="<?= base_url('assets/uploads/about/' . $about['bg_image']) ?>" style="width: 100%; max-height: 180px; object-fit: contain; border-radius: 12px;">
                                    <?php else: ?>
                                        <img id="bg-image-preview" src="" style="width: 100%; max-height: 180px; object-fit: contain; border-radius: 12px; display: none;">
                                        <span class="text-muted small py-3 d-block" id="bg-image-preview-placeholder">Preview background desktop.</span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Background Mobile -->
                            <div class="p-3 rounded-4" style="background: rgba(255, 240, 246, 0.35); border: 1px solid rgba(255, 105, 180, 0.2);">
                                <label class="form-label fw-bold">Background Mobile</label>
                                <input type="file" class="form-control image-preview-input mb-2" name="bg_mobile" data-preview="bg-mobile-preview" accept="image/*">
                                <small class="text-muted d-block mb-2">Biarkan kosong jika tidak ingin mengubah.</small>
                                
                                <div class="preview-img-container text-center rounded-3 overflow-hidden p-1" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(255,105,180,0.15);">
                                    <?php if(!empty($about['bg_mobile'])): ?>
                                        <img id="bg-mobile-preview" src="<?= base_url('assets/uploads/about/' . $about['bg_mobile']) ?>" style="width: 100%; max-height: 180px; object-fit: contain; border-radius: 12px;">
                                    <?php else: ?>
                                        <img id="bg-mobile-preview" src="" style="width: 100%; max-height: 180px; object-fit: contain; border-radius: 12px; display: none;">
                                        <span class="text-muted small py-3 d-block" id="bg-mobile-preview-placeholder">Preview background mobile.</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary"><i class="ri-save-line me-2"></i> Simpan Perubahan Utama</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- TAB 2: STRATEGI & ICONS -->
    <div class="tab-pane fade" id="icons" role="tabpanel">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0"><i class="ri-grid-fill me-2 text-pink"></i> Daftar Strategi & Icons</h5>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addIconModal">
                    <i class="ri-add-line me-1"></i> Tambah Item Icon
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle datatable">
                        <thead>
                            <tr>
                                <th style="width: 60px;">IKON</th>
                                <th>LABEL STRATEGI</th>
                                <th style="width: 100px;">URUTAN</th>
                                <th style="width: 120px;" class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($icons)) : ?>
                                <?php foreach ($icons as $item) : ?>
                                    <tr>
                                        <td>
                                            <div class="rounded-3 p-2 text-center" style="background: rgba(255, 105, 180, 0.1); width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                                                <i class="<?= esc($item['icon']) ?> fs-4 text-pink"></i>
                                            </div>
                                        </td>
                                        <td>
                                            <strong class="text-dark"><?= nl2br(esc($item['label'])) ?></strong>
                                        </td>
                                        <td><span class="badge bg-light text-dark border"><?= $item['sort_order'] ?></span></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-sm btn-outline-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#editIconModal<?= $item['id'] ?>" title="Edit">
                                                    <i class="ri-pencil-line"></i>
                                                </button>
                                                <form action="<?= base_url('admin/about/icon/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 3: MINI STATS -->
    <div class="tab-pane fade" id="ministats" role="tabpanel">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0"><i class="ri-bar-chart-2-line me-2 text-pink"></i> Daftar Mini Stats</h5>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addMiniStatModal">
                    <i class="ri-add-line me-1"></i> Tambah Mini Stat
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle datatable">
                        <thead>
                            <tr>
                                <th style="width: 60px;">IKON</th>
                                <th>LABEL STATS</th>
                                <th>NILAI / VALUE</th>
                                <th style="width: 100px;">URUTAN</th>
                                <th style="width: 120px;" class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($miniStats)) : ?>
                                <?php foreach ($miniStats as $item) : ?>
                                    <tr>
                                        <td>
                                            <div class="rounded-3 p-2 text-center" style="background: rgba(255, 105, 180, 0.1); width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                                                <i class="<?= esc($item['icon']) ?> fs-4 text-pink"></i>
                                            </div>
                                        </td>
                                        <td><strong class="text-dark"><?= esc($item['label']) ?></strong></td>
                                        <td><span class="badge bg-pink-subtle text-pink px-3 py-2 rounded-pill fw-bold"><?= esc($item['value']) ?></span></td>
                                        <td><span class="badge bg-light text-dark border"><?= $item['sort_order'] ?></span></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-sm btn-outline-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#editMiniStatModal<?= $item['id'] ?>" title="Edit">
                                                    <i class="ri-pencil-line"></i>
                                                </button>
                                                <form action="<?= base_url('admin/about/ministat/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- TAB 4: KARTU FITUR -->
    <div class="tab-pane fade" id="cards" role="tabpanel">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0"><i class="ri-layout-grid-line me-2 text-pink"></i> Daftar Kartu Fitur & Keahlian</h5>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCardModal">
                    <i class="ri-add-line me-1"></i> Tambah Kartu Fitur
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table align-middle datatable">
                        <thead>
                            <tr>
                                <th style="width: 60px;">IKON</th>
                                <th>JUDUL KARTU</th>
                                <th>DESKRIPSI KARTU</th>
                                <th style="width: 100px;">URUTAN</th>
                                <th style="width: 120px;" class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($cards)) : ?>
                                <?php foreach ($cards as $item) : ?>
                                    <tr>
                                        <td>
                                            <div class="rounded-3 p-2 text-center" style="background: rgba(255, 105, 180, 0.1); width: 44px; height: 44px; display: flex; align-items: center; justify-content: center;">
                                                <i class="<?= esc($item['icon']) ?> fs-4 text-pink"></i>
                                            </div>
                                        </td>
                                        <td><strong class="text-dark"><?= esc($item['title']) ?></strong></td>
                                        <td><small class="text-muted"><?= esc($item['description']) ?></small></td>
                                        <td><span class="badge bg-light text-dark border"><?= $item['sort_order'] ?></span></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button type="button" class="btn btn-sm btn-outline-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#editCardModal<?= $item['id'] ?>" title="Edit">
                                                    <i class="ri-pencil-line"></i>
                                                </button>
                                                <form action="<?= base_url('admin/about/card/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-sm btn-outline-danger rounded-circle" title="Hapus">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- MODALS ABOUT ICONS -->
<!-- ========================================== -->

<!-- Modal Add Icon -->
<div class="modal fade" id="addIconModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark"><i class="ri-add-circle-line me-2 text-pink"></i> Tambah Item Icon Strategy</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/about/icon/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Class Icon (Bootstrap / Remix Icon)</label>
                        <input type="text" class="form-control" name="icon" placeholder="Contoh: bi bi-tiktok" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Label Strategi</label>
                        <textarea class="form-control" name="label" rows="2" placeholder="Contoh: Hook&#10;Strategy" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Urutan</label>
                        <input type="number" class="form-control" name="sort_order" value="1" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="ri-save-line me-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals Edit Icon -->
<?php if (!empty($icons)) : ?>
    <?php foreach ($icons as $item) : ?>
        <div class="modal fade" id="editIconModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow-lg">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold text-dark"><i class="ri-pencil-line me-2 text-pink"></i> Edit Item Icon Strategy</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('admin/about/icon/update/' . $item['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="modal-body py-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Class Icon</label>
                                <input type="text" class="form-control" name="icon" value="<?= esc($item['icon']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Label Strategi</label>
                                <textarea class="form-control" name="label" rows="2" required><?= esc($item['label']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Urutan</label>
                                <input type="number" class="form-control" name="sort_order" value="<?= $item['sort_order'] ?>" required>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="ri-save-line me-1"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- ========================================== -->
<!-- MODALS ABOUT MINI STATS -->
<!-- ========================================== -->

<!-- Modal Add Mini Stat -->
<div class="modal fade" id="addMiniStatModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark"><i class="ri-add-circle-line me-2 text-pink"></i> Tambah Mini Stat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/about/ministat/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Class Icon</label>
                        <input type="text" class="form-control" name="icon" placeholder="Contoh: bi bi-clock" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Label Stat</label>
                        <input type="text" class="form-control" name="label" placeholder="Contoh: Delivery" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nilai / Value</label>
                        <input type="text" class="form-control" name="value" placeholder="Contoh: 24–72h" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Urutan</label>
                        <input type="number" class="form-control" name="sort_order" value="1" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="ri-save-line me-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals Edit Mini Stat -->
<?php if (!empty($miniStats)) : ?>
    <?php foreach ($miniStats as $item) : ?>
        <div class="modal fade" id="editMiniStatModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow-lg">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold text-dark"><i class="ri-pencil-line me-2 text-pink"></i> Edit Mini Stat</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('admin/about/ministat/update/' . $item['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="modal-body py-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Class Icon</label>
                                <input type="text" class="form-control" name="icon" value="<?= esc($item['icon']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Label Stat</label>
                                <input type="text" class="form-control" name="label" value="<?= esc($item['label']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Nilai / Value</label>
                                <input type="text" class="form-control" name="value" value="<?= esc($item['value']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Urutan</label>
                                <input type="number" class="form-control" name="sort_order" value="<?= $item['sort_order'] ?>" required>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="ri-save-line me-1"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<!-- ========================================== -->
<!-- MODALS ABOUT CARDS -->
<!-- ========================================== -->

<!-- Modal Add Card -->
<div class="modal fade" id="addCardModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold text-dark"><i class="ri-add-circle-line me-2 text-pink"></i> Tambah Kartu Fitur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="<?= base_url('admin/about/card/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body py-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Class Icon</label>
                        <input type="text" class="form-control" name="icon" placeholder="Contoh: bi bi-lightning-charge" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Kartu</label>
                        <input type="text" class="form-control" name="title" placeholder="Contoh: Hook & Structure" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control" name="description" rows="3" placeholder="Deskripsi singkat..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Urutan</label>
                        <input type="number" class="form-control" name="sort_order" value="1" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="ri-save-line me-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modals Edit Card -->
<?php if (!empty($cards)) : ?>
    <?php foreach ($cards as $item) : ?>
        <div class="modal fade" id="editCardModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-4 border-0 shadow-lg">
                    <div class="modal-header border-0 pb-0">
                        <h5 class="modal-title fw-bold text-dark"><i class="ri-pencil-line me-2 text-pink"></i> Edit Kartu Fitur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="<?= base_url('admin/about/card/update/' . $item['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="modal-body py-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Class Icon</label>
                                <input type="text" class="form-control" name="icon" value="<?= esc($item['icon']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Judul Kartu</label>
                                <input type="text" class="form-control" name="title" value="<?= esc($item['title']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Deskripsi</label>
                                <textarea class="form-control" name="description" rows="3" required><?= esc($item['description']) ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Urutan</label>
                                <input type="number" class="form-control" name="sort_order" value="<?= $item['sort_order'] ?>" required>
                            </div>
                        </div>
                        <div class="modal-footer border-0 pt-0">
                            <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="ri-save-line me-1"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Image Preview Handling
    const imageInputs = document.querySelectorAll('.image-preview-input');
    imageInputs.forEach(input => {
        input.addEventListener('change', function() {
            const previewId = this.dataset.preview;
            if (previewId) {
                const previewImg = document.getElementById(previewId);
                const placeholder = document.getElementById(previewId + '-placeholder');
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        if (previewImg) {
                            previewImg.src = e.target.result;
                            previewImg.style.display = 'block';
                        }
                        if (placeholder) {
                            placeholder.style.display = 'none';
                        }
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            }
        });
    });

    // Hash navigation for Tabs
    let hash = window.location.hash;
    if (hash) {
        let triggerEl = document.querySelector('#aboutTabs button[data-bs-target="' + hash + '"]');
        if (triggerEl) {
            let tab = new bootstrap.Tab(triggerEl);
            tab.show();
        }
    }
});
</script>
<?= $this->endSection() ?>
