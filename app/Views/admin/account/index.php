<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="admin-page-header">
    <div>
        <h2 class="mb-1">Pengaturan Akun Saya</h2>
        <p class="text-muted mb-0">Kelola nama profil administrator, alamat email, password, & foto avatar.</p>
    </div>
</div>

<div class="row">
    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-body p-4">
                <form action="<?= base_url('admin/account/update') ?>" method="post" enctype="multipart/form-data" autocomplete="off">
                    <?= csrf_field() ?>
                    
                    <div class="text-center mb-4">
                        <div class="d-inline-block position-relative">
                            <?php if(isset($admin['avatar']) && $admin['avatar']): ?>
                                <img src="<?= base_url('assets/uploads/avatars/' . $admin['avatar']) ?>" id="avatar-preview" class="rounded-circle border border-3 border-primary" style="width: 120px; height: 120px; object-fit: cover;">
                            <?php else: ?>
                                <img src="https://ui-avatars.com/api/?name=<?= urlencode($admin['name'] ?? 'Admin') ?>&background=random" id="avatar-preview" class="rounded-circle border border-3 border-primary" style="width: 120px; height: 120px; object-fit: cover;">
                            <?php endif; ?>
                        </div>
                        <div class="mt-3">
                            <label for="avatar-input" class="btn btn-sm btn-outline-primary">Ubah Foto Profil</label>
                            <input type="file" id="avatar-input" name="avatar" class="d-none" accept="image/*">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" class="form-control" name="name" value="<?= esc($admin['name'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email *</label>
                            <input type="email" class="form-control" name="email" value="<?= esc($admin['email'] ?? '') ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username (Untuk Login) *</label>
                        <input type="text" class="form-control" name="username" value="<?= esc($admin['username'] ?? '') ?>" required autocomplete="off">
                    </div>

                    <hr class="my-4">
                    
                    <h6 class="fw-bold mb-3">Ganti Password</h6>
                    <div class="alert alert-info py-2">
                        <i class="bi bi-info-circle me-2"></i>Biarkan kosong jika tidak ingin mengubah password.
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">Password Baru</label>
                        <div class="position-relative">
                            <input type="password" class="form-control pe-5" id="accountPassword" name="password" minlength="6" placeholder="Masukkan password baru..." autocomplete="new-password" value="">
                            <button type="button" id="toggleAccountPassword" class="btn btn-link text-muted position-absolute end-0 top-50 translate-middle-y text-decoration-none pe-3 shadow-none border-0" style="z-index: 5;" aria-label="Toggle password visibility">
                                <i class="ri-eye-off-line fs-5"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4"><i class="bi bi-save me-2"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Avatar preview
    const avatarInput = document.getElementById('avatar-input');
    const avatarPreview = document.getElementById('avatar-preview');
    
    if (avatarInput && avatarPreview) {
        avatarInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    avatarPreview.src = e.target.result;
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    }

    // Toggle Password Visibility
    const toggleBtn = document.getElementById('toggleAccountPassword');
    const passwordInput = document.getElementById('accountPassword');
    if (toggleBtn && passwordInput) {
        toggleBtn.addEventListener('click', function() {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            const icon = this.querySelector('i');
            if (icon) {
                icon.className = isPassword ? 'ri-eye-line fs-5 text-primary' : 'ri-eye-off-line fs-5';
            }
        });
    }
});
</script>
<?= $this->endSection() ?>
