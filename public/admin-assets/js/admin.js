document.addEventListener('DOMContentLoaded', function() {
    // Sidebar Toggle
    const sidebarToggler = document.querySelector('.sidebar-toggler, .sidebar-mobile-toggler');
    const sidebar = document.querySelector('.sidebar');
    if (sidebarToggler && sidebar) {
        sidebarToggler.addEventListener('click', function() {
            sidebar.classList.toggle('show');
        });
    }

    // Command/Ctrl + K shortcut to focus search input
    document.addEventListener('keydown', function(e) {
        if ((e.metaKey || e.ctrlKey) && e.key === 'k') {
            e.preventDefault();
            const searchInput = document.querySelector('.search-input');
            if (searchInput) searchInput.focus();
        }
    });

    // Image Preview on Upload
    const imageInputs = document.querySelectorAll('.image-preview-input');
    imageInputs.forEach(input => {
        input.addEventListener('change', function() {
            const previewId = this.dataset.preview;
            if (previewId) {
                const previewImg = document.getElementById(previewId);
                if (previewImg && this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        previewImg.style.display = 'block';
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            }
        });
    });

    // Delete Confirmation with Aesthetic Custom Pink Modal & Button Loader (Event Delegation)
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (form && form.classList.contains('delete-form')) {
            if (form.dataset.confirmed === 'true') {
                return; // Already confirmed, submit naturally
            }
            e.preventDefault();

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Hapus Data Ini?',
                    html: 'Data yang dihapus akan hilang secara permanen.',
                    icon: 'warning',
                    iconColor: '#ec407a',
                    showCancelButton: true,
                    confirmButtonText: '<i class="ri-delete-bin-line me-1"></i> Ya, Hapus Data',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'pink-swal-popup',
                        title: 'pink-swal-title',
                        htmlContainer: 'pink-swal-html',
                        confirmButton: 'btn btn-pink-danger rounded-pill px-4 py-2 me-2',
                        cancelButton: 'btn btn-light rounded-pill px-4 py-2 border'
                    },
                    buttonsStyling: false,
                    reverseButtons: true,
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !Swal.isLoading(),
                    preConfirm: () => {
                        const confirmBtn = Swal.getConfirmButton();
                        if (confirmBtn) {
                            confirmBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Menghapus...';
                            confirmBtn.disabled = true;
                        }
                        const cancelBtn = Swal.getCancelButton();
                        if (cancelBtn) {
                            cancelBtn.disabled = true;
                        }
                        form.dataset.confirmed = 'true';
                        form.submit();
                        return new Promise(() => {}); // Keep loader active until form submits and page reloads
                    }
                });
            } else {
                if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                    form.dataset.confirmed = 'true';
                    form.submit();
                }
            }
        }
    });

    // Auto-append all Bootstrap modals to <body> when shown
    // This prevents CSS stacking context bugs caused by parent glassmorphism/z-index containers
    document.body.addEventListener('show.bs.modal', function(e) {
        const modal = e.target;
        if (modal && modal.parentNode !== document.body) {
            document.body.appendChild(modal);
        }
    });

    // Global Form Submit Button Loader
    document.addEventListener('submit', function(e) {
        const form = e.target;
        if (e.defaultPrevented || form.classList.contains('delete-form')) return;

        const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
        if (submitBtn && !submitBtn.classList.contains('no-loader')) {
            if (submitBtn.offsetWidth) {
                submitBtn.style.minWidth = submitBtn.offsetWidth + 'px';
            }

            const originalHTML = submitBtn.innerHTML;
            const isButtonTag = submitBtn.tagName === 'BUTTON';

            setTimeout(function() {
                if (isButtonTag) {
                    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Menyimpan...';
                } else {
                    submitBtn.value = 'Menyimpan...';
                }
                submitBtn.disabled = true;
            }, 10);

            setTimeout(function() {
                if (form.querySelectorAll(':invalid').length > 0) {
                    submitBtn.disabled = false;
                    if (isButtonTag) {
                        submitBtn.innerHTML = originalHTML;
                    } else {
                        submitBtn.value = originalHTML;
                    }
                    submitBtn.style.minWidth = '';
                }
            }, 150);
        }
    });

    // Logout Confirmation Modal (SweetAlert2)
    document.addEventListener('click', function(e) {
        const logoutBtn = e.target.closest('.btn-logout');
        if (logoutBtn) {
            e.preventDefault();
            const logoutUrl = logoutBtn.getAttribute('href');

            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Keluar dari Sesi?',
                    text: 'Anda harus memasukkan username & password kembali untuk mengakses admin.',
                    icon: 'question',
                    iconColor: '#d64eaa',
                    showCancelButton: true,
                    confirmButtonText: '<i class="ri-logout-box-r-line me-1"></i> Ya, Logout',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'pink-swal-popup',
                        title: 'pink-swal-title',
                        htmlContainer: 'pink-swal-html',
                        confirmButton: 'btn btn-pink-danger rounded-pill px-4 py-2 me-2',
                        cancelButton: 'btn btn-light rounded-pill px-4 py-2 border'
                    },
                    buttonsStyling: false,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = logoutUrl;
                    }
                });
            } else {
                if (confirm('Apakah Anda yakin ingin logout dari admin?')) {
                    window.location.href = logoutUrl;
                }
            }
        }
    });
});
