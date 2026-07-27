<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Kelola Prestasi</h4>
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
                                    <span class="badge bg-primary ms-1"><?= esc($item['badge_text']) ?></span>
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

                        <div class="alert alert-light border">
                            <h6 class="alert-heading fw-bold">Pengaturan Khusus Highlight (Isi jika Highlight Utama)</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Foto / Gambar Highlight</label>
                                    <input type="file" class="form-control mb-2" name="photo" accept="image/*">
                                    <?php if($item['photo']): ?>
                                        <small class="text-muted d-block">Sudah ada foto: <?= esc($item['photo']) ?></small>
                                    <?php endif; ?>
                                </div>
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
                                    <label class="form-label">Teks Heading (contoh: Over 1M Views)</label>
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

                    <div class="alert alert-light border">
                        <h6 class="alert-heading fw-bold">Pengaturan Khusus Highlight (Isi jika Highlight Utama)</h6>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Foto / Gambar Highlight</label>
                                <input type="file" class="form-control" name="photo" accept="image/*">
                            </div>
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
                                <label class="form-label">Teks Heading (contoh: Over 1M Views)</label>
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
