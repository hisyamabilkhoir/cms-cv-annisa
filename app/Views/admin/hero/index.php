<?= $this->extend('admin/layouts/app') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h4 mb-0 fw-bold text-dark">Pengaturan Hero Section</h1>
</div>

<div class="card mb-4">
    <div class="card-header">
        <h5 class="card-title mb-0"><i class="ri-layout-top-2-line me-2 text-pink"></i> Edit Konten Hero Section</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('admin/hero/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            
            <div class="row g-4">
                <!-- Left Column: Text & Content Inputs + CV Upload & Iframe Preview -->
                <div class="col-md-7 col-lg-8">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Teks Badge (Pill)</label>
                        <input type="text" class="form-control" name="pill_text" value="<?= esc($hero['pill_text'] ?? '') ?>" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Judul Baris 1 (Tetap)</label>
                            <input type="text" class="form-control" name="title_line1" value="<?= esc($hero['title_line1'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Kata Typewriter 1 (Pisahkan dengan koma)</label>
                            <?php 
                                $words1 = isset($hero['typewrite_words1']) ? json_decode($hero['typewrite_words1'], true) : [];
                                $words1_str = is_array($words1) ? implode(', ', $words1) : '';
                            ?>
                            <input type="text" class="form-control" name="typewrite_words1" value="<?= esc($words1_str) ?>" required placeholder="nempel, berkesan, viral">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Judul Baris 2 (Tetap)</label>
                            <input type="text" class="form-control" name="title_line2" value="<?= esc($hero['title_line2'] ?? '') ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Kata Typewriter 2 (Pisahkan dengan koma)</label>
                            <?php 
                                $words2 = isset($hero['typewrite_words2']) ? json_decode($hero['typewrite_words2'], true) : [];
                                $words2_str = is_array($words2) ? implode(', ', $words2) : '';
                            ?>
                            <input type="text" class="form-control" name="typewrite_words2" value="<?= esc($words2_str) ?>" required placeholder="kerasa, nyata, maksimal">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea class="form-control" name="description" rows="3" required><?= esc($hero['description'] ?? '') ?></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Link Portfolio Drive</label>
                        <input type="url" class="form-control" name="portfolio_link" value="<?= esc($hero['portfolio_link'] ?? '') ?>" required>
                    </div>

                    <!-- File CV (PDF) Input & Preview Directly Below -->
                    <div class="mb-4 p-3 rounded-4" style="background: rgba(255, 240, 246, 0.4); border: 1px solid rgba(255, 105, 180, 0.2);">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <label class="form-label fw-bold mb-0 text-pink"><i class="ri-file-pdf-fill me-1"></i> File CV (PDF)</label>
                            <?php if(!empty($hero['cv_file'])): ?>
                                <a href="<?= base_url('assets/uploads/hero/' . $hero['cv_file']) ?>" target="_blank" class="btn btn-sm btn-outline-pink" id="cvDownloadBtn">
                                    <i class="ri-external-link-line me-1"></i> Buka PDF di Tab Baru
                                </a>
                            <?php endif; ?>
                        </div>
                        <input type="file" class="form-control mb-2" name="cv_file" accept=".pdf" id="cvFileInput">
                        <small class="text-muted d-block mb-3">Upload file PDF CV terbaru untuk langsung melihat preview di bawah ini.</small>

                        <!-- Live PDF Preview Container directly under input -->
                        <div class="pdf-iframe-container rounded-4 overflow-hidden shadow-sm border bg-white" id="pdfPreviewWrapper">
                            <?php if(!empty($hero['cv_file'])): ?>
                                <iframe id="pdfPreviewFrame" src="<?= base_url('assets/uploads/hero/' . $hero['cv_file']) ?>#toolbar=0" style="width: 100%; height: 500px; border: none; border-radius: 16px;"></iframe>
                            <?php else: ?>
                                <div class="p-4 text-center text-muted" id="pdfPlaceholder">
                                    <i class="ri-file-pdf-line fs-1 text-pink opacity-50 d-block mb-2"></i>
                                    <span class="small">Belum ada file CV (PDF). Pilih file PDF di atas untuk melihat preview langsung.</span>
                                </div>
                                <iframe id="pdfPreviewFrame" src="" style="width: 100%; height: 500px; border: none; border-radius: 16px; display: none;"></iframe>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Media Uploads (Photo, Desktop BG, Mobile BG) with natural aspect ratio previews -->
                <div class="col-md-5 col-lg-4">
                    <!-- Foto Profil -->
                    <div class="mb-4 p-3 rounded-4" style="background: rgba(255, 240, 246, 0.3); border: 1px solid rgba(255, 105, 180, 0.15);">
                        <label class="form-label fw-bold">Foto Profil</label>
                        <input type="file" class="form-control image-preview-input mb-2" name="photo" data-preview="photo-preview" accept="image/*">
                        <small class="text-muted d-block mb-2">Biarkan kosong jika tidak ingin mengubah.</small>
                        
                        <!-- Preview Image: Full width, height max-height 250px, object-fit contain -->
                        <div class="preview-img-container text-center rounded-3 overflow-hidden p-1" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(255,105,180,0.15);">
                            <?php if(!empty($hero['photo'])): ?>
                                <img id="photo-preview" src="<?= base_url('assets/uploads/hero/' . $hero['photo']) ?>" style="width: 100%; max-height: 250px; object-fit: contain; border-radius: 12px;">
                            <?php else: ?>
                                <img id="photo-preview" src="" style="width: 100%; max-height: 250px; object-fit: contain; border-radius: 12px; display: none;">
                                <span class="text-muted small py-3 d-block" id="photo-preview-placeholder">Preview foto profil akan muncul di sini.</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Background Desktop -->
                    <div class="mb-4 p-3 rounded-4" style="background: rgba(255, 240, 246, 0.3); border: 1px solid rgba(255, 105, 180, 0.15);">
                        <label class="form-label fw-bold">Background Desktop</label>
                        <input type="file" class="form-control image-preview-input mb-2" name="bg_desktop" data-preview="bg-desktop-preview" accept="image/*">
                        
                        <div class="preview-img-container text-center rounded-3 overflow-hidden p-1" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(255,105,180,0.15);">
                            <?php if(!empty($hero['bg_desktop'])): ?>
                                <img id="bg-desktop-preview" src="<?= base_url('assets/uploads/hero/' . $hero['bg_desktop']) ?>" style="width: 100%; max-height: 200px; object-fit: contain; border-radius: 12px;">
                            <?php else: ?>
                                <img id="bg-desktop-preview" src="" style="width: 100%; max-height: 200px; object-fit: contain; border-radius: 12px; display: none;">
                                <span class="text-muted small py-3 d-block" id="bg-desktop-preview-placeholder">Preview background desktop.</span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Background Mobile -->
                    <div class="mb-4 p-3 rounded-4" style="background: rgba(255, 240, 246, 0.3); border: 1px solid rgba(255, 105, 180, 0.15);">
                        <label class="form-label fw-bold">Background Mobile</label>
                        <input type="file" class="form-control image-preview-input mb-2" name="bg_mobile" data-preview="bg-mobile-preview" accept="image/*">
                        
                        <div class="preview-img-container text-center rounded-3 overflow-hidden p-1" style="background: rgba(0,0,0,0.02); border: 1px solid rgba(255,105,180,0.15);">
                            <?php if(!empty($hero['bg_mobile'])): ?>
                                <img id="bg-mobile-preview" src="<?= base_url('assets/uploads/hero/' . $hero['bg_mobile']) ?>" style="width: 100%; max-height: 240px; object-fit: contain; border-radius: 12px;">
                            <?php else: ?>
                                <img id="bg-mobile-preview" src="" style="width: 100%; max-height: 240px; object-fit: contain; border-radius: 12px; display: none;">
                                <span class="text-muted small py-3 d-block" id="bg-mobile-preview-placeholder">Preview background mobile.</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary"><i class="ri-save-line me-2"></i> Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. PDF Live Preview Handler
    const cvInput = document.getElementById('cvFileInput');
    const pdfFrame = document.getElementById('pdfPreviewFrame');
    const pdfPlaceholder = document.getElementById('pdfPlaceholder');
    
    if (cvInput) {
        cvInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const file = this.files[0];
                if (file.type === 'application/pdf' || file.name.endsWith('.pdf')) {
                    const objectUrl = URL.createObjectURL(file);
                    if (pdfFrame) {
                        pdfFrame.src = objectUrl + '#toolbar=0';
                        pdfFrame.style.display = 'block';
                    }
                    if (pdfPlaceholder) {
                        pdfPlaceholder.style.display = 'none';
                    }
                }
            }
        });
    }

    // 2. Image Inputs Live Preview Handler (natural aspect ratio, max height)
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
