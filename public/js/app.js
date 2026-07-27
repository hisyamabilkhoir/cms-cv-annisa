/* ==========================================================================
   ABYNS STUDIO - Core Application Controller
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Initialize Lenis Smooth Scroll
    let lenis;
    try {
        lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)), // luxury ease out
            direction: 'vertical',
            gestureDirection: 'vertical',
            smooth: true,
            mouseMultiplier: 1,
            smoothTouch: false,
            touchMultiplier: 2,
            infinite: false,
        });

        // Connect Lenis to GSAP ScrollTrigger
        lenis.on('scroll', ScrollTrigger.update);

        gsap.ticker.add((time) => {
            lenis.raf(time * 1000);
        });

        gsap.ticker.lagSmoothing(0);
    } catch (e) {
        console.warn('Lenis scroll library not loaded or failed to initialize, falling back to default scrolling.', e);
    }

    // 2. Navigation Scroll Effect
    const header = document.querySelector('.header-nav');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // 3. Mobile Navigation Drawer Toggle
    const mobileTrigger = document.querySelector('.mobile-menu-trigger');
    const mobileDrawer = document.querySelector('.mobile-nav-drawer');
    const mobileLinks = document.querySelectorAll('.mobile-nav-link');

    if (mobileTrigger && mobileDrawer) {
        mobileTrigger.addEventListener('click', () => {
            mobileTrigger.classList.toggle('active');
            mobileDrawer.classList.toggle('active');
            document.body.classList.toggle('menu-open');
            
            // Toggle body scrolling when drawer is open
            if (mobileDrawer.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
                if (lenis) lenis.stop();
            } else {
                document.body.style.overflow = '';
                if (lenis) lenis.start();
            }
        });

        // Close drawer when clicking mobileDrawerClose
        const mobileDrawerClose = document.getElementById('mobileDrawerClose');
        if (mobileDrawerClose) {
            mobileDrawerClose.addEventListener('click', () => {
                mobileTrigger.classList.remove('active');
                mobileDrawer.classList.remove('active');
                document.body.classList.remove('menu-open');
                document.body.style.overflow = '';
                if (lenis) lenis.start();
            });
        }

        // Close drawer when clicking links
        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileTrigger.classList.remove('active');
                mobileDrawer.classList.remove('active');
                document.body.classList.remove('menu-open');
                document.body.style.overflow = '';
                if (lenis) lenis.start();
            });
        });
    }

    // 4. Smooth Anchor Link Navigation
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                if (lenis) {
                    lenis.scrollTo(targetElement, {
                        offset: -80,
                        duration: 1.5,
                    });
                } else {
                    targetElement.scrollIntoView({ behavior: 'smooth' });
                }
            }
        });
    });

    // 5. Accordion FAQs functionality
    const faqQuestions = document.querySelectorAll('.faq-question');
    faqQuestions.forEach(question => {
        question.addEventListener('click', function() {
            const item = this.parentElement;
            const answer = this.nextElementSibling;
            
            // Close other items if clicked (accordion style)
            const allItems = document.querySelectorAll('.faq-item');
            allItems.forEach(otherItem => {
                if (otherItem !== item && otherItem.classList.contains('active')) {
                    otherItem.classList.remove('active');
                    otherItem.querySelector('.faq-answer').style.maxHeight = null;
                }
            });

            // Toggle active item
            item.classList.toggle('active');
            if (item.classList.contains('active')) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
            } else {
                answer.style.maxHeight = null;
            }
        });
    });
});
