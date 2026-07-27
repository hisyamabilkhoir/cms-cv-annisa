/* ==========================================================================
   ABYNS STUDIO - Interactive Three.js WebGL Backdrop
   ========================================================================== */

document.addEventListener('DOMContentLoaded', () => {
    const canvasContainer = document.getElementById('canvas-3d-bg');
    if (!canvasContainer) return;

    // Check if THREE is loaded
    if (typeof THREE === 'undefined') {
        console.warn('Three.js library is not loaded. 3D background disabled.');
        return;
    }

    // 1. Scene Setup
    const scene = new THREE.Scene();
    
    // Camera
    const camera = new THREE.PerspectiveCamera(60, canvasContainer.clientWidth / canvasContainer.clientHeight, 0.1, 100);
    camera.position.z = 7;

    // Renderer
    const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(canvasContainer.clientWidth, canvasContainer.clientHeight);
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.25;
    canvasContainer.appendChild(renderer.domElement);

    // 2. Add Floating Metallic Gold Ring (Luxury Centerpiece)
    let goldMesh;
    const createCenterpiece = () => {
        // Torus Knot creates a complex premium metallic wireframe shape
        const geometry = new THREE.TorusKnotGeometry(1.2, 0.4, 150, 20, 2, 3);
        const material = new THREE.MeshStandardMaterial({
            color: 0xd6b77a,        // Champagne Gold
            metalness: 0.95,        // Highly reflective metallic
            roughness: 0.1,         // Smooth polish
            wireframe: false,
        });

        goldMesh = new THREE.Mesh(geometry, material);
        scene.add(goldMesh);
    };
    createCenterpiece();

    // 3. Add Floating Gold Particles (Dust Field)
    let particleCount = 250;
    if (window.innerWidth < 768) particleCount = 100; // Optimize for mobile

    const particleGeometry = new THREE.BufferGeometry();
    const particlePositions = new Float32Array(particleCount * 3);

    for (let i = 0; i < particleCount * 3; i += 3) {
        // Spread particles randomly in a 3D box
        particlePositions[i] = (Math.random() - 0.5) * 15;     // X
        particlePositions[i + 1] = (Math.random() - 0.5) * 10; // Y
        particlePositions[i + 2] = (Math.random() - 0.5) * 10; // Z
    }

    particleGeometry.setAttribute('position', new THREE.BufferAttribute(particlePositions, 3));

    // Custom glowing particle dot texture
    const pMaterial = new THREE.PointsMaterial({
        color: 0xd6b77a,
        size: 0.05,
        transparent: true,
        opacity: 0.8,
        blending: THREE.AdditiveBlending,
    });

    const particles = new THREE.Points(particleGeometry, pMaterial);
    scene.add(particles);

    // 4. Luxury Studio Lighting
    // Ambient dark purple lighting
    const ambientLight = new THREE.AmbientLight(0x1a0a24, 0.6);
    scene.add(ambientLight);

    // Golden Directional Highlights
    const keyLight = new THREE.DirectionalLight(0xfff5e6, 3.5);
    keyLight.position.set(5, 5, 5);
    scene.add(keyLight);

    // Purple Point Glow Light
    const purpleLight = new THREE.PointLight(0x8a2be2, 5, 15);
    purpleLight.position.set(-4, -2, 2);
    scene.add(purpleLight);

    // 5. Mouse Interaction Tracking
    let mouseX = 0;
    let mouseY = 0;
    let targetX = 0;
    let targetY = 0;

    document.addEventListener('mousemove', (event) => {
        // Normalize mouse positions between -1 and 1
        mouseX = (event.clientX / window.innerWidth) * 2 - 1;
        mouseY = -(event.clientY / window.innerHeight) * 2 + 1;
    });

    // 6. Resizing Window
    window.addEventListener('resize', () => {
        camera.aspect = canvasContainer.clientWidth / canvasContainer.clientHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(canvasContainer.clientWidth, canvasContainer.clientHeight);
    });

    // 7. Animation Game Loop (60 FPS)
    const clock = new THREE.Clock();

    const animate = () => {
        const elapsedTime = clock.getElapsedTime();

        // Slowly rotate gold knot
        if (goldMesh) {
            goldMesh.rotation.y = elapsedTime * 0.12;
            goldMesh.rotation.x = elapsedTime * 0.08;

            // Apply interactive mouse tilt (lerped for smoothness)
            targetX = mouseX * 0.65;
            targetY = mouseY * 0.65;
            
            goldMesh.position.x += (targetX - goldMesh.position.x) * 0.05;
            goldMesh.position.y += (targetY - goldMesh.position.y) * 0.05;
            
            goldMesh.rotation.z += (targetX * 0.5 - goldMesh.rotation.z) * 0.05;
        }

        // Drifting particles animation
        const positions = particles.geometry.attributes.position.array;
        for (let i = 1; i < positions.length; i += 3) {
            positions[i] -= 0.002; // slow fall
            if (positions[i] < -5) {
                positions[i] = 5; // wrap around
            }
        }
        particles.geometry.attributes.position.needsUpdate = true;
        particles.rotation.y = elapsedTime * 0.02;

        // Render scene
        renderer.render(scene, camera);
        requestAnimationFrame(animate);
    };

    animate();
});
