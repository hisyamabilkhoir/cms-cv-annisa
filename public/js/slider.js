/* ==========================================================================
   ABYNS STUDIO - Swiper Slider Configurations
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Testimonial Carousels Slider
    let testimonialSwiper;
    try {
        testimonialSwiper = new Swiper('.testimonials-swiper', {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            speed: 800,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 3,
                    spaceBetween: 40,
                }
            }
        });
    } catch (e) {
        console.warn('Swiper slider library not loaded or failed for testimonials slider.', e);
    }

    // 2. Ready-Made Products Slider (Desktop horizontal gallery, Mobile swipe)
    let productsSwiper;
    try {
        productsSwiper = new Swiper('.products-swiper', {
            slidesPerView: 1,
            spaceBetween: 24,
            grabCursor: true,
            speed: 600,
            pagination: {
                el: '.products-pagination',
                clickable: true,
            },
            breakpoints: {
                576: {
                    slidesPerView: 1.5,
                    spaceBetween: 24,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                1200: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                }
            }
        });
    } catch (e) {
        console.warn('Swiper slider library not loaded or failed for products slider.', e);
    }

    // 3. Premium Interactive Founder Avatar Curtain Slider
    const sliderInput = document.querySelector('.founder-slider-input');
    const annisaAvatar = document.querySelector('.annisa-avatar');
    const sliderHandle = document.querySelector('.founder-slider-handle');
    const hisyamTexts = document.querySelectorAll('.hisyam-text');
    const annisaTexts = document.querySelectorAll('.annisa-text');
    
    if (sliderInput && annisaAvatar && sliderHandle) {
        const ring1 = document.querySelector('.founder-ring.ring-1');
        const ring2 = document.querySelector('.founder-ring.ring-2');
        const sliderButton = sliderHandle.querySelector('.founder-slider-button');
        
        const clipRect = document.getElementById('clip-rect');
        
        function updateSlider() {
            const val = sliderInput.value;
            
            // 360 degree angle mapping (0 to 360 degrees)
            const angle = val * 3.6;
            
            // Translate the split line horizontally (avatar width is dynamic)
            const avatarWidth = annisaAvatar.offsetWidth || 170;
            const translateX = (val / 100) * avatarWidth;
            const centerY = avatarWidth / 2;
            
            // Update SVG clipPath rect transform
            if (clipRect) {
                clipRect.setAttribute('transform', `translate(${translateX}, 0) rotate(${angle}, 0, ${centerY})`);
            }
            
            // Move slider handle line horizontally and rotate it 360 degrees
            sliderHandle.style.left = `${val}%`;
            sliderHandle.style.transform = `translateX(-50%) rotate(${angle}deg)`;
            
            // Spin the center button (dot) on its own axis as it slides
            if (sliderButton) {
                const rotationAngle = (val - 50) * 7.2; // full 720 deg rotation
                sliderButton.style.transform = `translate(-50%, -50%) rotate(${rotationAngle}deg)`;
            }
            
            // Spin the decorative outer rings like mechanical dials
            if (ring1) {
                ring1.style.transform = `rotate(${val * 3.6}deg)`;
            }
            if (ring2) {
                ring2.style.transform = `rotate(${-val * 3.6}deg)`;
            }
            
            // Toggle active texts based on slider position (threshold 50%)
            const founderTabs = document.querySelectorAll('.founder-tab');
            if (val > 50) {
                hisyamTexts.forEach(el => el.classList.remove('active'));
                annisaTexts.forEach(el => el.classList.add('active'));
                founderTabs.forEach(tab => {
                    if (tab.getAttribute('data-tab') === 'annisa') tab.classList.add('active');
                    else tab.classList.remove('active');
                });
            } else {
                annisaTexts.forEach(el => el.classList.remove('active'));
                hisyamTexts.forEach(el => el.classList.add('active'));
                founderTabs.forEach(tab => {
                    if (tab.getAttribute('data-tab') === 'hisyam') tab.classList.add('active');
                    else tab.classList.remove('active');
                });
            }
        }
        
        sliderInput.addEventListener('input', updateSlider);
        sliderInput.addEventListener('change', updateSlider);

        // Mobile tabs support
        const founderTabs = document.querySelectorAll('.founder-tab');
        founderTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.getAttribute('data-tab');
                if (target === 'hisyam') {
                    sliderInput.value = 0;
                } else {
                    sliderInput.value = 100;
                }
                updateSlider();
            });
        });
        
        // Initialize at 50% split reveal
        updateSlider();
    }

    // 4. Premium Interactive Workflow Curtain Slider
    const workflowSliderInput = document.querySelector('.workflow-slider-input');
    const workflowSlideCam = document.querySelector('.workflow-slide-cam');
    const workflowSlideDev = document.querySelector('.workflow-slide-dev');
    const workflowSliderHandle = document.querySelector('.workflow-slider-handle');
    const workflowTabs = document.querySelectorAll('.workflow-tab');

    if (workflowSliderInput && workflowSlideCam && workflowSliderHandle) {
        function updateWorkflowSlider() {
            const val = workflowSliderInput.value;
            // Map 0-100 to 2% - 98% of the viewport width to align with card border curves
            const pos = 2 + (val / 100) * 96;

            // Update clip path of overlay (Photographer/Videographer slide)
            workflowSlideCam.style.clipPath = `polygon(0 0, ${pos}% 0, ${pos}% 100%, 0 100%)`;
            // Move slider handle
            workflowSliderHandle.style.left = `${pos}%`;

            // Active Tab Class based on value
            if (val > 50) {
                workflowTabs.forEach(tab => {
                    if (tab.getAttribute('data-tab') === 'cam') tab.classList.add('active');
                    else tab.classList.remove('active');
                });
                // For mobile responsive toggle
                workflowSlideCam.classList.add('mobile-active');
                workflowSlideDev.classList.add('mobile-hidden');
            } else {
                workflowTabs.forEach(tab => {
                    if (tab.getAttribute('data-tab') === 'dev') tab.classList.add('active');
                    else tab.classList.remove('active');
                });
                // For mobile responsive toggle
                workflowSlideCam.classList.remove('mobile-active');
                workflowSlideDev.classList.remove('mobile-hidden');
            }
        }

        workflowSliderInput.addEventListener('input', updateWorkflowSlider);
        workflowSliderInput.addEventListener('change', updateWorkflowSlider);

        // Tab click behavior
        workflowTabs.forEach(tab => {
            tab.addEventListener('click', () => {
                const target = tab.getAttribute('data-tab');
                if (target === 'dev') {
                    workflowSliderInput.value = 0;
                } else {
                    workflowSliderInput.value = 100;
                }
                updateWorkflowSlider();
            });
        });

        // Initialize at 0% split reveal (Developer by default)
        workflowSliderInput.value = 0;
        updateWorkflowSlider();
    }

    // 5. Custom Mobile Gallery Scroll Slider Control
    const galleryGrid = document.querySelector('.gallery-grid-new');
    const galleryControl = document.querySelector('.gallery-slider-control-mobile');
    
    if (galleryGrid && galleryControl) {
        const sliderInput = galleryControl.querySelector('.gallery-slider-input');
        const sliderHandle = galleryControl.querySelector('.gallery-slider-handle');
        const prevBtn = galleryControl.querySelector('.prev-btn');
        const nextBtn = galleryControl.querySelector('.next-btn');
        
        let isScrolledBySlider = false;
        
        function updateSliderFromScroll() {
            if (isScrolledBySlider) return;
            const maxScroll = galleryGrid.scrollWidth - galleryGrid.clientWidth;
            const pct = maxScroll > 0 ? (galleryGrid.scrollLeft / maxScroll) * 100 : 0;
            if (sliderInput) sliderInput.value = pct;
            if (sliderHandle) sliderHandle.style.left = `${pct}%`;
        }
        
        function updateScrollFromSlider() {
            isScrolledBySlider = true;
            const val = sliderInput.value;
            const maxScroll = galleryGrid.scrollWidth - galleryGrid.clientWidth;
            galleryGrid.scrollLeft = (val / 100) * maxScroll;
            if (sliderHandle) sliderHandle.style.left = `${val}%`;
            
            // reset scroll flag shortly
            setTimeout(() => { isScrolledBySlider = false; }, 50);
        }
        
        if (sliderInput) {
            sliderInput.addEventListener('input', updateScrollFromSlider);
            sliderInput.addEventListener('change', updateScrollFromSlider);
        }
        
        galleryGrid.addEventListener('scroll', updateSliderFromScroll);
        
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                galleryGrid.scrollBy({ left: -290, behavior: 'smooth' });
            });
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                galleryGrid.scrollBy({ left: 290, behavior: 'smooth' });
            });
        }
        
        // Init
        updateSliderFromScroll();
    }

    // 6. Custom Mobile Testimonials Scroll Slider Control
    const testimonialsGrid = document.querySelector('.testimonials-cards-row');
    const testimonialsControl = document.querySelector('.testimonials-slider-control-mobile');
    
    if (testimonialsGrid && testimonialsControl) {
        const sliderInput = testimonialsControl.querySelector('.testimonials-slider-input');
        const sliderHandle = testimonialsControl.querySelector('.testimonials-slider-handle');
        const prevBtn = testimonialsControl.querySelector('.prev-btn');
        const nextBtn = testimonialsControl.querySelector('.next-btn');
        
        let isScrolledBySlider = false;
        
        function updateSliderFromScroll() {
            if (isScrolledBySlider) return;
            const maxScroll = testimonialsGrid.scrollWidth - testimonialsGrid.clientWidth;
            const pct = maxScroll > 0 ? (testimonialsGrid.scrollLeft / maxScroll) * 100 : 0;
            if (sliderInput) sliderInput.value = pct;
            if (sliderHandle) sliderHandle.style.left = `${pct}%`;
        }
        
        function updateScrollFromSlider() {
            isScrolledBySlider = true;
            const val = sliderInput.value;
            const maxScroll = testimonialsGrid.scrollWidth - testimonialsGrid.clientWidth;
            testimonialsGrid.scrollLeft = (val / 100) * maxScroll;
            if (sliderHandle) sliderHandle.style.left = `${val}%`;
            
            // reset scroll flag shortly
            setTimeout(() => { isScrolledBySlider = false; }, 50);
        }
        
        if (sliderInput) {
            sliderInput.addEventListener('input', updateScrollFromSlider);
            sliderInput.addEventListener('change', updateScrollFromSlider);
        }
        
        testimonialsGrid.addEventListener('scroll', updateSliderFromScroll);
        
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                testimonialsGrid.scrollBy({ left: -290, behavior: 'smooth' });
            });
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                testimonialsGrid.scrollBy({ left: 290, behavior: 'smooth' });
            });
        }
        
        // Init
        updateSliderFromScroll();
    }
});
