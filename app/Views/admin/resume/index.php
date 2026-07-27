<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <h4 class="mb-0 fw-bold">Kelola Resume & Skills</h4>
</div>

<ul class="nav nav-pills mb-4 custom-tabs" id="resumeTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="exp-tab" data-bs-toggle="tab" data-bs-target="#exp" type="button" role="tab">Pengalaman (Experience)</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="skills-tab" data-bs-toggle="tab" data-bs-target="#skills" type="button" role="tab">Skills (%)</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="tools-tab" data-bs-toggle="tab" data-bs-target="#tools" type="button" role="tab">Tools</button>
    </li>
</ul>

<div class="tab-content" id="resumeTabsContent">
    <!-- EXPERIENCES TAB -->
    <div class="tab-pane fade show active" id="exp" role="tabpanel">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Daftar Pengalaman</h6>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addExpModal">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-datatable">
                        <thead>
                            <tr>
                                <th>Periode</th>
                                <th>Posisi / Judul</th>
                                <th>Deskripsi</th>
                                <th>Urutan</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($experiences as $item): ?>
                                <tr>
                                    <td><span class="badge bg-light text-dark border"><?= $item['period'] ?></span></td>
                                    <td class="fw-medium"><?= $item['title'] ?></td>
                                    <td>
                                        <span class="d-inline-block text-truncate" style="max-width: 250px;" title="<?= esc($item['description']) ?>">
                                            <?= $item['description'] ?>
                                        </span>
                                    </td>
                                    <td><?= $item['sort_order'] ?></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editExpModal<?= $item['id'] ?>"><i class="bi bi-pencil"></i></button>
                                        <form action="<?= base_url('admin/resume/experience/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                
                                <!-- Edit Exp Modal -->
                                <div class="modal fade" id="editExpModal<?= $item['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="<?= base_url('admin/resume/experience/update/' . $item['id']) ?>" method="post">
                                                <?= csrf_field() ?>
                                                <div class="modal-header"><h5 class="modal-title">Edit Pengalaman</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                                <div class="modal-body text-start">
                                                    <div class="mb-3">
                                                        <label class="form-label">Posisi / Judul *</label>
                                                        <input type="text" class="form-control" name="title" value="<?= $item['title'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Periode (contoh: 2020 - Sekarang) *</label>
                                                        <input type="text" class="form-control" name="period" value="<?= $item['period'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Deskripsi *</label>
                                                        <textarea class="form-control" name="description" rows="3" required><?= $item['description'] ?></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Urutan</label>
                                                        <input type="number" class="form-control" name="sort_order" value="<?= $item['sort_order'] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
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
    </div>

    <!-- SKILLS TAB -->
    <div class="tab-pane fade" id="skills" role="tabpanel">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Daftar Skills</h6>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addSkillModal">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-datatable">
                        <thead>
                            <tr>
                                <th>Nama Skill</th>
                                <th>Persentase</th>
                                <th>Urutan</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($skills as $item): ?>
                                <tr>
                                    <td class="fw-medium"><?= $item['name'] ?></td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="progress flex-grow-1 me-2" style="height: 6px;">
                                                <div class="progress-bar bg-primary" style="width: <?= $item['percentage'] ?>%"></div>
                                            </div>
                                            <span><?= $item['percentage'] ?>%</span>
                                        </div>
                                    </td>
                                    <td><?= $item['sort_order'] ?></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSkillModal<?= $item['id'] ?>"><i class="bi bi-pencil"></i></button>
                                        <form action="<?= base_url('admin/resume/skill/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                
                                <!-- Edit Skill Modal -->
                                <div class="modal fade" id="editSkillModal<?= $item['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="<?= base_url('admin/resume/skill/update/' . $item['id']) ?>" method="post">
                                                <?= csrf_field() ?>
                                                <div class="modal-header"><h5 class="modal-title">Edit Skill</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                                <div class="modal-body text-start">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Skill *</label>
                                                        <input type="text" class="form-control" name="name" value="<?= $item['name'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Persentase (0-100) *</label>
                                                        <input type="number" class="form-control" name="percentage" min="0" max="100" value="<?= $item['percentage'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Urutan</label>
                                                        <input type="number" class="form-control" name="sort_order" value="<?= $item['sort_order'] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
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
    </div>

    <!-- TOOLS TAB -->
    <div class="tab-pane fade" id="tools" role="tabpanel">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Daftar Tools</h6>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addToolModal">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-datatable">
                        <thead>
                            <tr>
                                <th>Nama Tool</th>
                                <th>Urutan</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($tools as $item): ?>
                                <tr>
                                    <td class="fw-medium"><?= $item['name'] ?></td>
                                    <td><?= $item['sort_order'] ?></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editToolModal<?= $item['id'] ?>"><i class="bi bi-pencil"></i></button>
                                        <form action="<?= base_url('admin/resume/tool/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                
                                <!-- Edit Tool Modal -->
                                <div class="modal fade" id="editToolModal<?= $item['id'] ?>" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <form action="<?= base_url('admin/resume/tool/update/' . $item['id']) ?>" method="post">
                                                <?= csrf_field() ?>
                                                <div class="modal-header"><h5 class="modal-title">Edit Tool</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                                                <div class="modal-body text-start">
                                                    <div class="mb-3">
                                                        <label class="form-label">Nama Tool *</label>
                                                        <input type="text" class="form-control" name="name" value="<?= $item['name'] ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Urutan</label>
                                                        <input type="number" class="form-control" name="sort_order" value="<?= $item['sort_order'] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
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
    </div>
</div>

<!-- Add Exp Modal -->
<div class="modal fade" id="addExpModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/resume/experience/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header"><h5 class="modal-title">Tambah Pengalaman</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Posisi / Judul *</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Periode (contoh: 2020 - Sekarang) *</label>
                        <input type="text" class="form-control" name="period" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi *</label>
                        <textarea class="form-control" name="description" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" class="form-control" name="sort_order" value="0">
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Add Skill Modal -->
<div class="modal fade" id="addSkillModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/resume/skill/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header"><h5 class="modal-title">Tambah Skill</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Skill *</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Persentase (0-100) *</label>
                        <input type="number" class="form-control" name="percentage" min="0" max="100" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" class="form-control" name="sort_order" value="0">
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>

<!-- Add Tool Modal -->
<div class="modal fade" id="addToolModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/resume/tool/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header"><h5 class="modal-title">Tambah Tool</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Tool *</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Urutan</label>
                        <input type="number" class="form-control" name="sort_order" value="0">
                    </div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
            </form>
        </div>
    </div>
</div>

<style>
.custom-tabs .nav-link {
    color: #6c757d;
    font-weight: 500;
    border-radius: 5px;
    margin-right: 5px;
}
.custom-tabs .nav-link.active {
    background-color: #ff69b4;
    color: white;
}
</style>
<?= $this->endSection() ?>
