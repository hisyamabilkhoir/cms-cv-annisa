<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Kelola Testimonial</h4>
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
                                <?php if($item['logo']): ?>
                                    <img src="<?= base_url('assets/uploads/testimonials/' . $item['logo']) ?>" alt="<?= esc($item['brand_name']) ?>" style="max-height: 40px; border-radius: 5px;">
                                <?php else: ?>
                                    <span class="text-muted">Tidak ada</span>
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
                            <input type="file" class="form-control mb-2" name="logo" accept="image/*">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah logo.</small>
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
                        <input type="file" class="form-control" name="logo" accept="image/*">
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
