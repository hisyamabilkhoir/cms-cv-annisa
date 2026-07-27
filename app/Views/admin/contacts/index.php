<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="mb-4">
    <h4 class="mb-0 fw-bold">Kelola Kontak & Pesan</h4>
</div>

<ul class="nav nav-pills mb-4 custom-tabs" id="contactTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages" type="button" role="tab">Pesan Masuk</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button" role="tab">Social Media</button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="settings-tab" data-bs-toggle="tab" data-bs-target="#settings" type="button" role="tab">Pengaturan Kontak</button>
    </li>
</ul>

<div class="tab-content" id="contactTabsContent">
    <!-- MESSAGES TAB -->
    <div class="tab-pane fade show active" id="messages" role="tabpanel">
        <div class="card">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-bold">Daftar Pesan Masuk</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-datatable">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Pesan</th>
                                <th>Status</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($messages as $item): ?>
                                <tr class="<?= !$item['is_read'] ? 'table-light fw-medium' : '' ?>">
                                    <td><?= date('d M Y H:i', strtotime($item['created_at'] ?? 'now')) ?></td>
                                    <td><?= esc($item['name']) ?></td>
                                    <td><a href="mailto:<?= esc($item['email']) ?>"><?= esc($item['email']) ?></a></td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-light text-start w-100 border text-truncate" style="max-width:200px" data-bs-toggle="modal" data-bs-target="#msgModal<?= $item['id'] ?>">
                                            <?= esc($item['message']) ?>
                                        </button>
                                    </td>
                                    <td>
                                        <?php if($item['is_read']): ?>
                                            <span class="badge bg-secondary">Terbaca</span>
                                        <?php else: ?>
                                            <span class="badge bg-primary">Baru</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php if(!$item['is_read']): ?>
                                            <form action="<?= base_url('admin/contacts/message/read/' . $item['id']) ?>" method="post" class="d-inline">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-sm btn-outline-success me-1" title="Tandai Terbaca"><i class="bi bi-check2-all"></i></button>
                                            </form>
                                        <?php endif; ?>
                                        <form action="<?= base_url('admin/contacts/message/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SOCIALS TAB -->
    <div class="tab-pane fade" id="social" role="tabpanel">
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Social Media Links</h6>
                <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addSocialModal">
                    <i class="bi bi-plus"></i> Tambah
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table custom-datatable">
                        <thead>
                            <tr>
                                <th>Icon</th>
                                <th>Platform</th>
                                <th>URL</th>
                                <th>Urutan</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($socials as $item): ?>
                                <tr>
                                    <td><i class="ri-<?= esc($item['icon']) ?> fs-4 text-primary"></i></td>
                                    <td class="fw-medium"><?= esc($item['platform']) ?></td>
                                    <td><a href="<?= esc($item['url']) ?>" target="_blank"><?= esc($item['url']) ?></a></td>
                                    <td><?= $item['sort_order'] ?></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editSocialModal<?= $item['id'] ?>"><i class="bi bi-pencil"></i></button>
                                        <form action="<?= base_url('admin/contacts/social/delete/' . $item['id']) ?>" method="post" class="d-inline delete-form">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SETTINGS TAB -->
    <div class="tab-pane fade" id="settings" role="tabpanel">
        <div class="card">
            <div class="card-header bg-white">
                <h6 class="mb-0 fw-bold">Informasi Kontak & Peta</h6>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/contacts/settings/update') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email Kontak *</label>
                            <input type="email" class="form-control" name="contact_email" value="<?= esc($settings['contact_email'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">No. Telepon / WhatsApp (Opsional)</label>
                            <input type="text" class="form-control" name="contact_phone" value="<?= esc($settings['contact_phone'] ?? '') ?>">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat / Lokasi *</label>
                        <textarea class="form-control" name="contact_address" rows="3" required><?= esc($settings['contact_address'] ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Google Maps Iframe Embed Code (Opsional)</label>
                        <textarea class="form-control" name="contact_map_iframe" rows="4" placeholder='<iframe src="..."></iframe>'><?= esc($settings['contact_map_iframe'] ?? '') ?></textarea>
                        <small class="text-muted">Dapatkan kode iframe embed dari Google Maps. Biarkan kosong jika tidak ingin menampilkan peta.</small>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary"><i class="bi bi-save me-2"></i> Simpan Pengaturan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Message Detail Modals (outside table) -->
<?php foreach($messages as $item): ?>
    <div class="modal fade" id="msgModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Pesan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-start">
                    <p><strong>Dari:</strong> <?= esc($item['name']) ?> &lt;<?= esc($item['email']) ?>&gt;</p>
                    <p><strong>Tanggal:</strong> <?= date('d M Y H:i', strtotime($item['created_at'] ?? 'now')) ?></p>
                    <hr>
                    <div class="bg-light p-3 rounded border">
                        <?= nl2br(esc($item['message'])) ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="mailto:<?= esc($item['email']) ?>" class="btn btn-primary"><i class="bi bi-reply"></i> Balas via Email</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<!-- Edit Social Modals (outside table) -->
<?php foreach($socials as $item): ?>
    <div class="modal fade" id="editSocialModal<?= $item['id'] ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="<?= base_url('admin/contacts/social/update/' . $item['id']) ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-header"><h5 class="modal-title">Edit Social Link</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-start">
                        <div class="mb-3">
                            <label class="form-label">Platform (cth: Instagram) *</label>
                            <input type="text" class="form-control" name="platform" value="<?= esc($item['platform']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">URL Profile *</label>
                            <input type="url" class="form-control" name="url" value="<?= esc($item['url']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Icon (Remix Icon tanpa 'ri-') *</label>
                            <input type="text" class="form-control" name="icon" value="<?= esc($item['icon']) ?>" placeholder="instagram-fill" required>
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

<!-- Add Social Modal -->
<div class="modal fade" id="addSocialModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?= base_url('admin/contacts/social/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-header"><h5 class="modal-title">Tambah Social Link</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Platform (cth: Instagram) *</label>
                        <input type="text" class="form-control" name="platform" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL Profile *</label>
                        <input type="url" class="form-control" name="url" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Icon (Remix Icon tanpa 'ri-') *</label>
                        <input type="text" class="form-control" name="icon" placeholder="instagram-fill" required>
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
    padding: 8px 16px;
}
.custom-tabs .nav-link.active {
    background-color: var(--bs-primary);
    color: #fff;
}
</style>
<?= $this->endSection() ?>
