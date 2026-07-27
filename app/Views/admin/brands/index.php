<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0 fw-bold text-dark">Kelola Brands & Partners</h1>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="ri-add-circle-line me-2"></i>Tambah Brand
    </button>
</div>

<!-- Card Pengaturan Background Section Brands -->
<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="ri-image-line me-2 text-pink"></i> Background Section Brands & Partners</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/brands/settings/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row g-4">
                <!-- Background Desktop -->
                <div class="col-md-6">
                    <div class="p-3 rounded-4" style="background: rgba(255, 240, 246, 0.35); border: 1px solid rgba(255, 105, 180, 0.2);">
                        <label class="form-label fw-bold">Background Desktop</label>
                        <input type="file" class="form-control image-preview-input mb-2" name="bg_desktop" data-preview="brand-bg-desktop-preview" accept="image/*">
                        <small class="text-muted d-block mb-2">Biarkan kosong jika tidak ingin mengubah.</small>

                        <div class="preview-img-container text-center rounded-3 overflow-hidden p-1" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(255,105,180,0.15);">
                            <?php if(!empty($brandSettings['bg_desktop'])): ?>
                                <img id="brand-bg-desktop-preview" src="<?= base_url('assets/uploads/brands/' . $brandSettings['bg_desktop']) ?>" style="width: 100%; max-height: 180px; object-fit: contain; border-radius: 12px;">
                            <?php else: ?>
                                <img id="brand-bg-desktop-preview" src="" style="width: 100%; max-height: 180px; object-fit: contain; border-radius: 12px; display: none;">
                                <span class="text-muted small py-3 d-block" id="brand-bg-desktop-preview-placeholder">Preview background desktop.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Background Mobile -->
                <div class="col-md-6">
                    <div class="p-3 rounded-4" style="background: rgba(255, 240, 246, 0.35); border: 1px solid rgba(255, 105, 180, 0.2);">
                        <label class="form-label fw-bold">Background Mobile</label>
                        <input type="file" class="form-control image-preview-input mb-2" name="bg_mobile" data-preview="brand-bg-mobile-preview" accept="image/*">
                        <small class="text-muted d-block mb-2">Biarkan kosong jika tidak ingin mengubah.</small>

                        <div class="preview-img-container text-center rounded-3 overflow-hidden p-1" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(255,105,180,0.15);">
                            <?php if(!empty($brandSettings['bg_mobile'])): ?>
                                <img id="brand-bg-mobile-preview" src="<?= base_url('assets/uploads/brands/' . $brandSettings['bg_mobile']) ?>" style="width: 100%; max-height: 180px; object-fit: contain; border-radius: 12px;">
                            <?php else: ?>
                                <img id="brand-bg-mobile-preview" src="" style="width: 100%; max-height: 180px; object-fit: contain; border-radius: 12px; display: none;">
                                <span class="text-muted small py-3 d-block" id="brand-bg-mobile-preview-placeholder">Preview background mobile.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary"><i class="ri-save-line me-2"></i> Simpan Background Brands</button>
            </div>
        </form>
    </div>
</div>

<!-- Card Daftar Brand -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="ri-building-4-line me-2 text-pink"></i> Daftar Brand & Partner</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table custom-datatable align-middle">
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Nama Brand</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Urutan</th>
                        <th class="no-sort text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($brands as $item): ?>
                        <tr>
                            <td>
                                <?php if($item['logo']): ?>
                                    <img src="<?= base_url('assets/uploads/brands/' . $item['logo']) ?>" alt="<?= esc($item['name']) ?>" style="max-height: 40px; border-radius: 6px;">
                                <?php else: ?>
                                    <span class="text-muted">Tidak ada logo</span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold"><?= esc($item['name']) ?></td>
                            <td><?= esc($item['location']) ?></td>
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
                                    <i class="ri-pencil-line"></i>
                                </button>
                                <form action="<?= base_url('admin/brands/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="ri-delete-bin-line"></i>
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
<?php foreach ($brands as $item): ?>
    <div class="modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('admin/brands/update/' . $item['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Brand</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Nama Brand *</label>
                                <input type="text" class="form-control" name="name" value="<?= esc($item['name']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Lokasi *</label>
                                <input type="text" class="form-control" name="location" value="<?= esc($item['location']) ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Logo Brand</label>
                            <input type="file" class="form-control mb-2" name="logo" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah logo.</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Deskripsi / Detail Pekerjaan *</label>
                            <textarea class="form-control" name="description" rows="3" required><?= esc($item['description']) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold">Link Portfolio Terkait (Opsional)</label>
                            <input type="url" class="form-control" name="project_link" value="<?= esc($item['project_link']) ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Urutan (Angka)</label>
                                <input type="number" class="form-control" name="sort_order" value="<?= esc($item['sort_order']) ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Status</label>
                                <select class="form-select" name="is_active">
                                    <option value="1" <?= $item['is_active'] ? 'selected' : '' ?>>Aktif</option>
                                    <option value="0" <?= !$item['is_active'] ? 'selected' : '' ?>>Nonaktif</option>
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
<?php endforeach; ?>

<!-- Modal Tambah Brand -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?= base_url('admin/brands/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Brand Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Brand *</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Lokasi *</label>
                            <input type="text" class="form-control" name="location" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Logo Brand *</label>
                        <input type="file" class="form-control mb-2" name="logo" accept="image/*" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi / Detail Pekerjaan *</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Link Portfolio Terkait (Opsional)</label>
                        <input type="url" class="form-control" name="project_link">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Urutan (Angka)</label>
                            <input type="number" class="form-control" name="sort_order" value="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Status</label>
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
});
</script>
<?= $this->endSection() ?>
