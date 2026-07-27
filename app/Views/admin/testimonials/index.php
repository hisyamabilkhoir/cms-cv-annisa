<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <div>
        <h2 class="mb-1">Kelola Testimonial</h2>
        <p class="text-muted mb-0">Kelola ulasan klien, nama brand, rating bintang, & kutipan opini.</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-plus-circle me-2"></i>Tambah Testimonial
    </button>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table custom-datatable">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nama Brand / Client</th>
                        <th>Rating</th>
                        <th>Testimoni</th>
                        <th>Status</th>
                        <th>Urutan</th>
                        <th class="no-sort text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($testimonials as $item): ?>
                        <tr>
                            <td>
                                <?php 
                                $logoSrc = '';
                                if (!empty($item['logo'])) {
                                    if (file_exists(FCPATH . 'assets/uploads/testimonials/' . $item['logo'])) {
                                        $logoSrc = base_url('assets/uploads/testimonials/' . $item['logo']);
                                    } elseif (file_exists(FCPATH . 'assets/assets/' . $item['logo'])) {
                                        $logoSrc = base_url('assets/assets/' . $item['logo']);
                                    } elseif (file_exists(FCPATH . 'assets/images/' . $item['logo'])) {
                                        $logoSrc = base_url('assets/images/' . $item['logo']);
                                    } elseif (file_exists(FCPATH . 'assets/' . $item['logo'])) {
                                        $logoSrc = base_url('assets/' . $item['logo']);
                                    }
                                }
                                ?>
                                <?php if($logoSrc): ?>
                                    <img src="<?= $logoSrc ?>" alt="<?= esc($item['brand_name']) ?>" class="rounded-circle bg-light p-1 border shadow-sm" style="width: 44px; height: 44px; object-fit: cover;">
                                <?php else: ?>
                                    <span class="badge bg-light text-muted border rounded-pill">Tidak ada</span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-medium"><?= esc($item['brand_name']) ?></td>
                            <td>
                                <div class="text-warning">
                                    <?php for($i=1; $i<=5; $i++): ?>
                                        <i class="bi bi-star<?= $i <= $item['rating'] ? '-fill' : '' ?>"></i>
                                    <?php endfor; ?>
                                </div>
                            </td>
                            <td>
                                <span class="d-inline-block text-truncate" style="max-width: 250px;" title="<?= esc($item['text']) ?>">
                                    <?= esc($item['text']) ?>
                                </span>
                            </td>
                            <td>
                                <?php if($item['is_active']): ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $item['sort_order'] ?></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="<?= base_url('admin/testimonials/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit Modals (outside table) -->
<?php foreach ($testimonials as $item): ?>
    <div class="modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('admin/testimonials/update/' . $item['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Testimonial</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Brand / Client *</label>
                                <input type="text" class="form-control" name="brand_name" value="<?= esc($item['brand_name']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Rating (1-5) *</label>
                                <input type="number" class="form-control" name="rating" min="1" max="5" value="<?= $item['rating'] ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Logo / Avatar</label>
                            <input type="file" class="form-control mb-2 image-preview-input" name="logo" accept="image/*" data-preview="edit-testi-preview-<?= $item['id'] ?>">
                            <div class="p-2 rounded-3 border bg-light text-center">
                                <?php 
                                $editLogoSrc = '';
                                if (!empty($item['photo'] ?? $item['logo'])) {
                                    $fileLogo = $item['logo'] ?? $item['photo'];
                                    if (file_exists(FCPATH . 'assets/uploads/testimonials/' . $fileLogo)) {
                                        $editLogoSrc = base_url('assets/uploads/testimonials/' . $fileLogo);
                                    } elseif (file_exists(FCPATH . 'assets/assets/' . $fileLogo)) {
                                        $editLogoSrc = base_url('assets/assets/' . $fileLogo);
                                    } elseif (file_exists(FCPATH . 'assets/images/' . $fileLogo)) {
                                        $editLogoSrc = base_url('assets/images/' . $fileLogo);
                                    } elseif (file_exists(FCPATH . 'assets/' . $fileLogo)) {
                                        $editLogoSrc = base_url('assets/' . $fileLogo);
                                    }
                                }
                                ?>
                                <?php if($editLogoSrc): ?>
                                    <img id="edit-testi-preview-<?= $item['id'] ?>" src="<?= $editLogoSrc ?>" class="rounded-circle shadow-sm border p-1 bg-white" style="width: 70px; height: 70px; object-fit: cover;">
                                    <small class="text-muted d-block mt-1"><i class="ri-image-line me-1 text-pink"></i> File saat ini: <?= esc($item['logo']) ?></small>
                                <?php else: ?>
                                    <img id="edit-testi-preview-<?= $item['id'] ?>" src="" class="rounded-circle shadow-sm border p-1 bg-white" style="display:none; width: 70px; height: 70px; object-fit: cover;">
                                    <small class="text-muted d-block" id="edit-testi-placeholder-<?= $item['id'] ?>"><i class="ri-image-add-line fs-4 d-block text-pink"></i> Belum ada logo di-upload</small>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Teks Testimonial *</label>
                            <textarea class="form-control" name="text" rows="4" required><?= esc($item['text']) ?></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Urutan Tampil</label>
                                <input type="number" class="form-control" name="sort_order" value="<?= $item['sort_order'] ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status</label>
                                <select class="form-select" name="is_active">
                                    <option value="1" <?= $item['is_active'] ? 'selected' : '' ?>>Aktif</option>
                                    <option value="0" <?= !$item['is_active'] ? 'selected' : '' ?>>Nonaktif</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('admin/testimonials/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Testimonial Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Brand / Client *</label>
                            <input type="text" class="form-control" name="brand_name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Rating (1-5) *</label>
                            <input type="number" class="form-control" name="rating" min="1" max="5" value="5" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Logo / Avatar</label>
                        <input type="file" class="form-control mb-2 image-preview-input" name="logo" accept="image/*" data-preview="add-testi-preview">
                        <div class="p-2 rounded-3 border bg-light text-center">
                            <img id="add-testi-preview" src="" class="rounded-circle shadow-sm border p-1 bg-white" style="display:none; width: 70px; height: 70px; object-fit: cover;">
                            <small class="text-muted d-block" id="add-testi-placeholder"><i class="ri-image-add-line fs-4 d-block text-pink"></i> Preview logo akan tampil di sini</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Teks Testimonial *</label>
                        <textarea class="form-control" name="text" rows="4" required></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Urutan Tampil</label>
                            <input type="number" class="form-control" name="sort_order" value="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="is_active">
                                <option value="1">Aktif</option>
                                <option value="0">Nonaktif</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.image-preview-input').forEach(input => {
        input.addEventListener('change', function() {
            const previewId = this.dataset.preview;
            if (previewId) {
                const previewImg = document.getElementById(previewId);
                if (previewImg && this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewImg.style.display = 'inline-block';
                        
                        // Hide any placeholder text, icons, or current file notes in the container
                        const container = previewImg.closest('.p-2, .preview-img-container');
                        if (container) {
                            container.querySelectorAll('small, span, div.text-pink, #edit-photo-fallback-' + previewId.replace(/[^0-9]/g, '')).forEach(el => {
                                if (el !== previewImg) {
                                    el.style.display = 'none';
                                }
                            });
                        }
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            }
        });
    });
});
</script>
<?= $this->endSection() ?>
