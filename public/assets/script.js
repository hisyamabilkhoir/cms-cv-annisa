(() => {
  const prefersReducedMotion = window.matchMedia(
    "(prefers-reduced-motion: reduce)",
  ).matches;

  const root = document.documentElement;

  const navbar = document.getElementById("navbar");
  const burger = document.getElementById("burger");
  const mobileMenu = document.getElementById("mobileMenu");
  const yearEl = document.getElementById("year");
  const scrollbarBar = document.getElementById("scrollbarBar");
  const toast = document.getElementById("toast");

  const projectsGrid = document.getElementById("projectsGrid");
  const filters = Array.from(document.querySelectorAll(".filter"));
  const projectSearch = document.getElementById("projectSearch");

  const themeToggle = document.getElementById("themeToggle");
  const themeToggleMobile = document.getElementById("themeToggleMobile");

  const themeIconMoon = document.getElementById("themeIconMoon");
  const themeIconSun = document.getElementById("themeIconSun");
  const fabTheme = document.getElementById("fabTheme");
  const fabMoon = document.getElementById("fabMoon");
  const fabSun = document.getElementById("fabSun");

  const modal = document.getElementById("modal");
  const modalTitle = document.getElementById("modalTitle");
  const modalTag = document.getElementById("modalTag");
  const modalDesc = document.getElementById("modalDesc");
  const modalOutcomeBtn = document.getElementById("modalOutcomeBtn");
  const modalOutcomeText = document.getElementById("modalOutcomeText");

  // TODO: Ganti link kamu di sini
  const LINKS = window.LINKS || {
    instagram: "https://www.instagram.com/annisaesce/",
    tiktok: "https://www.tiktok.com/@annisaesce",
    youtube: "https://www.youtube.com/@AnnisaHanif",
    email: "mailto:annisahanif161@gmail.com",
    whatsapp:
      "https://wa.me/6289519561589?text=Halo%20saya%20mau%20collab%20untuk%20project%20konten.",
  };

  // set links
  const linkIG = document.getElementById("linkIG");
  const linkTT = document.getElementById("linkTT");
  const linkYT = document.getElementById("linkYT");
  const linkEmail = document.getElementById("linkEmail");
  const whatsappBtn = document.getElementById("whatsappBtn");

  linkIG && (linkIG.href = LINKS.instagram);
  linkTT && (linkTT.href = LINKS.tiktok);
  linkYT && (linkYT.href = LINKS.youtube);
  linkEmail && (linkEmail.href = LINKS.email);
  whatsappBtn && (whatsappBtn.href = LINKS.whatsapp);

  const fabWhatsApp = document.getElementById("fabWhatsApp");
  const fabInstagram = document.getElementById("fabInstagram");
  const fabTikTok = document.getElementById("fabTikTok");

  fabWhatsApp && (fabWhatsApp.href = LINKS.whatsapp);
  fabInstagram && (fabInstagram.href = LINKS.instagram);
  fabTikTok && (fabTikTok.href = LINKS.tiktok);

  yearEl && (yearEl.textContent = String(new Date().getFullYear()));

  // CV download (validasi dummy)
  const cvBtn = document.getElementById("downloadCV");
  if (cvBtn) {
    cvBtn.addEventListener("click", (e) => {
      const href = cvBtn.getAttribute("href"); // contoh: "cv annisa.pdf"
      if (!href || href === "#" || href.includes("test.pdf")) {
        e.preventDefault();
        showToast("Taruh file CV kamu (mis. cv.pdf), lalu ubah link-nya.");
        return;
      }
      // biar kebuka tab baru kalau file bener
      cvBtn.setAttribute("target", "_blank");
      cvBtn.setAttribute("rel", "noopener");
    });
  }

  // THEME
  function systemTheme() {
    return window.matchMedia("(prefers-color-scheme: light)").matches
      ? "light"
      : "dark";
  }

  function updateThemeIcons(theme) {
    const isLight = theme === "light";
    themeIconMoon && themeIconMoon.classList.toggle("hidden", isLight);
    themeIconSun && themeIconSun.classList.toggle("hidden", !isLight);
    fabMoon && fabMoon.classList.toggle("hidden", isLight);
    fabSun && fabSun.classList.toggle("hidden", !isLight);
  }

  function setTheme(theme) {
    root.setAttribute("data-theme", theme);
    localStorage.setItem("theme", theme);
    updateThemeIcons(theme);
  }

  function initTheme() {
    const saved = localStorage.getItem("theme");
    setTheme(saved || systemTheme());
  }

  function toggleTheme() {
    const cur = root.getAttribute("data-theme") || "dark";
    setTheme(cur === "dark" ? "light" : "dark");
  }

  initTheme();
  themeToggle && themeToggle.addEventListener("click", toggleTheme);
  themeToggleMobile && themeToggleMobile.addEventListener("click", toggleTheme);
  fabTheme && fabTheme.addEventListener("click", toggleTheme);

  // Mobile menu
  const setMobileOpen = (open) => {
    if (!burger || !mobileMenu) return;
    burger.setAttribute("aria-expanded", open ? "true" : "false");
    mobileMenu.classList.toggle("open", open);
    mobileMenu.setAttribute("aria-hidden", open ? "false" : "true");
  };

  burger &&
    burger.addEventListener("click", () =>
      setMobileOpen(!mobileMenu.classList.contains("open")),
    );
  mobileMenu &&
    mobileMenu.addEventListener("click", (e) => {
      const t = e.target;
      if (t && t.matches("[data-close]")) setMobileOpen(false);
    });

  // Navbar + progress bar
  const onScroll = () => {
    const y = window.scrollY || document.documentElement.scrollTop;
    navbar && navbar.classList.toggle("scrolled", y > 8);

    const doc = document.documentElement;
    const scrollMax = doc.scrollHeight - doc.clientHeight || 1;
    const pct = Math.min(1, Math.max(0, y / scrollMax));
    scrollbarBar && (scrollbarBar.style.width = (pct * 100).toFixed(2) + "%");
  };
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  // Reveal
  const revealEls = Array.from(document.querySelectorAll(".reveal"));
  if (!prefersReducedMotion) {
    const rev = new IntersectionObserver(
      (entries) => {
        entries.forEach((en) => {
          if (en.isIntersecting) {
            en.target.classList.add("is-visible");
            rev.unobserve(en.target);
          }
        });
      },
      { threshold: 0.12 },
    );
    revealEls.forEach((el) => rev.observe(el));
  } else {
    revealEls.forEach((el) => el.classList.add("is-visible"));
  }

  // =========================
  // THUMBNAIL (UNIK PER PROJECT)
  // =========================
  function hashStr(str) {
    // hash kecil biar warna beda-beda
    str = String(str || "");
    let h = 2166136261; // FNV-ish
    for (let i = 0; i < str.length; i++) {
      h ^= str.charCodeAt(i);
      h = Math.imul(h, 16777619);
    }
    return h >>> 0;
  }

  function pick(arr, idx) {
    return arr[idx % arr.length];
  }

  function thumbPlaceholder(label, seed) {
    const safe = String(label || "Project")
      .slice(0, 20)
      .replace(/[<>&]/g, "");
    const h = hashStr(seed || label || safe);

    const g1 = [
      "#22d3ee",
      "#a78bfa",
      "#34d399",
      "#fb7185",
      "#60a5fa",
      "#fbbf24",
    ];
    const g2 = [
      "#7c3aed",
      "#06b6d4",
      "#10b981",
      "#f43f5e",
      "#2563eb",
      "#f97316",
    ];
    const c1 = pick(g1, h);
    const c2 = pick(g2, h >> 3);
    const dot = pick(
      ["#fb7185", "#fbbf24", "#60a5fa", "#34d399", "#a78bfa"],
      h >> 6,
    );

    const svg = `<svg xmlns="http://www.w3.org/2000/svg" width="1200" height="700">
        <defs>
          <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
            <stop stop-color="${c1}" stop-opacity=".60"/>
            <stop offset="1" stop-color="${c2}" stop-opacity=".60"/>
          </linearGradient>
        </defs>
        <rect width="1200" height="700" fill="#05060d"/>
        <rect width="1200" height="700" fill="url(#bg)" opacity=".35"/>
        <circle cx="980" cy="180" r="140" fill="${dot}" opacity=".18"/>
        <text x="60" y="360" fill="white" font-size="54" font-family="Arial" opacity=".92">${safe}</text>
      </svg>`;

    return `data:image/svg+xml;charset=utf-8,${encodeURIComponent(svg)}`;
  }

  // Projects
  const PROJECTS =
    window.PROJECTS ||
    [
      {
        id: "p1",
        platform: "travel",
        title: "Video Tips and trick traveling",
        desc: "Konten travel edukatif yang dikemas ringkas dan engaging untuk audiens digital. Mengubah perencanaan perjalanan yang kompleks menjadi visual storytelling yang mudah dipahami, informatif, dan menarik.",
        views: "±101.157",
        ctr: "",
        outcome:
          "https://www.instagram.com/triptracker.id?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==",
        bullets: [
          "Scriptwriting, menyusun konsep, alur cerita, dan hook konten.",
          "Talent, tampil sebagai host untuk penyampaian informasi yang relatable.",
          "Cinematography, pengambilan gambar travel & ambience lokasi.",
          "Video editing, pacing dinamis, text sync, dan visual clarity.",
        ],
        tag: "Scripter + Talent + Cameraman + Video Editor",
        thumb: "assets/triptracker.jpeg",
        youtube: "https://www.youtube.com/embed/dQw4w9WgXcQ", // Example link
      },
      {
        id: "p2",
        platform: "f&b",
        title: "F&B",
        desc: "Konten visual F&B yang dirancang untuk meningkatkan daya tarik brand dan engagement audiens. Menggabungkan visual yang appetizing, desain yang kuat, dan storytelling singkat agar pesan brand tersampaikan cepat dan efektif.",
        views: "±105.827",
        ctr: "",
        outcome: "https://www.instagram.com/officialchickenmaster/",
        bullets: [
          "Food & brand photography",
          "Poster & visual design untuk kebutuhan promosi",
          "Video shooting (produk, ambience, activity)",
          "Video editing (pacing cepat, text sync, clean look)",
          "Social media management, perencanaan konten & visual feed",
        ],
        tag: "Photographer + Designer + Cameraman + Video Editor + Social Media Handler",
        thumb: "assets/f&b-1.jpeg",
        images: ["assets/f&b-1.jpeg", "assets/f&b-2.jpeg", "assets/f&b-3.jpeg"], // Slider Example
      },
      {
        id: "p3",
        platform: "f&b",
        title: "F&B",
        desc: "Konten visual F&B yang dirancang untuk meningkatkan daya tarik brand dan engagement audiens. Menggabungkan visual yang appetizing, desain yang kuat, dan storytelling singkat agar pesan brand tersampaikan cepat dan efektif.",
        views: "±105.827",
        ctr: "",
        outcome: "https://www.instagram.com/officialchickenmaster/",
        bullets: [
          "Food & brand photography",
          "Poster & visual design untuk kebutuhan promosi",
          "Video shooting (produk, ambience, activity)",
          "Video editing (pacing cepat, text sync, clean look)",
          "Social media management, perencanaan konten & visual feed",
        ],
        tag: "Photographer + Designer + Cameraman + Video Editor + Social Media Handler",
        thumb: "assets/f&b-2.jpeg",
      },
      {
        id: "p4",
        platform: "f&b",
        title: "F&B",
        desc: "Konten visual F&B yang dirancang untuk meningkatkan daya tarik brand dan engagement audiens. Menggabungkan visual yang appetizing, desain yang kuat, dan storytelling singkat agar pesan brand tersampaikan cepat dan efektif.",
        views: "±105.827",
        ctr: "",
        outcome: "https://www.instagram.com/officialchickenmaster/",
        bullets: [
          "Food & brand photography",
          "Poster & visual design untuk kebutuhan promosi",
          "Video shooting (produk, ambience, activity)",
          "Video editing (pacing cepat, text sync, clean look)",
          "Social media management, perencanaan konten & visual feed",
        ],
        tag: "Photographer + Designer + Cameraman + Video Editor + Social Media Handler",
        thumb: "assets/f&b-3.jpeg",
      },
      {
        id: "p5",
        platform: "fashion",
        title: "Photoshoot",
        desc: "Produksi visual fashion yang menonjolkan karakter produk dan identitas brand. Setiap sesi photoshoot dirancang untuk menghasilkan visual yang rapi, estetik, dan siap digunakan untuk kebutuhan promosi digital.",
        views: "",
        ctr: "",
        outcome: "https://www.instagram.com/shaff.wear/",
        bullets: [
          "Fashion photography, pemilihan angle, pose, dan lighting.",
          "Poster & visual design, layout promosi yang konsisten dengan brand.",
          "Photo editing, color grading, retouching, dan mood adjustment.",
          "Content-ready output untuk media sosial dan campaign.",
        ],
        tag: "Photographer + Poster Designer + Photo Editor",
        thumb: "assets/fashion-1.jpeg",
      },
      {
        id: "p6",
        platform: "fashion",
        title: "Photoshoot",
        desc: "Produksi visual fashion yang menonjolkan karakter produk dan identitas brand. Setiap sesi photoshoot dirancang untuk menghasilkan visual yang rapi, estetik, dan siap digunakan untuk kebutuhan promosi digital.",
        views: "",
        ctr: "",
        outcome: "https://www.instagram.com/shaff.wear/",
        bullets: [
          "Fashion photography, pemilihan angle, pose, dan lighting.",
          "Poster & visual design, layout promosi yang konsisten dengan brand.",
          "Photo editing, color grading, retouching, dan mood adjustment.",
          "Content-ready output untuk media sosial dan campaign.",
        ],
        tag: "Photographer + Poster Designer + Photo Editor",
        thumb: "assets/fashion-2.jpeg",
      },
      {
        id: "p7",
        platform: "logo",
        title: "Desain Logo 3D",
        desc: "Desain logo 3D yang menonjolkan identitas brand secara modern dan profesional. Setiap logo dirancang dengan kedalaman visual, proporsi yang presisi, dan karakter yang kuat agar tampil menonjol di berbagai media.",
        views: "",
        ctr: "",
        outcome: "",
        bullets: [
          "3D logo design, konsep, bentuk, dan visual depth.",
          "Brand interpretation, menerjemahkan nilai brand ke bentuk visual.",
          "Lighting & material styling untuk kesan premium",
          "Final asset preparation untuk kebutuhan digital & promosi",
        ],
        tag: "3D Logo Designer",
        thumb: "assets/d-logo-1.jpeg",
      },
      {
        id: "p8",
        platform: "f&b",
        title: "F&B",
        desc: "Konten visual F&B yang dirancang untuk meningkatkan daya tarik brand dan engagement audiens. Menggabungkan visual yang appetizing, desain yang kuat, dan storytelling singkat agar pesan brand tersampaikan cepat dan efektif.",
        views: "",
        ctr: "",
        outcome: "https://www.instagram.com/jackhoward.id/",
        bullets: [
          "Food & brand photography",
          "Poster & visual design untuk kebutuhan promosi",
          "Video shooting (produk, ambience, activity)",
          "Video editing (pacing cepat, text sync, clean look)",
          "Social media management, perencanaan konten & visual feed",
        ],
        tag: "Photographer + Designer + Cameraman + Video Editor + Social Media Handler",
        thumb: "assets/f&b-4.jpeg",
      },
      {
        id: "p9",
        platform: "f&b",
        title: "F&B",
        desc: "Konten visual F&B yang dirancang untuk meningkatkan daya tarik brand dan engagement audiens. Menggabungkan visual yang appetizing, desain yang kuat, dan storytelling singkat agar pesan brand tersampaikan cepat dan efektif.",
        views: "",
        ctr: "",
        outcome: "https://www.instagram.com/jackhoward.id/",
        bullets: [
          "Food & brand photography",
          "Poster & visual design untuk kebutuhan promosi",
          "Video shooting (produk, ambience, activity)",
          "Video editing (pacing cepat, text sync, clean look)",
          "Social media management, perencanaan konten & visual feed",
        ],
        tag: "Photographer + Designer + Cameraman + Video Editor + Social Media Handler",
        thumb: "assets/f&b-5.jpeg",
      },
      {
        id: "p10",
        platform: "f&b",
        title: "F&B",
        desc: "Konten visual F&B yang dirancang untuk meningkatkan daya tarik brand dan engagement audiens. Menggabungkan visual yang appetizing, desain yang kuat, dan storytelling singkat agar pesan brand tersampaikan cepat dan efektif.",
        views: "",
        ctr: "",
        outcome: "https://www.instagram.com/jackhoward.id/",
        bullets: [
          "Food & brand photography",
          "Poster & visual design untuk kebutuhan promosi",
          "Video shooting (produk, ambience, activity)",
          "Video editing (pacing cepat, text sync, clean look)",
          "Social media management, perencanaan konten & visual feed",
        ],
        tag: "Photographer + Designer + Cameraman + Video Editor + Social Media Handler",
        thumb: "assets/f&b-6.jpeg",
      },
      {
        id: "p11",
        platform: "product",
        title: "Produk",
        desc: "Produksi konten produk yang dirancang untuk kebutuhan promosi digital dan social media. Menggabungkan visual produk yang kuat, desain poster yang informatif, serta video reels yang dinamis untuk meningkatkan daya tarik dan engagement audiens.",
        views: "",
        ctr: "",
        outcome: "https://www.instagram.com/828souvenirspecialist/",
        bullets: [
          "Product photography, detail, tekstur, dan visual produk.",
          "Social media poster design, layout informatif & eye catching",
          "Video reels editing, pacing cepat, text sync, dan hook visual.",
          "Content optimization untuk kebutuhan platform digital",
        ],
        tag: "Photographer + Social Media Designer + Reels Video Editor",
        thumb: "assets/product-1.jpeg",
      },
      {
        id: "p12",
        platform: "product",
        title: "Produk",
        desc: "Produksi konten produk yang dirancang untuk kebutuhan promosi digital dan social media. Menggabungkan visual produk yang kuat, desain poster yang informatif, serta video reels yang dinamis untuk meningkatkan daya tarik dan engagement audiens.",
        views: "",
        ctr: "",
        outcome: "https://www.instagram.com/828souvenirspecialist/",
        bullets: [
          "Product photography, detail, tekstur, dan visual produk.",
          "Social media poster design, layout informatif & eye catching",
          "Video reels editing, pacing cepat, text sync, dan hook visual.",
          "Content optimization untuk kebutuhan platform digital",
        ],
        tag: "Photographer + Social Media Designer + Reels Video Editor",
        thumb: "assets/product-2.jpeg",
      },
      {
        id: "p13",
        platform: "product",
        title: "Produk",
        desc: "Produksi konten produk yang dirancang untuk kebutuhan promosi digital dan social media. Menggabungkan visual produk yang kuat, desain poster yang informatif, serta video reels yang dinamis untuk meningkatkan daya tarik dan engagement audiens.",
        views: "",
        ctr: "",
        outcome: "https://www.instagram.com/828souvenirspecialist/",
        bullets: [
          "Product photography, detail, tekstur, dan visual produk.",
          "Social media poster design, layout informatif & eye catching",
          "Video reels editing, pacing cepat, text sync, dan hook visual.",
          "Content optimization untuk kebutuhan platform digital",
        ],
        tag: "Photographer + Social Media Designer + Reels Video Editor",
        thumb: "assets/product-3.jpeg",
      },
      {
        id: "p14",
        platform: "event",
        title: "Event",
        desc: "Dokumentasi event yang menangkap momen utama, emosi, dan atmosfer acara secara utuh. Visual dirancang rapi dan fokus agar setiap momen penting tersampaikan jelas dan bernilai untuk kebutuhan publikasi.",
        views: "",
        ctr: "",
        outcome: "",
        bullets: [
          "Event photography, menangkap momen, ekspresi, dan suasana acara.",
          "Visual selection, kurasi foto terbaik sesuai alur event.",
          "Photo editing, color, lighting, dan mood adjustment.",
          "Story-driven layout untuk dokumentasi dan promosi",
        ],
        tag: "Photographer + Editor",
        thumb: "assets/event-1.jpeg",
      },
      {
        id: "p15",
        platform: "event",
        title: "Event",
        desc: "Dokumentasi event yang menangkap momen utama, emosi, dan atmosfer acara secara utuh. Visual dirancang rapi dan fokus agar setiap momen penting tersampaikan jelas dan bernilai untuk kebutuhan publikasi.",
        views: "",
        ctr: "",
        outcome: "",
        bullets: [
          "Event photography, menangkap momen, ekspresi, dan suasana acara.",
          "Visual selection, kurasi foto terbaik sesuai alur event.",
          "Photo editing, color, lighting, dan mood adjustment.",
          "Story-driven layout untuk dokumentasi dan promosi",
        ],
        tag: "Photographer + Editor",
        thumb: "assets/event-2.jpeg",
      },
      {
        id: "p16",
        platform: "event",
        title: "Event",
        desc: "Dokumentasi dan konsep visual event yang dirancang untuk menangkap momen, emosi, dan tema acara secara menyeluruh. Mulai dari perencanaan konsep hingga hasil visual akhir, setiap detail disusun agar acara terasa berkesan dan mudah dipublikasikan.",
        views: "",
        ctr: "",
        outcome: "https://www.instagram.com/jackhoward.id/",
        bullets: [
          "Event concept planning, anniversary & birthday party.",
          "Event photography, momen, ekspresi, dan suasana acara.",
          "Visual storytelling — menyusun alur dokumentasi event.",
          "Photo editing, color, lighting, dan mood adjustment.",
          "Content-ready output untuk kebutuhan publikasi.",
        ],
        tag: "Event Photographer + Editor + Concept Planner",
        thumb: "assets/event-3.jpeg",
      },
      {
        id: "p17",
        platform: "event",
        title: "Event",
        desc: "Dokumentasi dan konsep visual event yang dirancang untuk menangkap momen, emosi, dan tema acara secara menyeluruh. Mulai dari perencanaan konsep hingga hasil visual akhir, setiap detail disusun agar acara terasa berkesan dan mudah dipublikasikan.",
        views: "",
        ctr: "",
        outcome: "https://www.instagram.com/jackhoward.id/",
        bullets: [
          "Event concept planning, anniversary & birthday party.",
          "Event photography, momen, ekspresi, dan suasana acara.",
          "Visual storytelling — menyusun alur dokumentasi event.",
          "Photo editing, color, lighting, dan mood adjustment.",
          "Content-ready output untuk kebutuhan publikasi.",
        ],
        tag: "Event Photographer + Editor + Concept Planner",
        thumb: "assets/event-4.jpeg",
      },
      {
        id: "p18",
        platform: "event",
        title: "Event",
        desc: "Dokumentasi dan konsep visual event yang dirancang untuk menangkap momen, emosi, dan tema acara secara menyeluruh. Mulai dari perencanaan konsep hingga hasil visual akhir, setiap detail disusun agar acara terasa berkesan dan mudah dipublikasikan.",
        views: "",
        ctr: "",
        outcome: "https://www.instagram.com/jackhoward.id/",
        bullets: [
          "Event concept planning, anniversary & birthday party.",
          "Event photography, momen, ekspresi, dan suasana acara.",
          "Visual storytelling — menyusun alur dokumentasi event.",
          "Photo editing, color, lighting, dan mood adjustment.",
          "Content-ready output untuk kebutuhan publikasi.",
        ],
        tag: "Event Photographer + Editor + Concept Planner",
        thumb: "assets/event-5.jpeg",
      },
      {
        id: "p19",
        platform: "wedding",
        title: "Wedding",
        desc: "Dokumentasi pernikahan yang menangkap momen sakral, emosi, dan detail penting secara utuh. Setiap visual dirancang untuk bercerita, mulai dari persiapan hingga momen utama dengan hasil yang timeless dan berkesan.",
        views: "",
        ctr: "",
        outcome: "https://www.instagram.com/escepotrait/",
        bullets: [
          "Wedding photography, momen, detail, dan ekspresi emosional.",
          "Wedding videography, cinematic shots & storytelling",
          "Visual storytelling menyusun alur cerita hari pernikahan.",
          "Photo & video editing, color, tone, dan mood adjustment.",
        ],
        tag: "Photographer + Videographer + Editor",
        thumb: "assets/wedding-1.jpeg",
      },
      {
        id: "p20",
        platform: "property",
        title: "Property Visual Documentation",
        desc: "Menggabungkan fotografi arsitektur dan editing presisi untuk menyampaikan nilai ruang, skala, dan atmosfer secara jelas dan menarik bagi calon klien.",
        views: "",
        ctr: "",
        outcome: "",
        bullets: [
          "Property photography & visual detail.",
          "Photo & editing (clean, cinematic).",
        ],
        tag: "Photographer + Editor",
        thumb: "assets/property-1.jpeg",
      },

      {
        id: "p21",
        platform: "poster",
        title: "Poster Travel Umroh",
        desc: "Produksi konten promosi travel umroh yang informatif dan mudah dipahami. Setiap materi dirancang untuk menyampaikan informasi paket secara jelas, menarik, dan relevan bagi audiens digital.",
        views: "±263.783",
        ctr: "",
        outcome: "https://www.instagram.com/alfatih.umroh/",
        bullets: [
          "Poster design, layout informatif & visual yang rapi.",
          "Scriptwriting — menyusun narasi promosi yang singkat dan persuasif.",
          "Video reels editing, visual dinamis, text sync, dan hook awal",
          "Content optimization untuk media sosial.",
        ],
        tag: "Poster Designer + Scriptwriter + Reels Video Editor",
        thumb: "assets/poster-2.jpeg",
      },
      {
        id: "p22",
        platform: "poster",
        title: "Poster Travel Umroh",
        desc: "Produksi konten promosi travel umroh yang informatif dan mudah dipahami. Setiap materi dirancang untuk menyampaikan informasi paket secara jelas, menarik, dan relevan bagi audiens digital.",
        views: "±263.783",
        ctr: "",
        outcome: "https://www.instagram.com/alfatih.umroh/",
        bullets: [
          "Poster design, layout informatif & visual yang rapi.",
          "Scriptwriting — menyusun narasi promosi yang singkat dan persuasif.",
          "Video reels editing, visual dinamis, text sync, dan hook awal",
          "Content optimization untuk media sosial.",
        ],
        tag: "Poster Designer + Scriptwriter + Reels Video Editor",
        thumb: "assets/poster-1.jpeg",
      },
      {
        id: "p23",
        platform: "poster",
        title: "Poster Travel Umroh",
        desc: "Produksi konten promosi travel umroh yang informatif dan mudah dipahami. Setiap materi dirancang untuk menyampaikan informasi paket secara jelas, menarik, dan relevan bagi audiens digital.",
        views: "±263.783",
        ctr: "",
        outcome: "https://www.instagram.com/alfatih.umroh/",
        bullets: [
          "Poster design, layout informatif & visual yang rapi.",
          "Scriptwriting — menyusun narasi promosi yang singkat dan persuasif.",
          "Video reels editing, visual dinamis, text sync, dan hook awal",
          "Content optimization untuk media sosial.",
        ],
        tag: "Poster Designer + Scriptwriter + Reels Video Editor",
        thumb: "assets/poster-3.jpeg",
      },
      {
        id: "p24",
        platform: "motion",
        title: "Motion Logo Brand",
        desc: "Motion logo yang dirancang untuk memperkuat identitas brand secara visual. Setiap animasi dibuat dengan pendekatan clean dan modern agar logo terasa hidup, profesional, dan mudah dikenali di berbagai media digital.",
        views: "",
        ctr: "",
        outcome:
          "https://drive.google.com/file/d/1h3MG12XOVOeHS5jdztPg-1wuScLtb4HA/view?usp=drive_link",
        bullets: [
          "Logo design, konsep visual & identitas brand",
          "Motion design, animasi logo yang dinamis dan berkarakter",
          "Visual timing & easing untuk kesan profesional",
          "Final motion output untuk kebutuhan digital branding",
        ],
        tag: "Logo Designer + Motion Designer",
        thumb: "assets/motion-1.jpeg",
      },
      {
        id: "p25",
        platform: "motion",
        title: "Motion Logo Brand",
        desc: "Motion logo yang dirancang untuk memperkuat identitas brand secara visual. Setiap animasi dibuat dengan pendekatan clean dan modern agar logo terasa hidup, profesional, dan mudah dikenali di berbagai media digital.",
        views: "",
        ctr: "",
        outcome:
          "https://drive.google.com/file/d/18W1EWrClbwXMdVeTPbBkZFLlX4oH7FgE/view?usp=drive_link",
        bullets: [
          "Logo design, konsep visual & identitas brand",
          "Motion design, animasi logo yang dinamis dan berkarakter",
          "Visual timing & easing untuk kesan profesional",
          "Final motion output untuk kebutuhan digital branding",
        ],
        tag: "Logo Designer + Motion Designer",
        thumb: "assets/motion-2.jpeg",
      },
      {
        id: "p26",
        platform: "motion",
        title: "Motion Logo Brand",
        desc: "Motion logo yang dirancang untuk memperkuat identitas brand secara visual. Setiap animasi dibuat dengan pendekatan clean dan modern agar logo terasa hidup, profesional, dan mudah dikenali di berbagai media digital.",
        views: "",
        ctr: "",
        outcome:
          "https://drive.google.com/file/d/1cRI1AhToe7sm47wcNkFy9U_xry7jaPpv/view?usp=drive_link",
        bullets: [
          "Logo design, konsep visual & identitas brand",
          "Motion design, animasi logo yang dinamis dan berkarakter",
          "Visual timing & easing untuk kesan profesional",
          "Final motion output untuk kebutuhan digital branding",
        ],
        tag: "Logo Designer + Motion Designer",
        thumb: "assets/motion-3.jpeg",
      },
      {
        id: "p27",
        platform: "motion",
        title: "Motion Logo Brand",
        desc: "Motion logo yang dirancang untuk memperkuat identitas brand secara visual. Setiap animasi dibuat dengan pendekatan clean dan modern agar logo terasa hidup, profesional, dan mudah dikenali di berbagai media digital.",
        views: "",
        ctr: "",
        outcome:
          "https://drive.google.com/file/d/10mpA32zNgnma5K4aSVpw8Ny9bx5M6AMG/view?usp=drive_link",
        bullets: [
          "Logo design, konsep visual & identitas brand",
          "Motion design, animasi logo yang dinamis dan berkarakter",
          "Visual timing & easing untuk kesan profesional",
          "Final motion output untuk kebutuhan digital branding",
        ],
        tag: "Logo Designer + Motion Designer",
        thumb: "assets/motion-4.jpeg",
      },
      {
        id: "p28",
        platform: "property",
        title: "Property Video Editing",
        desc: "Editing video properti yang menampilkan ruang, alur, dan nilai jual secara jelas dan profesional. Setiap video dirancang untuk membantu audiens memahami properti dengan cepat dan menarik.",
        views: "",
        ctr: "",
        outcome:
          "https://drive.google.com/drive/folders/1kkMeiGAAmBj61-kowsHRhckeIqwl_CI1",
        bullets: [
          "Property video editing, alur ruang & visual clarity",
          "Footage selection, menonjolkan keunggulan properti",
          "Text & information overlay, informatif dan rapi",
          "Color & mood adjustment, konsisten dan profesional",
        ],
        tag: "Video Editor (Property)",
        thumb: "assets/property-2.jpeg",
      },
      {
        id: "p29",
        platform: "property",
        title: "Property Video Editing",
        desc: "Editing video properti yang menampilkan ruang, alur, dan nilai jual secara jelas dan profesional. Setiap video dirancang untuk membantu audiens memahami properti dengan cepat dan menarik.",
        views: "",
        ctr: "",
        outcome:
          "https://drive.google.com/drive/folders/1kkMeiGAAmBj61-kowsHRhckeIqwl_CI1",
        bullets: [
          "Property video editing, alur ruang & visual clarity",
          "Footage selection, menonjolkan keunggulan properti",
          "Text & information overlay, informatif dan rapi",
          "Color & mood adjustment, konsisten dan profesional",
        ],
        tag: "Video Editor (Property)",
        thumb: "assets/property-3.jpeg",
      },
      {
        id: "p30",
        platform: "vlog",
        title: "Travel Vlog Editing",
        desc: "Editing vlog perjalanan yang merangkum pengalaman, momen, dan suasana lokasi secara runtut dan engaging. Setiap video disusun dengan pacing yang tepat agar cerita perjalanan terasa hidup dan mudah dinikmati.",
        views: "",
        ctr: "",
        outcome:
          "https://drive.google.com/drive/folders/1kkMeiGAAmBj61-kowsHRhckeIqwl_CI1",
        bullets: [
          "Vlog editing, penyusunan alur cerita perjalanan",
          "Footage selection, memilih momen terbaik dari perjalanan",
          "Color & mood adjustment, menyamakan tone visual",
          "Text & music sync, memperkuat storytelling visual",
        ],
        tag: "Video Editor",
        thumb: "assets/vlog-1.jpeg",
      },
    ].map((p) => ({
      ...p,
      // kalau p.thumb kosong → auto placeholder unik per id
      thumb:
        p.thumb && String(p.thumb).trim()
          ? p.thumb
          : thumbPlaceholder(p.title, p.id),
    }));

  const platformLabel = (p) =>
    p === "property"
      ? "Property"
      : p === "travel"
        ? "Travel"
        : p === "f&b"
          ? "F&b"
          : p === "event"
            ? "Event"
            : p === "fashion"
              ? "Fashion"
              : p === "wedding"
                ? "Wedding"
                : p === "vlog"
                  ? "Vlog"
                  : p === "product"
                    ? "Product"
                    : p === "poster"
                      ? "Poster"
                      : p === "motion"
                        ? "Motion"
                        : p === "logo"
                          ? "Logo"
                          : "Platform";

  let activeFilter = "all";
  let query = "";
  let projectsSwiper = null;

  const mobileHighlightGrid = document.getElementById("mobileHighlightGrid");

  function renderProjects() {
    if (!projectsGrid) return;

    const q = query.trim().toLowerCase();
    const items = PROJECTS.filter((p) => {
      const matchesFilter =
        activeFilter === "all" || p.platform === activeFilter;
      const matchesQuery =
        !q ||
        p.title.toLowerCase().includes(q) ||
        p.desc.toLowerCase().includes(q);
      return matchesFilter && matchesQuery;
    });

    const navPrev = document.querySelector(".projects-nav-prev");
    const navNext = document.querySelector(".projects-nav-next");
    const pagination = document.querySelector(".projects-pagination");

    if (items.length === 0) {
      if (projectsSwiper) {
        projectsSwiper.destroy(true, true);
        projectsSwiper = null;
      }
      if (navPrev) navPrev.style.display = "none";
      if (navNext) navNext.style.display = "none";
      if (pagination) pagination.style.display = "none";

      // Target parent Swiper container too — it has overflow:hidden + controlled height
      const swiperContainer =
        projectsGrid.closest(".swiper") || projectsGrid.parentElement;
      if (swiperContainer) {
        swiperContainer.style.overflow = "visible";
        swiperContainer.style.height = "auto";
        swiperContainer.style.display = "flex";
        swiperContainer.style.justifyContent = "center";
        swiperContainer.style.padding = "20px 0";
      }

      projectsGrid.style.cssText =
        "display:flex !important; justify-content:center !important; width:100% !important; transform:none !important; height:auto !important;";
      projectsGrid.innerHTML = `
        <div style="opacity: 0.95; cursor: default; max-width: 320px; width: 100%; border-radius: 16px; overflow: hidden; background: var(--card, #1a1a2e); box-shadow: 0 8px 40px rgba(255,105,180,0.2);">
          <div style="background: linear-gradient(135deg, rgba(255,105,180,0.15) 0%, rgba(255,192,203,0.1) 100%); display: flex; flex-direction: column; align-items: center; justify-content: center; height: 260px; border-bottom: 1px solid rgba(255,105,180,0.25);">
            <span style="background: #ff69b4; color: white; font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; padding: 4px 12px; border-radius: 999px; margin-bottom: 24px;">Ongoing</span>
            <div style="text-align: center; color: #ff69b4; display: flex; flex-direction: column; align-items: center; gap: 10px;">
              <i class="bi bi-clock-history" style="font-size: 52px;"></i>
              <span style="font-size: 12px; font-weight: 700; letter-spacing: 3px; text-transform: uppercase; opacity: 0.8;">Coming Soon</span>
            </div>
          </div>
          <div style="text-align: center; padding: 28px 20px;">
            <h3 style="color: #ff69b4; font-family: serif; font-size: 22px; margin-bottom: 8px; font-style: italic;">Project Ongoing</h3>
            <p style="font-size: 13px; color: var(--muted, #aaa); line-height: 1.6;">Proyek baru sedang dalam proses pengerjaan.<br>Nantikan update menarik berikutnya! ✨</p>
          </div>
        </div>
      `;
      return;
    } else {
      if (navPrev) navPrev.style.display = "";
      if (navNext) navNext.style.display = "";
      if (pagination) pagination.style.display = "";

      // Reset parent Swiper container styles
      const swiperContainer =
        projectsGrid.closest(".swiper") || projectsGrid.parentElement;
      if (swiperContainer) {
        swiperContainer.style.overflow = "";
        swiperContainer.style.height = "";
        swiperContainer.style.display = "";
        swiperContainer.style.justifyContent = "";
        swiperContainer.style.padding = "";
      }

      projectsGrid.style.cssText = "";
      projectsGrid.innerHTML = items
        .map(
          (p) => `
        <div class="swiper-slide" onclick="openModal('${p.id}')">
          <div class="wp-project-card">
            <div class="wp-project-thumb">
              <span class="wp-project-tag">${platformLabel(p.platform)}</span>
              <img src="${escapeAttr(p.thumb)}" alt="${escapeAttr(p.title)}" loading="lazy" decoding="async">
            </div>
            <div class="wp-project-info">
              <h3>${escapeHtml(p.title)}</h3>
              <span class="year">2024</span>
              <div class="wp-project-actions-container">
                <div class="wp-project-action-circle">
                  <svg class="ico" aria-hidden="true" style="width:16px;height:16px;fill:none;stroke:currentColor;stroke-width:2;"><use href="#i-arrow-right"></use></svg>
                </div>
                <div class="wp-project-action-pill">
                  View Project &rarr;
                </div>
              </div>
            </div>
          </div>
        </div>
      `,
        )
        .join("");
    }

    if (projectsSwiper) {
      projectsSwiper.destroy(true, true);
    }

    // Allow DOM to update
    setTimeout(() => {
      if (document.querySelector(".projects-swiper")) {
        projectsSwiper = new Swiper(".projects-swiper", {
          effect: "coverflow",
          grabCursor: true,
          centeredSlides: true,
          slidesPerView: "auto",
          watchSlidesProgress: true,
          initialSlide: Math.min(2, Math.floor(items.length / 2)),
          coverflowEffect: {
            rotate: 0,
            stretch: 70,
            depth: 300,
            modifier: 1,
            slideShadows: false,
            scale: 0.9,
          },
          navigation: {
            nextEl: ".projects-nav-next",
            prevEl: ".projects-nav-prev",
          },
          pagination: {
            el: ".projects-pagination",
            clickable: true,
          },
        });
      }
    }, 50);
  }

  const portfolioFilters = Array.from(
    document.querySelectorAll(".portfolio-filter"),
  );
  portfolioFilters.forEach((btn) => {
    btn.addEventListener("click", () => {
      portfolioFilters.forEach((b) => {
        b.classList.toggle("active", b === btn);
        b.setAttribute("aria-selected", b === btn ? "true" : "false");
      });
      activeFilter = btn.dataset.filter || "all";
      renderProjects();
    });
  });

  if (projectSearch) {
    projectSearch.addEventListener("input", (e) => {
      query = e.target.value || "";
      renderProjects();
    });
  }

  renderProjects();

  // Modal
  const openModal = (id) => {
    const p = PROJECTS.find((x) => x.id === id);
    if (!p || !modal) return;

    if (modalTag) {
      modalTag.textContent = platformLabel(p.platform);
      modalTag.className = "modal__tag tag " + p.platform;
    }

    modalTitle.textContent = p.title;
    modalDesc.textContent = p.desc;

    const modalBullets = document.getElementById("modalBullets");
    if (modalBullets) {
      modalBullets.innerHTML = "";
      if (p.bullets && p.bullets.length > 0) {
        p.bullets.forEach((bullet) => {
          if (bullet && String(bullet).trim() !== "") {
            const li = document.createElement("li");
            li.style.cssText =
              "display: flex; align-items: center; gap: 10px; font-size: 14px; color: var(--text); background: rgba(255, 105, 180, 0.08); padding: 9px 14px; border-radius: 12px; border: 1px solid rgba(255, 105, 180, 0.2);";
            li.innerHTML = `<span style="color:#ff69b4; font-weight:bold; font-size:15px; line-height:1;">✓</span> <span>${bullet}</span>`;
            modalBullets.appendChild(li);
          }
        });
        modalBullets.style.display = "flex";
      } else {
        modalBullets.style.display = "none";
      }
    }

    if (modalOutcomeBtn && modalOutcomeText) {
      if (p.outcome && String(p.outcome).trim() !== "") {
        modalOutcomeBtn.href = p.outcome;
        modalOutcomeBtn.target = "_blank";
        modalOutcomeBtn.removeAttribute("data-close-modal");
        modalOutcomeText.textContent = "Lihat Project";
      } else {
        modalOutcomeBtn.href = "#contact";
        modalOutcomeBtn.removeAttribute("target");
        modalOutcomeText.textContent = "Start a Project";
      }
    }

    const mainMedia = document.getElementById("mainMedia");
    const thumbnailGalleryWrapper = document.getElementById(
      "thumbnailGalleryWrapper"
    );
    const thumbnailGallery = document.getElementById("thumbnailGallery");
    const sliderPrev = document.getElementById("sliderPrev");
    const sliderNext = document.getElementById("sliderNext");

    if (mainMedia) {
      mainMedia.innerHTML = "";
      if (thumbnailGallery) thumbnailGallery.innerHTML = "";

      // Build unified media items list
      const mediaList = [];

      // 1. If project has main youtube video, add as first item
      if (p.youtube && String(p.youtube).trim() !== "") {
        mediaList.push({
          type: "youtube",
          youtube_url: p.youtube,
          thumb: p.thumb
        });
      }

      // 2. Add all items from p.gallery (new dedicated Galeri Proyek entries)
      if (p.gallery && p.gallery.length > 0) {
        p.gallery.forEach((g) => {
          if (g.media_type === "youtube") {
            mediaList.push({
              type: "youtube",
              youtube_url: g.youtube_url,
              thumb: g.thumb || p.thumb
            });
          } else {
            mediaList.push({
              type: "image",
              src: g.src || g.thumb,
              thumb: g.thumb || g.src
            });
          }
        });
      } else if (p.images && p.images.length > 0) {
        p.images.forEach((imgUrl) => {
          mediaList.push({
            type: "image",
            src: imgUrl,
            thumb: imgUrl
          });
        });
      }

      // 3. Fallback if mediaList is empty: use p.thumb as image
      if (mediaList.length === 0) {
        mediaList.push({
          type: "image",
          src: p.thumb,
          thumb: p.thumb
        });
      }

      const renderMain = (idx) => {
        const item = mediaList[idx] || mediaList[0];
        mainMedia.innerHTML = "";

        if (item.type === "youtube") {
          mainMedia.innerHTML = `
             <img src="${item.thumb}" alt="Video Cover" style="width:100%; height:100%; object-fit:cover; cursor:pointer;">
             <div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; background:rgba(0,0,0,0.35); cursor:pointer;">
               <div style="width:64px; height:64px; background:#ff4081; border-radius:50%; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 14px rgba(0,0,0,0.3);">
                 <svg style="width:32px; height:32px; fill:white; margin-left:4px;" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg>
               </div>
             </div>
           `;
          mainMedia.onclick = () => {
            mainMedia.innerHTML = `<iframe src="${item.youtube_url}?autoplay=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen style="width:100%; height:100%; border:none;"></iframe>`;
            mainMedia.onclick = null;
          };
        } else {
          mainMedia.onclick = null;
          mainMedia.innerHTML = `<img src="${item.src}" alt="" loading="lazy" style="width:100%; height:100%; object-fit:cover;">`;
        }
      };

      if (mediaList.length > 1) {
        if (thumbnailGalleryWrapper)
          thumbnailGalleryWrapper.style.display = "flex";

        mediaList.forEach((item, idx) => {
          const thumbEl = document.createElement("div");
          thumbEl.className = "thumbnail";
          thumbEl.dataset.idx = idx;

          if (item.type === "youtube") {
            thumbEl.innerHTML = `<img src="${item.thumb}" alt="Video"><div style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; background:rgba(0,0,0,0.35);"><svg style="width:18px;height:18px;fill:white;margin-left:2px;" viewBox="0 0 24 24"><path d="M8 5v14l11-7z"/></svg></div>`;
          } else {
            thumbEl.innerHTML = `<img src="${item.thumb}" alt="" loading="lazy">`;
          }

          thumbEl.onclick = () => {
            window.currentSlide = idx;
            window.updateSlider();
          };

          if (thumbnailGallery) thumbnailGallery.appendChild(thumbEl);
        });

        window.currentSlide = 0;
        window.maxSlides = mediaList.length;

        window.updateSlider = () => {
          renderMain(window.currentSlide);
          if (thumbnailGallery) {
            Array.from(thumbnailGallery.children).forEach((el) => {
              const elIdx = parseInt(el.dataset.idx, 10);
              el.classList.toggle("active", elIdx === window.currentSlide);
              if (elIdx === window.currentSlide) {
                el.scrollIntoView({
                  behavior: "smooth",
                  block: "nearest",
                  inline: "center",
                });
              }
            });
          }
        };

        window.updateSlider();
      } else {
        if (thumbnailGalleryWrapper)
          thumbnailGalleryWrapper.style.display = "none";
        renderMain(0);
      }
    }

    modal.classList.add("open");
    modal.setAttribute("aria-hidden", "false");
    document.body.style.overflow = "hidden";

    navbar.classList.add("hide");
    mobileMenu && mobileMenu.classList.remove("open");
    mobileMenu && mobileMenu.classList.add("hide");
  };
  window.openModal = openModal;

  const closeModal = () => {
    if (!modal) return;
    modal.classList.remove("open");
    modal.setAttribute("aria-hidden", "true");
    document.body.style.overflow = "";

    navbar.classList.remove("hide");
    mobileMenu && mobileMenu.classList.remove("hide");

    // Stop YouTube video on close
    const mainMedia = document.getElementById("mainMedia");
    if (mainMedia) {
      mainMedia.innerHTML = "";
    }
  };

  modal &&
    modal.addEventListener("click", (e) => {
      const t = e.target;
      if (t && t.matches("[data-close-modal]")) closeModal();
    });

  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && modal && modal.classList.contains("open"))
      closeModal();
  });

  // Slider Global Listeners
  const sliderPrev = document.getElementById("sliderPrev");
  const sliderNext = document.getElementById("sliderNext");
  const thumbnailGallery = document.getElementById("thumbnailGallery");

  if (sliderPrev) {
    sliderPrev.addEventListener("click", () => {
      if (window.currentSlide > 0) {
        window.currentSlide--;
        if (window.updateSlider) window.updateSlider();
      }
    });
  }

  if (sliderNext) {
    sliderNext.addEventListener("click", () => {
      if (window.currentSlide < window.maxSlides - 1) {
        window.currentSlide++;
        if (window.updateSlider) window.updateSlider();
      }
    });
  }

  if (thumbnailGallery) {
    thumbnailGallery.addEventListener("click", (e) => {
      const thumb = e.target.closest(".thumbnail");
      if (thumb) {
        window.currentSlide = parseInt(thumb.dataset.idx, 10);
        if (window.updateSlider) window.updateSlider();
      }
    });
  }

  // Contact form (Formspree)
  const contactForm = document.getElementById("contactForm");

  if (contactForm) {
    contactForm.addEventListener("submit", async (e) => {
      e.preventDefault();

      const fd = new FormData(contactForm);
      const name = (fd.get("name") || "").toString().trim();

      // WAJIB: ganti dengan endpoint formspree kamu
      const FORMSPREE_URL = "https://formspree.io/f/xeeoyydw";

      try {
        const res = await fetch(FORMSPREE_URL, {
          method: "POST",
          body: fd,
          headers: { Accept: "application/json" },
        });

        if (res.ok) {
          showToast(`Makasih, ${name || "kak"}! Pesan kamu sudah terkirim ✅`);
          contactForm.reset();
        } else {
          const data = await res.json().catch(() => ({}));
          showToast(data?.error || "Gagal mengirim pesan. Coba lagi ya.");
        }
      } catch (err) {
        showToast("Koneksi bermasalah. Coba lagi ya.");
      }
    });
  }

  // Toast
  let toastTimer = null;
  function showToast(msg) {
    if (!toast) return;
    toast.textContent = msg;
    toast.classList.add("show");
    clearTimeout(toastTimer);
    toastTimer = setTimeout(() => toast.classList.remove("show"), 2400);
  }

  // 3D Tilt
  function initTiltWithin(rootEl = document) {
    const nodes = Array.from(rootEl.querySelectorAll("[data-tilt]"));
    nodes.forEach((el) => {
      if (el.__tiltBound) return;
      el.__tiltBound = true;

      // Simpan transform awal (kalau ada) supaya efek tilt tidak "nimpah" positioning.
      // Ini penting untuk elemen yang memang butuh transform bawaan (mis. dulu modal pakai translate untuk center).
      const baseTransform =
        el.dataset.tiltBaseTransform != null
          ? el.dataset.tiltBaseTransform
          : el.style.transform || "";
      el.dataset.tiltBaseTransform = baseTransform;

      const strength = clamp(
        parseFloat(el.dataset.tiltStrength || "12"),
        4,
        22,
      );
      let raf = null;

      const onMove = (ev) => {
        const rect = el.getBoundingClientRect();
        const x = (ev.clientX - rect.left) / rect.width;
        const y = (ev.clientY - rect.top) / rect.height;
        const rx = (0.5 - y) * strength;
        const ry = (x - 0.5) * strength;

        if (raf) cancelAnimationFrame(raf);
        raf = requestAnimationFrame(() => {
          const base = baseTransform ? baseTransform + " " : "";
          el.style.transform =
            base +
            `perspective(900px) rotateX(${rx.toFixed(2)}deg) rotateY(${ry.toFixed(2)}deg) translateZ(0)`;
          el.style.willChange = "transform";
        });
      };

      const onLeave = () => {
        if (raf) cancelAnimationFrame(raf);
        el.style.transform = baseTransform || "";
        el.style.willChange = "";
      };

      el.addEventListener("mousemove", onMove);
      el.addEventListener("mouseleave", onLeave);
      el.addEventListener("touchstart", onLeave, { passive: true });
    });
  }

  if (!prefersReducedMotion) initTiltWithin(document);

  // Parallax blobs
  const blobA = document.querySelector(".blob--a");
  const blobB = document.querySelector(".blob--b");
  const blobC = document.querySelector(".blob--c");

  if (!prefersReducedMotion && blobA && blobB && blobC) {
    let mx = 0,
      my = 0;
    let scheduled = false;

    function apply() {
      scheduled = false;
      const tx = mx,
        ty = my;
      blobA.style.transform = `translate3d(${(tx * 36).toFixed(2)}px, ${(ty * 28).toFixed(2)}px, 0)`;
      blobB.style.transform = `translate3d(${(-tx * 40).toFixed(2)}px, ${(ty * 22).toFixed(2)}px, 0)`;
      blobC.style.transform = `translate3d(${(tx * 28).toFixed(2)}px, ${(-ty * 30).toFixed(2)}px, 0)`;
    }

    window.addEventListener(
      "mousemove",
      (e) => {
        mx = e.clientX / window.innerWidth - 0.5;
        my = e.clientY / window.innerHeight - 0.5;
        if (!scheduled) {
          scheduled = true;
          requestAnimationFrame(apply);
        }
      },
      { passive: true },
    );
  }

  function clamp(n, min, max) {
    return Math.max(min, Math.min(max, n));
  }
  function escapeHtml(str) {
    return String(str)
      .replaceAll("&", "&amp;")
      .replaceAll("<", "&lt;")
      .replaceAll(">", "&gt;")
      .replaceAll('"', "&quot;")
      .replaceAll("'", "&#039;");
  }
  function escapeAttr(str) {
    return String(str).replaceAll('"', "&quot;");
  }
})();

// =========================
// NAVBAR STICKY + ACTIVE LINK DINAMIS
// =========================

// NOTE: Bagian ini berada di luar IIFE, jadi perlu ambil ulang element DOM-nya.
const navbar = document.getElementById("navbar");
const burger = document.getElementById("burger");
const mobileMenu = document.getElementById("mobileMenu");

// 1) Set tinggi navbar ke CSS variable biar body padding-top pas
function syncNavHeight() {
  if (!navbar) return;
  const h = navbar.getBoundingClientRect().height || 80;
  document.documentElement.style.setProperty("--nav-h", h + "px");
}
syncNavHeight();
window.addEventListener("resize", syncNavHeight);

// 2) Helper: set active class berdasarkan id section
const navLinks = Array.from(document.querySelectorAll(".nav__link[data-link]"));

function setActiveNav(id) {
  navLinks.forEach((a) => {
    const isActive = a.dataset.link === id;
    a.classList.toggle("active", isActive);
    a.setAttribute("aria-current", isActive ? "page" : "false");
  });
}

// 3) Active link dinamis via IntersectionObserver
const sectionIds = navLinks.map((a) => a.dataset.link).filter(Boolean);
const sections = sectionIds
  .map((id) => document.getElementById(id))
  .filter(Boolean);

if (sections.length) {
  let ticking = false;

  function updateActiveSection() {
    const scrollPos = window.scrollY + window.innerHeight / 3;

    let currentSection = sections[0];
    for (const section of sections) {
      const rect = section.getBoundingClientRect();
      const sectionTop = window.scrollY + rect.top;

      if (scrollPos >= sectionTop) {
        currentSection = section;
      }
    }

    if (currentSection && currentSection.id) {
      setActiveNav(currentSection.id);
    }
  }

  window.addEventListener(
    "scroll",
    () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          updateActiveSection();
          ticking = false;
        });
        ticking = true;
      }
    },
    { passive: true },
  );

  updateActiveSection();

  // saat load pertama kali: kalau ada hash, langsung aktifkan
  const initial = (location.hash || "").replace("#", "");
  if (initial && sectionIds.includes(initial)) setActiveNav(initial);
  else setActiveNav(sectionIds[0] || "home");
}

// 4) Pastikan navbar tidak pernah “ngilang” karena CSS/JS lain
// (kalau ada class seperti hide/hidden dari kode lama)
function forceNavbarVisible() {
  if (!navbar) return;
  navbar.classList.remove("hide", "hidden", "nav--hidden", "is-hidden");
  // kalau ada transform yang geser ke atas
  if (navbar.style.transform && navbar.style.transform.includes("translate")) {
    navbar.style.transform = "";
  }
}
forceNavbarVisible();
window.addEventListener("scroll", forceNavbarVisible, { passive: true });

// 5) Optional: klik menu → close mobile menu + active update cepat
document
  .querySelectorAll(".nav__links a.nav__link, .nav__mobile a.nav__mLink")
  .forEach((a) => {
    a.addEventListener("click", () => {
      // tutup mobile menu (kalau kebuka)
      if (mobileMenu && mobileMenu.classList.contains("open")) {
        burger && burger.setAttribute("aria-expanded", "false");
        mobileMenu.classList.remove("open");
        mobileMenu.setAttribute("aria-hidden", "true");
      }

      const hash = (a.getAttribute("href") || "").replace("#", "");
      if (hash) setActiveNav(hash);
    });
  });

// Simple 3D tilt (safe)
document.querySelectorAll("[data-tilt]").forEach((card) => {
  const strength = 12;

  card.addEventListener("mousemove", (e) => {
    const rect = card.getBoundingClientRect();
    const x = e.clientX - rect.left;
    const y = e.clientY - rect.top;

    const rotateX = (y / rect.height - 0.5) * -strength;
    const rotateY = (x / rect.width - 0.5) * strength;

    card.style.transform = `
      perspective(800px)
      rotateX(${rotateX}deg)
      rotateY(${rotateY}deg)
      translateZ(0)
    `;
  });

  card.addEventListener("mouseleave", () => {
    card.style.transform = "perspective(800px) rotateX(0) rotateY(0)";
  });
});

// =========================
// ACHIEVEMENT TABS
// =========================
const achieveFilters = document.querySelectorAll(".achieve-filters .filter");
const achieveTabs = document.querySelectorAll(".achieve-tab-content");

if (achieveFilters.length > 0 && achieveTabs.length > 0) {
  achieveFilters.forEach((btn) => {
    btn.addEventListener("click", () => {
      // Remove active from all buttons
      achieveFilters.forEach((b) => {
        b.classList.remove("active");
        b.setAttribute("aria-selected", "false");
      });
      // Add active to clicked button
      btn.classList.add("active");
      btn.setAttribute("aria-selected", "true");

      const targetId = btn.getAttribute("data-target");

      // Hide all tabs
      achieveTabs.forEach((tab) => {
        tab.classList.remove("active");
      });

      // Show target tab
      const targetTab = document.getElementById("tab-" + targetId);
      if (targetTab) {
        targetTab.classList.add("active");
      }
    });
  });
}

/* =========================
   Typewriter Effect
========================= */
var TxtType = function (el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 2000;
  this.txt = "";
  this.tick();
  this.isDeleting = false;
};

TxtType.prototype.tick = function () {
  var i = this.loopNum % this.toRotate.length;
  var fullTxt = this.toRotate[i];

  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  this.el.innerHTML = '<span class="wrap">' + this.txt + "</span>";

  var that = this;
  var delta = 150 - Math.random() * 100;

  if (this.isDeleting) {
    delta /= 2;
  }

  if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
  } else if (this.isDeleting && this.txt === "") {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
  }

  setTimeout(function () {
    that.tick();
  }, delta);
};

function initTypewriter() {
  var elements = document.getElementsByClassName("typewrite");
  for (var i = 0; i < elements.length; i++) {
    var toRotate = elements[i].getAttribute("data-type");
    var period = elements[i].getAttribute("data-period");
    if (toRotate) {
      new TxtType(elements[i], JSON.parse(toRotate), period);
    }
  }
}

// Call immediately
initTypewriter();

// Initialize Brands Swiper
if (typeof Swiper !== "undefined") {
  const brandsSwiper = new Swiper(".brands-swiper", {
    effect: "coverflow",
    grabCursor: true,
    centeredSlides: true,
    slidesPerView: "auto",
    initialSlide: 2, // Start in the middle
    coverflowEffect: {
      rotate: 25,
      stretch: 30,
      depth: 120,
      modifier: 1.5,
      slideShadows: false,
    },
    watchSlidesProgress: true,
    loop: true,
    pagination: {
      el: ".brands-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".brands-nav-next",
      prevEl: ".brands-nav-prev",
    },
  });
}

// Initialize Customer Say Swiper
if (typeof Swiper !== "undefined" && document.querySelector(".csay-swiper")) {
  const csaySwiper = new Swiper(".csay-swiper", {
    slidesPerView: 1.25,
    centeredSlides: true,
    centeredSlidesBounds: false,
    spaceBetween: 16,
    grabCursor: true,
    loop: true,
    initialSlide: 0,
    speed: 600,
    watchSlidesProgress: true,
    breakpoints: {
      480: { slidesPerView: 2, spaceBetween: 16, centeredSlides: false },
      768: { slidesPerView: 3, spaceBetween: 18, centeredSlides: false },
      1024: { slidesPerView: 4, spaceBetween: 20, centeredSlides: false },
      1280: { slidesPerView: 5, spaceBetween: 22, centeredSlides: false },
    },
    navigation: {
      nextEl: ".csay-next",
      prevEl: ".csay-prev",
    },
  });
}

// Landing Page Submit Button Loader
document.addEventListener("submit", function (e) {
  const form = e.target;
  if (e.defaultPrevented) return;

  const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
  if (submitBtn && !submitBtn.classList.contains("no-loader")) {
    if (submitBtn.offsetWidth) {
      submitBtn.style.minWidth = submitBtn.offsetWidth + "px";
    }

    const originalHTML = submitBtn.innerHTML;
    const isButtonTag = submitBtn.tagName === "BUTTON";

    setTimeout(function () {
      if (isButtonTag) {
        submitBtn.innerHTML =
          '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Sending...';
      } else {
        submitBtn.value = "Sending...";
      }
      submitBtn.disabled = true;
    }, 10);

    setTimeout(function () {
      if (form.querySelectorAll(":invalid").length > 0) {
        submitBtn.disabled = false;
        if (isButtonTag) {
          submitBtn.innerHTML = originalHTML;
        } else {
          submitBtn.value = originalHTML;
        }
        submitBtn.style.minWidth = "";
      }
    }, 150);
  }
});
