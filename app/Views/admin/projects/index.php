<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="mb-0 fw-bold">Kelola Project</h4>
    <a href="<?= base_url('admin/projects/create') ?>" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Project
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table custom-datatable">
                <thead>
                    <tr>
                        <th>Thumbnail</th>
                        <th>Judul Project</th>
                        <th>Kategori</th>
                        <th>Tipe</th>
                        <th>Status</th>
                        <th>Urutan</th>
                        <th class="no-sort text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($projects as $item): ?>
                        <tr>
                            <td>
                                <?php if($item['thumbnail']): ?>
                                    <img src="<?= base_url('assets/uploads/projects/' . $item['thumbnail']) ?>" alt="<?= $item['title'] ?>" style="max-height: 50px; border-radius: 5px;">
                                <?php else: ?>
                                    <span class="text-muted">Tidak ada</span>
                                <?php endif; ?>
                            </td>
                            <td class="fw-medium">
                                <?= $item['title'] ?>
                                <?php if($item['tag']): ?>
                                    <br><small class="text-muted"><?= $item['tag'] ?></small>
                                <?php endif; ?>
                            </td>
                            <td><?= $item['category_name'] ?></td>
                            <td>
                                <?php 
                                    if($item['thumbnail_type'] == 'image') echo '<span class="badge bg-info">Image</span>';
                                    elseif($item['thumbnail_type'] == 'video') echo '<span class="badge bg-danger">Video (YT)</span>';
                                    else echo '<span class="badge bg-secondary">Both</span>';
                                ?>
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
                                <a href="<?= base_url('admin/projects/edit/' . $item['id']) ?>" class="btn btn-sm btn-outline-primary me-1">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?= base_url('admin/projects/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
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
<?= $this->endSection() ?>
