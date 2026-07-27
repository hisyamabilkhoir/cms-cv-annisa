<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <div>
        <h2 class="mb-1">Kategori Project</h2>
        <p class="text-muted mb-0">Kelola kategori filter untuk mengelompokkan project portfolio.</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-plus-circle me-2"></i>Tambah Kategori
    </button>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table custom-datatable">
                <thead>
                    <tr>
                        <th>Nama Kategori</th>
                        <th>Slug</th>
                        <th>Urutan</th>
                        <th class="no-sort text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $item): ?>
                        <tr>
                            <td class="fw-medium"><?= $item['name'] ?></td>
                            <td><?= $item['slug'] ?></td>
                            <td><?= $item['sort_order'] ?></td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#editModal<?= $item['id'] ?>">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="<?= base_url('admin/project-categories/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editModal<?= $item['id'] ?>" tabindex="-1">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="<?= base_url('admin/project-categories/update/' . $item['id']) ?>" method="post">
                                        <?= csrf_field() ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Kategori</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label">Nama Kategori *</label>
                                                <input type="text" class="form-control" name="name" value="<?= $item['name'] ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Urutan (Angka)</label>
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
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/project-categories/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori *</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan (Angka)</label>
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
