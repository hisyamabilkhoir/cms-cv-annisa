<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <div>
        <h2 class="mb-1">Kelola Achievements & Milestones</h2>
        <p class="text-muted mb-0">Kelola daftar pencapaian, momen penting karir, & sertifikat prestasi.</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-plus-circle me-2"></i>Tambah Prestasi
    </button>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table custom-datatable">
                <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Kategori</th>
                        <th>Judul Prestasi</th>
                        <th>Highlight Utama?</th>
                        <th>Urutan</th>
                        <th class="no-sort text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($achievements as $item): ?>
                        <tr>
                            <td>
                                <span class="badge bg-light text-dark border"><?= esc($item['year']) ?></span>
                                <div class="small text-muted mt-1"><?= esc($item['date_label']) ?></div>
                            </td>
                            <td><?= esc($item['category_name']) ?></td>
                            <td class="fw-medium">
                                <?= esc($item['title']) ?>
                                <?php if($item['badge_text']): ?>
                                    <span class="badge bg-pink-soft text-pink fw-bold ms-1" style="background: rgba(255, 105, 180, 0.15) !important; color: #ec407a !important; border: 1px solid rgba(255, 105, 180, 0.3); font-size: 11px; padding: 5px 10px; border-radius: 8px;"><?= esc($item['badge_text']) ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($item['is_main']): ?>
                                    <span class="badge bg-warning text-dark"><i class="bi bi-star-fill me-1"></i>Ya</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary">Tidak</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $item['sort_order'] ?></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="<?= base_url('admin/achievements/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
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
<?php foreach ($achievements as $item): ?>
    <div class="modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="<?= base_url('admin/achievements/update/' . $item['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Prestasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori *</label>
                                <select class="form-select" name="category_id" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php foreach($categories as $cat): ?>
                                        <option value="<?= $cat['id'] ?>" <?= $item['category_id'] == $cat['id'] ? 'selected' : '' ?>><?= esc($cat['name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jadikan Highlight Utama?</label>
                                <select class="form-select" name="is_main">
                                    <option value="0" <?= !$item['is_main'] ? 'selected' : '' ?>>Tidak</option>
                                    <option value="1" <?= $item['is_main'] ? 'selected' : '' ?>>Ya</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tahun (contoh: 2024) *</label>
                                <input type="text" class="form-control" name="year" value="<?= esc($item['year']) ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Label Tanggal (contoh: Jan - Dec) *</label>
                                <input type="text" class="form-control" name="date_label" value="<?= esc($item['date_label']) ?>" required>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Judul Prestasi / Posisi *</label>
                            <input type="text" class="form-control" name="title" value="<?= esc($item['title']) ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Deskripsi *</label>
                            <textarea class="form-control" name="description" rows="3" required><?= esc($item['description']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Foto / Gambar Prestasi</label>
                            <input type="file" class="form-control mb-2 image-preview-input" name="photo" accept="image/*" data-preview="edit-photo-preview-<?= $item['id'] ?>">
                            <div class="p-2 rounded-3 border bg-light text-center position-relative">
                                <?php 
                                $photoSrc = '';
                                if (!empty($item['photo'])) {
                                    if (file_exists(FCPATH . 'assets/uploads/achievements/' . $item['photo'])) {
                                        $photoSrc = base_url('assets/uploads/achievements/' . $item['photo']);
                                    } elseif (file_exists(FCPATH . 'assets/images/' . $item['photo'])) {
                                        $photoSrc = base_url('assets/images/' . $item['photo']);
                                    } else {
                                        $photoSrc = base_url('assets/uploads/achievements/' . $item['photo']);
                                    }
                                }
                                ?>
                                <?php if (!empty($item['photo'])): ?>
                                    <img id="edit-photo-preview-<?= $item['id'] ?>" src="<?= $photoSrc ?>" class="img-fluid rounded shadow-sm" style="max-height: 140px; object-fit: contain;" onerror="this.style.display='none'; document.getElementById('edit-photo-fallback-<?= $item['id'] ?>').style.display='block';">
                                    <div id="edit-photo-fallback-<?= $item['id'] ?>" class="text-pink p-3 small" style="display:none;">
                                        <i class="ri-image-warning-line fs-2 d-block mb-1"></i>
                                        <span>File <code><?= esc($item['photo']) ?></code> tidak ditemukan di server. Silakan upload ulang foto.</span>
                                    </div>
                                    <small class="text-muted d-block mt-1"><i class="ri-image-line me-1 text-pink"></i> Nama file: <?= esc($item['photo']) ?></small>
                                <?php else: ?>
                                    <img id="edit-photo-preview-<?= $item['id'] ?>" src="" class="img-fluid rounded shadow-sm" style="display:none; max-height: 140px; object-fit: contain;">
                                    <small class="text-muted d-block" id="edit-photo-placeholder-<?= $item['id'] ?>"><i class="ri-image-add-line fs-3 d-block text-pink"></i> Belum ada foto di-upload</small>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="alert alert-light border">
                            <h6 class="alert-heading fw-bold">Pengaturan Khusus Highlight (Isi jika Highlight Utama)</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Teks Badge (contoh: 30K Followers)</label>
                                    <input type="text" class="form-control" name="badge_text" value="<?= esc($item['badge_text']) ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Icon Label (Class Remix Icon)</label>
                                    <input type="text" class="form-control" name="icon" value="<?= esc($item['icon']) ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Teks Kecil (contoh: Growth in 3 Months)</label>
                                    <input type="text" class="form-control" name="small_text" value="<?= esc($item['small_text']) ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Teks Heading Overlay (contoh: Over 1M Views)</label>
                                    <input type="text" class="form-control" name="heading_text" value="<?= esc($item['heading_text']) ?>">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tanda Tangan / Signature</label>
                                    <input type="text" class="form-control" name="signature_text" value="<?= esc($item['signature_text']) ?>">
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Urutan Tampil (Opsional)</label>
                            <input type="number" class="form-control" name="sort_order" value="<?= $item['sort_order'] ?>">
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
            <form action="<?= base_url('admin/achievements/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Prestasi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Kategori *</label>
                            <select class="form-select" name="category_id" required>
                                <option value="">Pilih Kategori</option>
                                <?php foreach($categories as $cat): ?>
                                    <option value="<?= $cat['id'] ?>"><?= esc($cat['name']) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jadikan Highlight Utama?</label>
                            <select class="form-select" name="is_main">
                                <option value="0">Tidak</option>
                                <option value="1">Ya</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tahun (contoh: 2024) *</label>
                            <input type="text" class="form-control" name="year" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Label Tanggal (contoh: Jan - Dec) *</label>
                            <input type="text" class="form-control" name="date_label" required>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Judul Prestasi / Posisi *</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Deskripsi *</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Foto / Gambar Prestasi</label>
                        <input type="file" class="form-control mb-2 image-preview-input" name="photo" accept="image/*" data-preview="add-photo-preview">
                        <div class="p-2 rounded-3 border bg-light text-center">
                            <img id="add-photo-preview" src="" class="img-fluid rounded shadow-sm" style="display:none; max-height: 140px; object-fit: contain;">
                            <small class="text-muted d-block" id="add-photo-placeholder"><i class="ri-image-add-line fs-3 d-block text-pink"></i> Preview gambar akan tampil di sini</small>
                        </div>
                    </div>

                    <div class="alert alert-light border">
                        <h6 class="alert-heading fw-bold">Pengaturan Khusus Highlight (Isi jika Highlight Utama)</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Teks Badge (contoh: 30K Followers)</label>
                                <input type="text" class="form-control" name="badge_text">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Icon Label (Class Remix Icon)</label>
                                <input type="text" class="form-control" name="icon">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Teks Kecil (contoh: Growth in 3 Months)</label>
                                <input type="text" class="form-control" name="small_text">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Teks Heading Overlay (contoh: Over 1M Views)</label>
                                <input type="text" class="form-control" name="heading_text">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanda Tangan / Signature</label>
                                <input type="text" class="form-control" name="signature_text">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Urutan Tampil (Opsional)</label>
                        <input type="number" class="form-control" name="sort_order" value="0">
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
                        
                        const container = previewImg.closest('.p-2, .preview-img-container');
                        if (container) {
                            container.querySelectorAll('small, span, div.text-pink').forEach(el => {
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
