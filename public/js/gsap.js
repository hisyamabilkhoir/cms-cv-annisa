/* ==========================================================================
   ABYNS STUDIO - GSAP & ScrollTrigger Animations
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
    // Register GSAP ScrollTrigger plugin
    gsap.registerPlugin(ScrollTrigger);

    // 1. Preloader / Hero Entrance Sequence
    const initHeroIntro = () => {
        const tl = gsap.timeline();

        // Reveal Hero items
        tl.to('.hero-title-reveal', {
            y: 0,
            duration: 1.2,
            stagger: 0.15,
            ease: 'power4.out',
            delay: 0.3
        })
        .to('.hero-desc', {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: 'power3.out'
        }, '-=0.8')
        .to('.hero-ctas', {
            opacity: 1,
            y: 0,
            duration: 0.8,
            stagger: 0.1,
            ease: 'power3.out'
        }, '-=0.6')
        .to('.hero-features', {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: 'power3.out'
        }, '-=0.5')
        .to('.hero-stats-bar', {
            opacity: 1,
            y: 0,
            duration: 0.8,
            ease: 'power3.out'
        }, '-=0.6')
        .to('.hero-visual-container', {
            opacity: 1,
            scale: 1,
            y: 0,
            duration: 1.5,
            ease: 'power4.out'
        }, '-=1.2')
        .to('.header-nav', {
            opacity: 1,
            y: 0,
            duration: 1,
            ease: 'power3.out'
        }, '-=1');
    };

    // Run hero introduction animation if hero section exists on the current page
    if (document.querySelector('.hero')) {
        initHeroIntro();
    }

    // 2. Text Reveal Scroll Animation (Split-text simulation)
    const textReveals = document.querySelectorAll('.text-reveal');
    textReveals.forEach(text => {
        gsap.fromTo(text, 
            { y: '50px', opacity: 0 },
            {
                y: 0,
                opacity: 1,
                duration: 1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: text,
                    start: 'top 85%',
                    toggleActions: 'play none none none'
                }
            }
        );
    });

    // 3. Staggered Elements Fade-Up (Cards, items)
    const staggerContainers = document.querySelectorAll('.stagger-container');
    staggerContainers.forEach(container => {
        const items = container.querySelectorAll('.stagger-item');
        gsap.from(items, {
            y: 40,
            duration: 0.8,
            stagger: 0.1,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: container,
                start: 'top 95%',
                toggleActions: 'play none none none'
            }
        });
    });

    // 4. Parallax Section Backgrounds & Image Zoom
    const parallaxImages = document.querySelectorAll('.parallax-img');
    parallaxImages.forEach(img => {
        gsap.fromTo(img, 
            { yPercent: -15 },
            {
                yPercent: 15,
                ease: 'none',
                scrollTrigger: {
                    trigger: img.parentElement,
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: true
                }
            }
        );
    });

    // 5. Image Mask Reveal (editorial slides)
    const revealMasks = document.querySelectorAll('.img-reveal-mask');
    revealMasks.forEach(mask => {
        ScrollTrigger.create({
            trigger: mask,
            start: 'top 75%',
            onEnter: () => mask.classList.add('revealed'),
            once: true
        });
    });

    // 6. Process Timeline Progression Path (Drawing the golden line)
    const processTimeline = document.querySelector('.process-timeline');
    const processLine = document.querySelector('.process-progress-bar');
    if (processTimeline && processLine) {
        gsap.fromTo(processLine, 
            { scaleY: 0 },
            {
                scaleY: 1,
                transformOrigin: 'top center',
                ease: 'none',
                scrollTrigger: {
                    trigger: processTimeline,
                    start: 'top 60%',
                    end: 'bottom 60%',
                    scrub: true
                }
            }
        );
    }

    // Horizontal scroll layout timeline for desktops
    if (window.innerWidth >= 992) {
        const processSteps = document.querySelectorAll('.process-step');
        processSteps.forEach((step, idx) => {
            gsap.from(step, {
                opacity: 0,
                x: 40,
                duration: 0.8,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: step,
                    start: 'top 85%',
                    toggleActions: 'play none none none'
                }
            });
        });
    }

    // 7. Founder Floating Card & Story Parallax
    const founderImg = document.querySelector('.founder-img-box');
    const founderCard = document.querySelector('.founder-story-card');
    
    if (founderImg && founderCard) {
        gsap.from(founderImg, {
            xPercent: -20,
            opacity: 0,
            duration: 1.2,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.section-founder',
                start: 'top 70%'
            }
        });

        gsap.from(founderCard, {
            xPercent: 20,
            opacity: 0,
            duration: 1.2,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.section-founder',
                start: 'top 70%'
            }
        });
    }
});
