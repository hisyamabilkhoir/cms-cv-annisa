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

                    <!-- Galeri Tambahan Upload Section -->
                    <div class="p-3 rounded-4 mb-4" style="background: rgba(255, 240, 246, 0.35); border: 1px solid rgba(255, 105, 180, 0.2);">
                        <label class="form-label fw-bold text-pink mb-1"><i class="ri-gallery-upload-line me-1"></i> Upload Galeri Foto Tambahan</label>
                        <input type="file" class="form-control mb-2" name="gallery_files[]" multiple accept="image/*">
                        <small class="text-muted d-block"><i class="ri-information-line me-1"></i> Anda dapat memilih beberapa foto sekaligus untuk dijadikan galeri di modal project.</small>
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
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold"><i class="ri-image-2-line me-1 text-pink"></i> Galeri Foto Tersimpan</h6>
                    <span class="badge bg-pink-subtle text-pink"><?= count($galleries) ?> Foto</span>
                </div>
                <div class="card-body">
                    <div class="row g-2">
                        <?php foreach($galleries as $g): ?>
                            <div class="col-6 position-relative">
                                <div class="border rounded-3 overflow-hidden text-center p-1" style="background: rgba(0,0,0,0.02);">
                                    <img src="<?= base_url('assets/uploads/projects/' . $g['file_path']) ?>" class="img-fluid rounded" style="height: 90px; object-fit: cover; width: 100%;">
                                    <form action="<?= base_url('admin/projects/gallery/delete/' . $g['id']) ?>" method="post" class="delete-form mt-1">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100 py-0" style="font-size: 11px;" title="Hapus foto ini">
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
