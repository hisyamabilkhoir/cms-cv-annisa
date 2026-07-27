/* ==========================================================================
   ABYNS STUDIO - Custom Cursor & Magnetic Interactions
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Initialize custom cursor markup dynamically
    if (window.innerWidth >= 992) { // Desktop only
        const cursor = document.createElement('div');
        cursor.classList.add('custom-cursor');
        
        const follower = document.createElement('div');
        follower.classList.add('custom-cursor-follower');
        
        document.body.appendChild(cursor);
        document.body.appendChild(follower);

        let mouseX = 0, mouseY = 0;
        let followerX = 0, followerY = 0;
        
        // Track mouse position
        document.addEventListener('mousemove', (e) => {
            mouseX = e.clientX;
            mouseY = e.clientY;
            
            // Instantly position the small core dot
            cursor.style.left = `${mouseX}px`;
            cursor.style.top = `${mouseY}px`;
        });

        // Smoothly interpolate the larger circle (Lerp)
        const renderCursor = () => {
            followerX += (mouseX - followerX) * 0.12;
            followerY += (mouseY - followerY) * 0.12;
            
            follower.style.left = `${followerX}px`;
            follower.style.top = `${followerY}px`;
            
            requestAnimationFrame(renderCursor);
        };
        renderCursor();

        // 2. Cursor Hover and Active states
        const interactiveElements = document.querySelectorAll('a, button, input, textarea, select, .faq-question, .portfolio-card, .product-card, .btn');
        
        interactiveElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                document.body.classList.add('cursor-hover');
            });
            el.addEventListener('mouseleave', () => {
                document.body.classList.remove('cursor-hover');
            });
        });

        document.addEventListener('mousedown', () => {
            document.body.classList.add('cursor-active');
        });
        
        document.addEventListener('mouseup', () => {
            document.body.classList.remove('cursor-active');
        });
    }

    // 3. Magnetic Button Interaction
    const magneticBtns = document.querySelectorAll('.magnetic');
    
    magneticBtns.forEach(btn => {
        btn.addEventListener('mousemove', function(e) {
            const position = this.getBoundingClientRect();
            const x = e.clientX - position.left - (position.width / 2);
            const y = e.clientY - position.top - (position.height / 2);
            
            // Pull the button slightly towards the cursor (magnetic pull)
            this.style.transform = `translate(${x * 0.35}px, ${y * 0.35}px)`;
            
            // Pull any inner text/icon inside the button even more for depth
            const inner = this.querySelector('.magnetic-inner');
            if (inner) {
                inner.style.transform = `translate(${x * 0.15}px, ${y * 0.15}px)`;
            }
        });
        
        btn.addEventListener('mouseleave', function() {
            // Reset transforms on exit
            this.style.transform = 'translate(0px, 0px)';
            const inner = this.querySelector('.magnetic-inner');
            if (inner) {
                inner.style.transform = 'translate(0px, 0px)';
            }
        });
    });
});
