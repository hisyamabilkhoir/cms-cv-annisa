/* ==========================================================================
   ABYNS STUDIO - Portfolio Filtering & Detail Modals
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Portfolio Category Filtering
    const filterButtons = document.querySelectorAll('.portfolio-filter-btn');
    const portfolioItems = document.querySelectorAll('.portfolio-item');

    if (filterButtons.length > 0 && portfolioItems.length > 0) {
        filterButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                // Update active state of buttons
                filterButtons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const selectedFilter = this.getAttribute('data-filter');

                portfolioItems.forEach(item => {
                    const categories = item.getAttribute('data-category').split(' ');
                    
                    if (selectedFilter === 'all' || categories.includes(selectedFilter)) {
                        // Reveal match
                        gsap.to(item, {
                            scale: 1,
                            opacity: 1,
                            duration: 0.5,
                            display: 'block',
                            ease: 'power3.out'
                        });
                    } else {
                        // Hide mismatch
                        gsap.to(item, {
                            scale: 0.8,
                            opacity: 0,
                            duration: 0.4,
                            display: 'none',
                            ease: 'power3.in'
                        });
                    }
                });
            });
        });
    }

    // 2. Portfolio Detail Modal Popup / Navigation
    const modal = document.querySelector('.portfolio-modal');
    const modalClose = document.querySelector('.modal-close-btn');
    const modalImage = document.querySelector('.modal-main-img');
    const modalTitle = document.querySelector('.modal-project-title');
    const modalClient = document.querySelector('.modal-client-val');
    const modalTech = document.querySelector('.modal-tech-val');
    const modalDesc = document.querySelector('.modal-project-desc');
    const portfolioCards = document.querySelectorAll('.portfolio-card');

    if (portfolioCards.length > 0) {
        portfolioCards.forEach(card => {
            card.addEventListener('click', function(e) {
                // If card has data-link attribute, redirect instead of opening modal
                const directLink = this.getAttribute('data-link') || this.getAttribute('href');
                if (directLink && directLink !== '#') {
                    window.location.href = directLink;
                    return;
                }

                if (!modal) return;
                e.preventDefault();
                
                // Get project metadata
                const img = this.querySelector('.portfolio-img').src;
                const title = this.querySelector('.portfolio-title').textContent;
                const category = this.querySelector('.portfolio-category').textContent;
                const client = this.getAttribute('data-client') || this.parentElement.getAttribute('data-client') || 'Premium Client';
                const tech = this.getAttribute('data-tech') || this.parentElement.getAttribute('data-tech') || 'Custom Solution';
                const desc = this.getAttribute('data-desc') || this.parentElement.getAttribute('data-desc') || 'A custom-built, luxury digital solution tailored to elevate brand prestige and engagement.';

                // Inject data into Modal
                modalImage.src = img;
                modalTitle.textContent = title;
                modalClient.textContent = client;
                modalTech.textContent = tech;
                modalDesc.textContent = desc;

                // Open modal with GSAP
                document.body.style.overflow = 'hidden'; // prevent scrolling
                modal.style.display = 'flex';
                
                gsap.fromTo(modal, 
                    { opacity: 0 },
                    { opacity: 1, duration: 0.4, ease: 'power2.out' }
                );

                gsap.fromTo('.modal-content-wrapper', 
                    { y: 50, scale: 0.95 },
                    { y: 0, scale: 1, duration: 0.6, ease: 'power4.out', delay: 0.1 }
                );
            });
        });

        // Close functions
        const closeModal = () => {
            gsap.to('.modal-content-wrapper', {
                y: 30,
                scale: 0.95,
                duration: 0.4,
                ease: 'power3.in',
            });
            
            gsap.to(modal, {
                opacity: 0,
                duration: 0.4,
                ease: 'power2.in',
                onComplete: () => {
                    modal.style.display = 'none';
                    document.body.style.overflow = ''; // restore scrolling
                }
            });
        };

        if (modalClose) {
            modalClose.addEventListener('click', closeModal);
        }

        // Close on clicking outside container
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });
    }
});
