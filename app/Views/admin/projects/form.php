<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold"><?= isset($project) ? 'Edit Project' : 'Tambah Project Baru' ?></h4>
    <a href="<?= base_url('admin/projects') ?>" class="btn btn-outline-secondary rounded-pill px-4">
        <i class="ri-arrow-left-line me-2"></i>Kembali
    </a>
</div>

<div class="row g-4">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title mb-0"><i class="ri-folder-add-line me-2 text-pink"></i> Informasi Utama Project</h5>
            </div>
            <div class="card-body">
                <form action="<?= $action ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Judul Project *</label>
                        <input type="text" class="form-control" name="title" value="<?= esc($project['title'] ?? '') ?>" required placeholder="Contoh: Al Fatih Umrah Website">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Kategori *</label>
                            <select class="form-select" name="category_id" required>
                                <option value="">Pilih Kategori</option>
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>" <?= (isset($project) && $project['category_id'] == $cat['id']) ? 'selected' : '' ?>><?= esc($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Role / Tag (misal: Editor + Scripter)</label>
                            <input type="text" class="form-control" name="tag" value="<?= esc($project['tag'] ?? '') ?>" placeholder="Contoh: Video Editor">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi Singkat *</label>
                        <textarea class="form-control" name="description" rows="4" required placeholder="Tuliskan gambaran singkat project ini..."><?= esc($project['description'] ?? '') ?></textarea>
                    </div>

                    <!-- Bullet Points Manager -->
                    <div class="p-3 rounded-4 mb-3" style="background: rgba(255, 240, 246, 0.35); border: 1px solid rgba(255, 105, 180, 0.2);">
                        <label class="form-label fw-bold text-pink mb-1"><i class="ri-list-check-2 me-1"></i> Bullet Points Detail Project</label>
                        <textarea class="form-control" name="bullets_raw" rows="4" placeholder="Tulis 1 poin per baris. Contoh:&#10;Batch production + templates&#10;A/B testing visual hooks&#10;Peningkatan CTR hingga 12%"><?= esc($bulletsRaw ?? '') ?></textarea>
                        <small class="text-muted d-block mt-2"><i class="ri-information-line me-1"></i> Tulis 1 poin per baris. Poin-poin ini akan otomatis menjadi checklist detail di modal website.</small>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Tipe Media Thumbnail *</label>
                            <select class="form-select" name="thumbnail_type" required>
                                <option value="image" <?= (isset($project) && $project['thumbnail_type'] == 'image') ? 'selected' : '' ?>>Gambar Saja</option>
                                <option value="video" <?= (isset($project) && $project['thumbnail_type'] == 'video') ? 'selected' : '' ?>>Video Youtube Saja</option>
                                <option value="both" <?= (isset($project) && $project['thumbnail_type'] == 'both') ? 'selected' : '' ?>>Keduanya (Gambar + Video)</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Link Youtube (Standard / Shorts / Embed)</label>
                            <input type="text" class="form-control" name="youtube_url" value="<?= esc($project['youtube_url'] ?? '') ?>" placeholder="https://www.youtube.com/watch?v=xxx atau https://youtu.be/xxx">
                            <small class="text-muted d-block mt-1"><i class="ri-information-line me-1"></i> Bebas masukkan link Youtube standar atau Shorts. Sistem akan otomatis mengonversi formatnya.</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Views (Opsional)</label>
                            <input type="text" class="form-control" name="views" value="<?= esc($project['views'] ?? '') ?>" placeholder="misal: 1.2M">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">CTR (Opsional)</label>
                            <input type="text" class="form-control" name="ctr" value="<?= esc($project['ctr'] ?? '') ?>" placeholder="misal: 5%">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-bold">Urutan Tampil</label>
                            <input type="number" class="form-control" name="sort_order" value="<?= esc($project['sort_order'] ?? 0) ?>">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Link Project Eksternal (Opsional)</label>
                        <input type="url" class="form-control" name="project_link" value="<?= esc($project['project_link'] ?? '') ?>" placeholder="https://instagram.com/...">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Status Publikasi</label>
                        <select class="form-select w-50" name="is_active">
                            <option value="1" <?= (isset($project) && $project['is_active'] == 1) ? 'selected' : '' ?>>Aktif (Tampilkan)</option>
                            <option value="0" <?= (isset($project) && $project['is_active'] == 0) ? 'selected' : '' ?>>Draft / Sembunyikan</option>
                        </select>
                    </div>

                    <!-- Kelola Galeri Proyek Link Section -->
                    <div class="p-3 rounded-4 mb-4 d-flex align-items-center justify-content-between flex-wrap gap-3" style="background: rgba(255, 240, 246, 0.5); border: 1px solid rgba(255, 105, 180, 0.25);">
                        <div>
                            <h6 class="fw-bold text-pink mb-1"><i class="ri-gallery-line me-2"></i> Kelola Galeri Proyek Dedicated</h6>
                            <p class="mb-0 text-muted small"><i class="ri-information-line me-1"></i> Untuk mengunggah dan mengelola foto / video galeri secara khusus, silakan buka Halaman Galeri Proyek.</p>
                        </div>
                        <a href="<?= base_url('admin/project-galleries') ?>" class="btn btn-outline-pink rounded-pill px-4 py-2 flex-shrink-0">
                            <i class="ri-external-link-line me-1"></i> Ke Galeri Proyek
                        </a>
                    </div>

                    <hr>
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-4 py-2"><i class="ri-save-line me-2"></i> Simpan Project</button>
                    </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Thumbnail Cover -->
        <div class="card mb-4">
            <div class="card-header">
                <h6 class="mb-0 fw-bold"><i class="ri-image-line me-1 text-pink"></i> Thumbnail Cover</h6>
            </div>
            <div class="card-body text-center">
                <input type="file" class="form-control image-preview-input mb-3" name="thumbnail" data-preview="thumb-preview" accept="image/*" <?= isset($project) ? '' : 'required' ?>>
                
                <div class="text-center rounded-3 overflow-hidden p-2" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(255,105,180,0.15); min-height: 160px; display: flex; align-items: center; justify-content: center;">
                    <?php if(isset($project) && $project['thumbnail']): ?>
                        <img id="thumb-preview" src="<?= base_url('assets/uploads/projects/' . $project['thumbnail']) ?>" class="img-fluid rounded" style="max-height: 200px; object-fit: contain;">
                    <?php else: ?>
                        <img id="thumb-preview" src="" class="img-fluid rounded" style="display:none; max-height: 200px; object-fit: contain;">
                        <span class="text-muted small" id="thumb-placeholder"><i class="ri-image-add-line fs-2 d-block mb-1 text-pink"></i>Preview Gambar Thumbnail</span>
                    <?php endif; ?>
                </div>
                <small class="text-muted d-block mt-2">Format disarankan: JPG/PNG, rasio 16:9 atau 4:3.</small>
            </div>
        </div>

        <!-- Existing Gallery Items (If Editing) -->
        <?php if(isset($project) && !empty($galleries)): ?>
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center py-3 px-3">
                    <div class="d-flex align-items-center gap-2">
                        <h6 class="mb-0 fw-bold"><i class="ri-image-2-line me-1 text-pink"></i> Galeri Tersimpan</h6>
                        <span class="badge rounded-pill px-2 py-1 text-white shadow-sm" style="background: linear-gradient(90deg, #ff69b4, #ec407a); font-size: 11px; font-weight: 700;"><?= count($galleries) ?> Item</span>
                    </div>
                    <a href="<?= base_url('admin/project-galleries?project_id=' . $project['id']) ?>" class="btn btn-sm btn-outline-pink rounded-pill px-3 py-1 text-nowrap fw-bold" style="font-size: 12px;">
                        <i class="ri-settings-4-line me-1"></i> Kelola Galeri
                    </a>
                </div>
                <div class="card-body p-3">
                    <div class="row g-2">
                        <?php foreach($galleries as $g): ?>
                            <div class="col-6 position-relative">
                                <div class="border rounded-3 overflow-hidden text-center p-1" style="background: rgba(0,0,0,0.02);">
                                    <?php if (($g['media_type'] ?? 'image') === 'youtube') : ?>
                                        <?php 
                                            preg_match('/(?:embed\/|watch\?v=|shorts\/|youtu\.be\/)([a-zA-Z0-9_-]+)/i', $g['youtube_url'] ?? '', $ytMatch);
                                            $ytId = $ytMatch[1] ?? '';
                                            $thumbSrc = !empty($g['custom_thumbnail']) 
                                                ? base_url('assets/uploads/projects/' . $g['custom_thumbnail']) 
                                                : ($ytId ? "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg" : base_url('assets/uploads/projects/' . ($g['file_path'] ?? '')));
                                            $ytUrl = $g['youtube_url'] ?? '';
                                        ?>
                                        <div class="position-relative rounded overflow-hidden cursor-pointer" style="height: 90px;" onclick="playCardYoutube(this, '<?= esc($ytUrl) ?>')">
                                            <img src="<?= $thumbSrc ?>" class="img-fluid rounded w-100 h-100 object-fit-cover">
                                            <div class="position-absolute top-0 start-0 m-1 z-2">
                                                <span class="badge bg-danger p-1 shadow-sm" style="font-size: 9px;"><i class="ri-youtube-fill"></i></span>
                                            </div>
                                            <div class="position-absolute inset-0 d-flex align-items-center justify-content-center" style="background: rgba(0,0,0,0.35); top:0; left:0; right:0; bottom:0;">
                                                <div class="rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 34px; height: 34px; background: #ff4081; color: white;">
                                                    <i class="ri-play-fill fs-5 ms-1"></i>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else : ?>
                                        <div class="position-relative rounded overflow-hidden" style="height: 90px;">
                                            <img src="<?= base_url('assets/uploads/projects/' . $g['file_path']) ?>" class="img-fluid rounded w-100 h-100 object-fit-cover">
                                        </div>
                                    <?php endif; ?>
                                    <form action="<?= base_url('admin/projects/gallery/delete/' . $g['id']) ?>" method="post" class="delete-form mt-1">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100 py-0" style="font-size: 11px;" title="Hapus item ini">
                                            <i class="ri-delete-bin-line me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    </form>
</div>

<script>
function playCardYoutube(container, embedUrl) {
    if (!embedUrl) return;
    container.innerHTML = `<iframe src="${embedUrl}?autoplay=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width:100%; height:100%; border:none;"></iframe>`;
}

document.addEventListener('DOMContentLoaded', function() {
    const thumbInput = document.querySelector('input[name="thumbnail"]');
    const placeholder = document.getElementById('thumb-placeholder');
    const preview = document.getElementById('thumb-preview');
    
    if (thumbInput && placeholder && preview) {
        thumbInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                placeholder.style.display = 'none';
            } else if (!preview.getAttribute('src')) {
                placeholder.style.display = 'block';
            }
        });
    }
});
</script>
<?= $this->endSection() ?>
