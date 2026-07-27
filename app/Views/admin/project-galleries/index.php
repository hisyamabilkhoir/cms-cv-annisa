<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<!-- Breadcrumb & Header -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-1 small text-muted">
                <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>" class="text-muted text-decoration-none">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/projects') ?>" class="text-muted text-decoration-none">Data Project</a></li>
                <li class="breadcrumb-item active text-pink" aria-current="page">Galeri Proyek</li>
            </ol>
        </nav>
        <h1 class="h4 mb-0 fw-bold text-dark">Galeri Proyek</h1>
    </div>
    <div>
        <button type="button" class="btn btn-primary rounded-pill px-4" id="toggleAddFormBtn">
            <i class="ri-add-line me-1"></i> Tambah Galeri
        </button>
    </div>
</div>

<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
        <i class="ri-checkbox-circle-line me-2"></i> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')) : ?>
    <div class="alert alert-danger alert-dismissible fade show rounded-4 border-0 shadow-sm mb-4" role="alert">
        <i class="ri-error-warning-line me-2"></i> <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- FORM TAMBAH GALERI REPEATER (Multiple Item Rows) -->
<div class="card mb-4 border-0 shadow-sm rounded-4 overflow-hidden" id="addGalleryCard">
    <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold text-dark mb-0"><i class="ri-gallery-upload-line me-2 text-pink"></i> Tambah Galeri Baru</h5>
        <span class="badge bg-pink-subtle text-pink rounded-pill px-3 py-2" id="itemCounterBadge">1 Item Form</span>
    </div>
    <div class="card-body p-4">
        <form action="<?= base_url('admin/project-galleries/store') ?>" method="post" enctype="multipart/form-data" id="multiGalleryForm">
            <?= csrf_field() ?>

            <!-- Container Baris Form Item Galeri -->
            <div id="galleryItemsContainer">
                <!-- ITEM BLOCK 0 (Default Initial Row) -->
                <div class="gallery-item-block p-4 rounded-4 mb-4 border" style="background: rgba(255, 240, 246, 0.25); border-color: rgba(255, 105, 180, 0.25) !important;" data-index="0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-bold text-pink fs-6"><i class="ri-layout-grid-line me-1"></i> Item Galeri #<span class="item-num">1</span></span>
                        <button type="button" class="btn btn-sm btn-outline-danger rounded-pill px-3 remove-item-btn" style="display: none;" onclick="removeItemBlock(this)">
                            <i class="ri-delete-bin-line me-1"></i> Hapus Baris Ini
                        </button>
                    </div>

                    <input type="hidden" name="items[0][media_type]" class="item-media-type" value="image">

                    <!-- Switcher Tabs: Upload Gambar vs URL YouTube -->
                    <div class="d-inline-flex p-1 rounded-pill mb-4" style="background: #fff; border: 1px solid rgba(255, 105, 180, 0.25);">
                        <button type="button" class="btn btn-sm rounded-pill px-4 fw-bold me-1 btn-primary btn-type-img" onclick="switchItemMediaType(this, 'image')">
                            <i class="ri-upload-cloud-line me-1"></i> Upload Gambar
                        </button>
                        <button type="button" class="btn btn-sm rounded-pill px-4 fw-bold text-muted btn-light btn-type-yt" onclick="switchItemMediaType(this, 'youtube')">
                            <i class="ri-youtube-line me-1"></i> URL YouTube
                        </button>
                    </div>

                    <div class="row g-4">
                        <!-- Left Side: Upload Box OR YouTube Input -->
                        <div class="col-md-6">
                            <!-- Image Box -->
                            <div class="img-container-box">
                                <div class="drop-zone p-4 text-center rounded-4 border-dash position-relative" style="background: #fff; border: 2px dashed rgba(255, 105, 180, 0.4); min-height: 200px; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                    <i class="ri-cloud-upload-line text-pink display-5 mb-2 opacity-75"></i>
                                    <h6 class="fw-bold text-dark mb-1">Drag &amp; drop gambar di sini</h6>
                                    <p class="small text-muted mb-3">atau klik tombol untuk memilih foto</p>
                                    
                                    <label class="btn btn-primary rounded-pill px-4 py-2 cursor-pointer shadow-sm">
                                        <i class="ri-image-add-line me-1"></i> Pilih Gambar
                                        <input type="file" name="items[0][gallery_files][]" multiple accept="image/*" class="d-none gallery-files-input" onchange="previewItemFiles(this)">
                                    </label>
                                    
                                    <span class="small text-muted mt-3">Format: JPG, PNG, WEBP (Bisa pilih banyak foto)</span>
                                </div>
                                <div class="row g-2 mt-2 item-multi-preview"></div>
                            </div>

                            <!-- YouTube Box (With Realtime Validation & Custom Thumbnail Upload) -->
                            <div class="yt-container-box" style="display: none;">
                                <div class="p-4 rounded-4 bg-white" style="border: 1px solid rgba(255, 105, 180, 0.25);">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-dark mb-1"><i class="ri-youtube-fill text-danger me-1"></i> Link Video YouTube *</label>
                                        <input type="text" class="form-control yt-url-input" name="items[0][youtube_url]" placeholder="https://www.youtube.com/watch?v=xxx atau https://youtu.be/xxx" oninput="handleYoutubeInput(this)">
                                        <small class="text-muted"><i class="ri-information-line me-1"></i> Masukkan URL YouTube biasa, Shorts, atau embed.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold text-dark mb-1"><i class="ri-image-add-line text-pink me-1"></i> Upload Gambar Thumbnail Custom (Opsional)</label>
                                        <input type="file" class="form-control yt-custom-thumb-input" name="items[0][custom_thumbnail]" accept="image/*" onchange="previewYtCustomThumb(this)">
                                        <small class="text-muted">Jika diupload, gambar ini akan tampil di landing page dengan ikon tombol Play.</small>
                                    </div>

                                    <!-- Realtime Live Preview Container -->
                                    <div class="yt-preview-area mt-3"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side: Project Selection & Meta Details -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Pilih Project *</label>
                                <select class="form-select" name="items[0][project_id]" required>
                                    <option value="">Pilih project yang sesuai...</option>
                                    <?php foreach ($projects as $p) : ?>
                                        <option value="<?= $p['id'] ?>"><?= esc($p['title']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-8 mb-3">
                                    <label class="form-label fw-bold text-dark">Judul (Opsional)</label>
                                    <input type="text" class="form-control" name="items[0][title]" placeholder="Masukkan judul galeri...">
                                </div>
                                <div class="col-4 mb-3">
                                    <label class="form-label fw-bold text-dark">Urutan (Sort)</label>
                                    <input type="number" class="form-control sort-order-input" name="items[0][sort_order]" value="0" min="0">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-bold text-dark">Deskripsi (Opsional)</label>
                                <textarea class="form-control" name="items[0][description]" rows="3" placeholder="Masukkan deskripsi singkat..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Tambah Baris Form Ke-2 / Ke-3 DST -->
            <div class="mb-4">
                <button type="button" class="btn btn-outline-pink rounded-pill px-4 py-2 border-dashed fw-bold shadow-sm" onclick="addNewGalleryItem()" style="background: rgba(255, 240, 246, 0.5); border: 2px dashed #ff4081; color: #ff4081;">
                    <i class="ri-add-circle-line me-1 fs-5 align-middle"></i> + Tambah Item Galeri Ke-2 / Baris Baru
                </button>
            </div>

            <hr>

            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-light rounded-pill px-4" onclick="resetForm()">Batal</button>
                <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm py-2"><i class="ri-check-line me-1 fs-5 align-middle"></i> Simpan Semua Galeri</button>
            </div>
        </form>
    </div>
</div>

<!-- DAFTAR GALERI CARD (Matching User Mockup Grid) -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-header bg-white border-0 pt-4 px-4 pb-0 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <h5 class="fw-bold text-dark mb-0"><i class="ri-gallery-line me-2 text-pink"></i> Daftar Galeri</h5>
        
        <!-- Filter Controls -->
        <form action="<?= base_url('admin/project-galleries') ?>" method="get" class="d-flex align-items-center gap-2">
            <select name="project_id" class="form-select form-select-sm rounded-pill" onchange="this.form.submit()" style="min-width: 180px;">
                <option value="">Semua Project</option>
                <?php foreach ($projects as $p) : ?>
                    <option value="<?= $p['id'] ?>" <?= ($selectedProject == $p['id']) ? 'selected' : '' ?>><?= esc($p['title']) ?></option>
                <?php endforeach; ?>
            </select>
            <select name="media_type" class="form-select form-select-sm rounded-pill" onchange="this.form.submit()" style="min-width: 130px;">
                <option value="">Semua Tipe</option>
                <option value="image" <?= ($selectedMediaType == 'image') ? 'selected' : '' ?>>Gambar</option>
                <option value="youtube" <?= ($selectedMediaType == 'youtube') ? 'selected' : '' ?>>YouTube</option>
            </select>
            <?php if(!empty($selectedProject) || !empty($selectedMediaType)): ?>
                <a href="<?= base_url('admin/project-galleries') ?>" class="btn btn-sm btn-light rounded-pill" title="Reset Filter"><i class="ri-refresh-line"></i></a>
            <?php endif; ?>
        </form>
    </div>

    <div class="card-body p-4">
        <?php if (!empty($galleries)) : ?>
            <div class="row g-4">
                <?php foreach ($galleries as $item) : ?>
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-sm hover-lift transition-all" style="background: rgba(255, 255, 255, 0.85); border: 1px solid rgba(255, 105, 180, 0.2) !important;">
                            <!-- Media Box Header -->
                            <div class="position-relative overflow-hidden" style="height: 180px; background: rgba(0,0,0,0.03);">
                                <!-- Badge Type & Sort Order -->
                                <div class="position-absolute top-0 start-0 m-3 z-2 d-flex gap-1 align-items-center">
                                    <?php if ($item['media_type'] === 'youtube') : ?>
                                        <span class="badge bg-danger rounded-pill px-3 py-2 shadow-sm"><i class="ri-youtube-fill me-1"></i> YouTube</span>
                                    <?php else : ?>
                                        <span class="badge bg-pink text-white rounded-pill px-3 py-2 shadow-sm" style="background: #ff4081;"><i class="ri-image-fill me-1"></i> Gambar</span>
                                    <?php endif; ?>
                                    <span class="badge bg-white text-dark rounded-pill px-2 py-1 shadow-sm border" style="font-size: 11px; opacity: 0.95;" title="Urutan Tampil"><i class="ri-sort-asc me-1 text-pink"></i>#<?= esc($item['sort_order']) ?></span>
                                </div>

                                <!-- Media Content -->
                                <?php if ($item['media_type'] === 'youtube') : ?>
                                    <?php 
                                        // Extract YouTube ID for default thumbnail fallback
                                        preg_match('/(?:embed\/|watch\?v=|shorts\/|youtu\.be\/)([a-zA-Z0-9_-]+)/i', $item['youtube_url'], $ytMatch);
                                        $ytId = $ytMatch[1] ?? '';
                                        $thumbSrc = !empty($item['custom_thumbnail']) 
                                            ? base_url('assets/uploads/projects/' . $item['custom_thumbnail']) 
                                            : ($ytId ? "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg" : base_url('assets/uploads/projects/' . ($item['project_thumb'] ?? '')));
                                    ?>
                                    <div class="w-100 h-100 position-relative cursor-pointer media-thumb-box" onclick="playCardYoutube(this, '<?= esc($item['youtube_url']) ?>')">
                                        <img src="<?= $thumbSrc ?>" class="w-100 h-100 object-fit-cover">
                                        <div class="position-absolute inset-0 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.35); top:0; left:0; right:0; bottom:0;">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 50px; height: 50px; background: #ff4081; color: white;">
                                                <i class="ri-play-fill fs-3 ms-1"></i>
                                            </div>
                                        </div>
                                    </div>
                                <?php else : ?>
                                    <img src="<?= base_url('assets/uploads/projects/' . $item['file_path']) ?>" class="w-100 h-100 object-fit-cover">
                                <?php endif; ?>
                            </div>

                            <!-- Card Body Info -->
                            <div class="card-body p-3 d-flex flex-column justify-content-between">
                                <div>
                                    <h6 class="fw-bold text-dark mb-1 clamp-1"><?= esc($item['title'] ?? $item['project_title'] ?? 'Galeri Foto') ?></h6>
                                    <p class="small text-pink fw-semibold mb-2 clamp-1"><i class="ri-folder-3-line me-1"></i> <?= esc($item['project_title'] ?? 'Project') ?></p>
                                    <?php if (!empty($item['description'])) : ?>
                                        <p class="small text-muted clamp-2 mb-3"><?= esc($item['description']) ?></p>
                                    <?php endif; ?>
                                </div>

                                <!-- Card Action Icons Footer -->
                                <div class="d-flex justify-content-center gap-2 pt-2 border-top">
                                    <!-- Eye Preview Button -->
                                    <button type="button" class="btn btn-sm btn-light rounded-circle text-muted" data-bs-toggle="modal" data-bs-target="#previewModal<?= $item['id'] ?>" title="Lihat Preview">
                                        <i class="ri-eye-line"></i>
                                    </button>
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-sm btn-light rounded-circle text-primary" data-bs-toggle="modal" data-bs-target="#editGalleryModal<?= $item['id'] ?>" title="Edit">
                                        <i class="ri-pencil-line"></i>
                                    </button>
                                    <!-- Delete Form -->
                                    <form action="<?= base_url('admin/project-galleries/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-light rounded-circle text-danger" title="Hapus">
                                            <i class="ri-delete-bin-line"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL PREVIEW ITEM -->
                    <div class="modal fade" id="previewModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content rounded-4 border-0 shadow-lg overflow-hidden">
                                <div class="modal-header border-0 pb-0">
                                    <h6 class="modal-title fw-bold text-dark"><?= esc($item['title'] ?? $item['project_title']) ?></h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center p-4">
                                    <?php if ($item['media_type'] === 'youtube') : ?>
                                        <div class="ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm position-relative cursor-pointer" onclick="playModalYoutube(this, '<?= esc($item['youtube_url']) ?>')">
                                            <img src="<?= $thumbSrc ?>" class="w-100 h-100 object-fit-cover">
                                            <div class="position-absolute inset-0 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.35); top:0; left:0; right:0; bottom:0;">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center shadow-lg" style="width: 64px; height: 64px; background: #ff4081; color: white;">
                                                    <i class="ri-play-fill fs-2 ms-1"></i>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <img src="<?= base_url('assets/uploads/projects/' . $item['file_path']) ?>" class="img-fluid rounded-4 shadow-sm" style="max-height: 500px;">
                                    <?php endif; ?>
                                    <?php if (!empty($item['description'])) : ?>
                                        <p class="text-muted small mt-3 mb-0"><?= esc($item['description']) ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MODAL EDIT ITEM -->
                    <div class="modal fade" id="editGalleryModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content rounded-4 border-0 shadow-lg">
                                <div class="modal-header border-0 pb-0">
                                    <h5 class="modal-title fw-bold text-dark"><i class="ri-pencil-line me-2 text-pink"></i> Edit Galeri</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="<?= base_url('admin/project-galleries/update/' . $item['id']) ?>" method="post" enctype="multipart/form-data">
                                    <?= csrf_field() ?>
                                    <div class="modal-body py-4">
                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Pilih Project</label>
                                            <select class="form-select" name="project_id" required>
                                                <?php foreach ($projects as $p) : ?>
                                                    <option value="<?= $p['id'] ?>" <?= ($item['project_id'] == $p['id']) ? 'selected' : '' ?>><?= esc($p['title']) ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <div class="row">
                                            <div class="col-8 mb-3">
                                                <label class="form-label fw-bold">Judul (Opsional)</label>
                                                <input type="text" class="form-control" name="title" value="<?= esc($item['title'] ?? '') ?>">
                                            </div>
                                            <div class="col-4 mb-3">
                                                <label class="form-label fw-bold">Urutan (Sort)</label>
                                                <input type="number" class="form-control" name="sort_order" value="<?= esc($item['sort_order'] ?? 0) ?>">
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label fw-bold">Deskripsi (Opsional)</label>
                                            <textarea class="form-control" name="description" rows="3"><?= esc($item['description'] ?? '') ?></textarea>
                                        </div>

                                        <?php if ($item['media_type'] === 'youtube') : ?>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">URL YouTube</label>
                                                <input type="text" class="form-control" name="youtube_url" value="<?= esc($item['youtube_url']) ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Ganti Custom Thumbnail (Opsional)</label>
                                                <input type="file" class="form-control" name="custom_thumbnail" accept="image/*">
                                                <small class="text-muted">Biarkan kosong jika tetap menggunakan thumbnail saat ini.</small>
                                            </div>
                                        <?php else : ?>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Ganti Gambar (Opsional)</label>
                                                <input type="file" class="form-control" name="image_file" accept="image/*">
                                                <small class="text-muted">Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="modal-footer border-0 pt-0">
                                        <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary rounded-pill px-4"><i class="ri-save-line me-1"></i> Simpan Perubahan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="text-center py-5">
                <i class="ri-gallery-line text-pink display-1 opacity-50 mb-3 d-block"></i>
                <h6 class="fw-bold text-dark mb-1">Belum Ada Galeri Proyek</h6>
                <p class="text-muted small">Gunakan form di atas untuk menambahkan foto/video galeri proyek baru.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
let itemNextIndex = 1;

function extractYoutubeId(url) {
    if (!url) return null;
    url = url.trim();
    const match = url.match(/(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/i);
    return match ? match[1] : null;
}

function handleYoutubeInput(input) {
    const block = input.closest('.gallery-item-block');
    if (!block) return;
    const previewArea = block.querySelector('.yt-preview-area');
    const val = input.value.trim();

    if (!val) {
        previewArea.innerHTML = '';
        return;
    }

    const ytId = extractYoutubeId(val);

    if (ytId) {
        // Valid YouTube URL -> Show Live Preview Cover (Click to play)
        const thumbUrl = `https://img.youtube.com/vi/${ytId}/hqdefault.jpg`;
        previewArea.innerHTML = `
            <div class="p-3 rounded-4 bg-light border border-success border-opacity-25">
                <div class="d-flex align-items-center mb-2 text-success small fw-bold">
                    <i class="ri-checkbox-circle-fill me-1 fs-6"></i> Link YouTube Valid! Preview Thumbnail:
                </div>
                <div class="position-relative ratio ratio-16x9 rounded-3 overflow-hidden shadow-sm cursor-pointer" onclick="playPreviewYoutube(this, '${ytId}')">
                    <img src="${thumbUrl}" style="width:100%; height:100%; object-fit:cover;">
                    <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; background:rgba(0,0,0,0.35);">
                        <div style="width:50px; height:50px; background:#ff4081; border-radius:50%; display:flex; align-items:center; justify-content:center; color:white; box-shadow:0 4px 12px rgba(0,0,0,0.25);">
                            <i class="ri-play-fill fs-3 ms-1"></i>
                        </div>
                    </div>
                </div>
            </div>
        `;
    } else {
        // Invalid YouTube URL -> Show Red Alert Box
        previewArea.innerHTML = `
            <div class="alert alert-danger rounded-4 p-3 mb-0 border-0 shadow-sm">
                <div class="d-flex align-items-start">
                    <i class="ri-error-warning-fill me-2 fs-5 text-danger mt-1"></i>
                    <div>
                        <strong class="d-block mb-1 text-danger">⚠️ Link YouTube Tidak Valid!</strong>
                        <span class="small text-muted">Mohon periksa kembali format URL yang Anda masukkan.<br>
                        <strong>Contoh format valid:</strong><br>
                        • <code>https://www.youtube.com/watch?v=VIDEO_ID</code><br>
                        • <code>https://youtu.be/VIDEO_ID</code><br>
                        • <code>https://www.youtube.com/shorts/VIDEO_ID</code>
                        </span>
                    </div>
                </div>
            </div>
        `;
    }
}

function previewYtCustomThumb(input) {
    const block = input.closest('.gallery-item-block');
    if (!block) return;
    const previewArea = block.querySelector('.yt-preview-area');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const ytInput = block.querySelector('.yt-url-input');
            const ytId = extractYoutubeId(ytInput.value);
            
            if (ytId) {
                previewArea.innerHTML = `
                    <div class="p-3 rounded-4 bg-light border border-pink border-opacity-25">
                        <div class="d-flex align-items-center mb-2 text-pink small fw-bold">
                            <i class="ri-image-edit-fill me-1 fs-6"></i> Preview Thumbnail Custom:
                        </div>
                        <div class="position-relative ratio ratio-16x9 rounded-3 overflow-hidden shadow-sm">
                            <img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover;">
                            <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; background:rgba(0,0,0,0.35);">
                                <div style="width:48px; height:48px; background:#ff4081; border-radius:50%; display:flex; align-items:center; justify-content:center; color:white;">
                                    <i class="ri-play-fill fs-3 ms-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function playCardYoutube(container, embedUrl) {
    container.innerHTML = `<iframe src="${embedUrl}?autoplay=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width:100%; height:100%; border:none;"></iframe>`;
}

function playModalYoutube(container, embedUrl) {
    if (!container.dataset.originalHtml) {
        container.dataset.originalHtml = container.innerHTML;
    }
    container.innerHTML = `<iframe src="${embedUrl}?autoplay=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width:100%; height:100%; border:none;"></iframe>`;
}

function playPreviewYoutube(container, ytId) {
    container.innerHTML = `<iframe src="https://www.youtube.com/embed/${ytId}?autoplay=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width:100%; height:100%; border:none;"></iframe>`;
}

function switchItemMediaType(btn, type) {
    const block = btn.closest('.gallery-item-block');
    if (!block) return;

    block.querySelector('.item-media-type').value = type;
    const btnImg = block.querySelector('.btn-type-img');
    const btnYt = block.querySelector('.btn-type-yt');
    const imgBox = block.querySelector('.img-container-box');
    const ytBox = block.querySelector('.yt-container-box');

    if (type === 'image') {
        btnImg.className = 'btn btn-sm rounded-pill px-4 fw-bold me-1 btn-primary btn-type-img';
        btnYt.className = 'btn btn-sm rounded-pill px-4 fw-bold text-muted btn-light btn-type-yt';
        imgBox.style.display = 'block';
        ytBox.style.display = 'none';
    } else {
        btnYt.className = 'btn btn-sm rounded-pill px-4 fw-bold me-1 btn-primary btn-type-yt';
        btnImg.className = 'btn btn-sm rounded-pill px-4 fw-bold text-muted btn-light btn-type-img';
        imgBox.style.display = 'none';
        ytBox.style.display = 'block';
    }
}

function previewItemFiles(input) {
    const block = input.closest('.gallery-item-block');
    if (!block) return;
    const previewContainer = block.querySelector('.item-multi-preview');
    previewContainer.innerHTML = '';

    if (input.files && input.files.length > 0) {
        Array.from(input.files).forEach((file) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const col = document.createElement('div');
                col.className = 'col-3';
                col.innerHTML = `
                    <div class="position-relative rounded-3 overflow-hidden border p-1" style="height: 70px; background: #fff;">
                        <img src="${e.target.result}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 6px;">
                    </div>
                `;
                previewContainer.appendChild(col);
            }
            reader.readAsDataURL(file);
        });
    }
}

function addNewGalleryItem() {
    const container = document.getElementById('galleryItemsContainer');
    const firstBlock = container.querySelector('.gallery-item-block');
    if (!firstBlock) return;

    const newIndex = itemNextIndex++;
    const clone = firstBlock.cloneNode(true);
    clone.setAttribute('data-index', newIndex);

    // Update names and values
    clone.querySelector('.item-media-type').name = `items[${newIndex}][media_type]`;
    clone.querySelector('.item-media-type').value = 'image';

    const fileInput = clone.querySelector('.gallery-files-input');
    fileInput.name = `items[${newIndex}][gallery_files][]`;
    fileInput.value = '';

    const ytInput = clone.querySelector('.yt-url-input');
    if (ytInput) {
        ytInput.name = `items[${newIndex}][youtube_url]`;
        ytInput.value = '';
    }

    const customThumbInput = clone.querySelector('.yt-custom-thumb-input');
    if (customThumbInput) {
        customThumbInput.name = `items[${newIndex}][custom_thumbnail]`;
        customThumbInput.value = '';
    }

    const projSelect = clone.querySelector('select');
    projSelect.name = `items[${newIndex}][project_id]`;

    const titleInput = clone.querySelector('input[placeholder*="judul"]');
    if (titleInput) {
        titleInput.name = `items[${newIndex}][title]`;
        titleInput.value = '';
    }

    const sortInput = clone.querySelector('.sort-order-input');
    if (sortInput) {
        sortInput.name = `items[${newIndex}][sort_order]`;
        sortInput.value = '0';
    }

    const descInput = clone.querySelector('textarea');
    if (descInput) {
        descInput.name = `items[${newIndex}][description]`;
        descInput.value = '';
    }

    clone.querySelector('.item-multi-preview').innerHTML = '';
    clone.querySelector('.yt-preview-area').innerHTML = '';

    // Show media type image by default
    switchItemMediaType(clone.querySelector('.btn-type-img'), 'image');

    container.appendChild(clone);
    updateItemIndices();
}

function removeItemBlock(btn) {
    const block = btn.closest('.gallery-item-block');
    const container = document.getElementById('galleryItemsContainer');
    if (container.querySelectorAll('.gallery-item-block').length > 1) {
        block.remove();
        updateItemIndices();
    }
}

function updateItemIndices() {
    const blocks = document.querySelectorAll('.gallery-item-block');
    const counterBadge = document.getElementById('itemCounterBadge');
    if (counterBadge) {
        counterBadge.textContent = blocks.length + ' Item Form';
    }

    blocks.forEach((block, idx) => {
        const numSpan = block.querySelector('.item-num');
        if (numSpan) numSpan.textContent = idx + 1;

        const removeBtn = block.querySelector('.remove-item-btn');
        if (removeBtn) {
            removeBtn.style.display = (blocks.length > 1) ? 'inline-block' : 'none';
        }
    });
}

function resetForm() {
    const container = document.getElementById('galleryItemsContainer');
    const blocks = container.querySelectorAll('.gallery-item-block');
    for (let i = 1; i < blocks.length; i++) {
        blocks[i].remove();
    }

    const first = blocks[0];
    if (first) {
        first.querySelector('.gallery-files-input').value = '';
        first.querySelector('.item-multi-preview').innerHTML = '';
        first.querySelector('.yt-preview-area').innerHTML = '';
        first.querySelectorAll('input[type="text"], textarea').forEach(el => el.value = '');
        first.querySelector('select').selectedIndex = 0;
    }
    updateItemIndices();

    const card = document.getElementById('addGalleryCard');
    if (card) {
        card.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    const toggleBtn = document.getElementById('toggleAddFormBtn');
    const card = document.getElementById('addGalleryCard');
    
    if (toggleBtn && card) {
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            if (card.style.display === 'none') {
                card.style.display = 'block';
            }
            card.scrollIntoView({ behavior: 'smooth', block: 'start' });
            const select = card.querySelector('select');
            if (select) {
                setTimeout(() => select.focus(), 300);
            }
        });
    }
    // Stop YouTube video playing on modal close in admin page
    document.addEventListener('hidden.bs.modal', function (event) {
        const modal = event.target;
        modal.querySelectorAll('iframe').forEach(iframe => {
            iframe.src = '';
        });
        modal.querySelectorAll('[data-original-html]').forEach(container => {
            container.innerHTML = container.dataset.originalHtml;
            delete container.dataset.originalHtml;
        });
    });

    updateItemIndices();
});
</script>
<?= $this->endSection() ?>
