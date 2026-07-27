<!doctype html>
<html lang="id" data-theme="dark">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="theme-color" content="#060711" />

  <!-- SEO BASIC -->
  <title>Annisa Esce – Content Creator & Video Editor</title>
  <meta name="description"
    content="Annisa Esce adalah content creator & video editor spesialis short-form (Reels, TikTok). Fokus hooks, script, dan konversi." />

  <!-- KEYWORDS (optional tapi bantu) -->
  <meta name="keywords"
    content="content creator, video editor, reels editor, tiktok editor, jasa edit video, UGC creator, annisa hanif, annisa, annisa esce" />

  <!-- AUTHOR -->
  <meta name="author" content="Annisa Esce">

  <!-- OPEN GRAPH (saat di share) -->
  <meta property="og:title" content="Annisa Esce – Content Creator">
  <meta property="og:description" content="Portfolio content creator spesialis short-form ads, hooks & storytelling.">
  <meta property="og:image" content="https://www.annisaesce.web.id/assets/logo.jpeg">
  <meta property="og:url" content="https://www.annisaesce.web.id">
  <meta property="og:type" content="website">

  <!-- TWITTER CARD -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Annisa Esce – Content Creator">
  <meta name="twitter:description" content="Portfolio short-form content, hooks & storytelling.">
  <meta name="twitter:image" content="https://www.annisaesce.web.id/assets/logo.jpeg">

  <!-- CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <link rel="stylesheet" href="<?= base_url('assets/style.css?v=' . time()) ?>" />

  <style>
    /* Dynamic Section Backgrounds */
    #about.section::before {
      <?php if (!empty($about['bg_image'])): ?>background-image: url('<?= base_url('assets/uploads/about/' . $about['bg_image']) ?>') !important;
      background-size: cover !important;
      background-position: center !important;
      opacity: 1 !important;
      filter: none !important;
      <?php endif; ?>
    }

    @media (max-width: 768px) {
      #about.section::before {
        <?php if (!empty($about['bg_mobile'])): ?>background-image: url('<?= base_url('assets/uploads/about/' . $about['bg_mobile']) ?>') !important;
        background-size: cover !important;
        background-position: center !important;
        opacity: 1 !important;
        filter: none !important;
        <?php endif; ?>
      }
    }

    #brands.section::before,
    #brands {
      <?php if (!empty($brandSettings['bg_desktop'])): ?>background-image: url('<?= base_url('assets/uploads/brands/' . $brandSettings['bg_desktop']) ?>') !important;
      background-size: cover !important;
      background-position: center !important;
      <?php endif; ?>
    }

    @media (max-width: 768px) {

      #brands.section::before,
      #brands {
        <?php if (!empty($brandSettings['bg_mobile'])): ?>background-image: url('<?= base_url('assets/uploads/brands/' . $brandSettings['bg_mobile']) ?>') !important;
        background-size: cover !important;
        background-position: center !important;
        <?php endif; ?>
      }
    }
  </style>

  <!-- ICON -->
  <link rel="icon" type="image/jpeg" href="<?= !empty($settings['site_logo']) ? base_url('assets/uploads/settings/' . $settings['site_logo']) : base_url('assets/logo.jpeg') ?>">
  <link rel="shortcut icon" type="image/jpeg" href="<?= !empty($settings['site_logo']) ? base_url('assets/uploads/settings/' . $settings['site_logo']) : base_url('assets/logo.jpeg') ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Canonical -->
  <link rel="canonical" href="https://www.annisaesce.web.id">

  <!-- Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">

  <style>
    @media (max-width: 980px) {
      #home.hero {
        padding-top: 0px !important;
        padding-bottom: 5px !important;
      }
    }
  </style>
</head>


<body>
  <!-- GLOBAL BACKGROUND (no external resources) -->
  <div class="bg" aria-hidden="true">
    <div class="bg__grid"></div>
    <div class="bg__noise"></div>
  </div>

  <!-- Top progress -->
  <div class="scrollbar" aria-hidden="true">
    <div class="scrollbar__bar" id="scrollbarBar"></div>
  </div>

  <!-- NAV -->
  <header class="nav" id="navbar">
    <div class="container nav__inner">
      <a class="brand" href="#home" aria-label="Kembali ke Home">
        <span class="brand__mark" aria-hidden="true"></span>
        <span class="brand__text">Annisa <span class="brand__muted">Esce</span></span>
      </a>

      <nav class="nav__links" aria-label="Navigasi utama">
        <a class="nav__link active" href="#home" data-link="home">Home</a>
        <a class="nav__link" href="#about" data-link="about">About</a>
        <a class="nav__link" href="#brands" data-link="brands">Brands</a>
        <a class="nav__link" href="#projects" data-link="projects">Projects</a>
        <a class="nav__link" href="#resume" data-link="resume">Resume</a>
        <a class="nav__link" href="#achievements" data-link="achievements">Achievements</a>
        <a class="nav__link" href="#contact" data-link="contact">Contact</a>
      </nav>

      <div class="nav__actions">
        <a class="btn btn--ghost" href="#projects" data-tilt data-tilt-strength="10">
          <svg class="ico" aria-hidden="true">
            <use href="#i-grid"></use>
          </svg>
          Work
        </a>

        <a class="btn btn--primary" href="#contact" data-tilt data-tilt-strength="12">
          <svg class="ico" aria-hidden="true">
            <use href="#i-spark"></use>
          </svg>
          Let’s Talk
          <span class="btn__glow" aria-hidden="true"></span>
        </a>

        <button class="btn btn--ghost btn--icon" id="themeToggle" type="button" aria-label="Toggle theme" data-tilt
          data-tilt-strength="10">
          <svg class="ico" id="themeIconMoon" aria-hidden="true">
            <use href="#i-moon"></use>
          </svg>
          <svg class="ico hidden" id="themeIconSun" aria-hidden="true">
            <use href="#i-sun"></use>
          </svg>
        </button>

        <button class="burger" id="burger" aria-label="Buka menu" aria-expanded="false">
          <span></span><span></span><span></span>
        </button>
      </div>
    </div>

    <!-- MOBILE MENU -->
    <div class="nav__mobile" id="mobileMenu" aria-hidden="true">
      <div class="nav__mobileInner">
        <a class="nav__mLink" href="#home" data-close>Home</a>
        <a class="nav__mLink" href="#about" data-close>About</a>
        <a class="nav__mLink" href="#brands" data-close>Brands</a>
        <a class="nav__mLink" href="#projects" data-close>Projects</a>
        <a class="nav__mLink" href="#resume" data-close>Resume</a>
        <a class="nav__mLink" href="#achievements" data-close>Achievements</a>
        <a class="nav__mLink" href="#contact" data-close>Contact</a>
        <div class="nav__mActions">
          <button class="btn btn--ghost w-full" id="themeToggleMobile" type="button" data-close>
            <svg class="ico" aria-hidden="true">
              <use href="#i-switch"></use>
            </svg>
            Toggle Theme
          </button>
          <a class="btn btn--primary w-full" href="#contact" data-tilt data-tilt-strength="12" data-close>
            <svg class="ico" aria-hidden="true">
              <use href="#i-chat"></use>
            </svg>
            Contact
            <span class="btn__glow" aria-hidden="true"></span>
          </a>
        </div>
      </div>
    </div>
  </header>

  <main>
    <!-- HERO -->
    <section class="section hero" id="home" data-spot="home">
      <div class="container hero__grid">
        <div class="hero__copy reveal">
          <p class="pill" data-tilt data-tilt-strength="8">
            <span class="pill__dot" aria-hidden="true"></span>
            <?= esc($hero['pill_text'] ?? 'Short-form • Hooks • Story') ?>
          </p>

          <h1 class="hero__title grad-white-pink" style="padding-bottom: 10px; margin-top: 0px;">
            <?= esc($hero['title_line1'] ?? 'Konten yang') ?> <span class="typewrite" data-period="2000" data-type='<?= esc($hero['typewrite_words1'] ?? '[ "nempel,", "berkesan,", "viral," ]') ?>'><span class="wrap"></span></span><br>
            <?= esc($hero['title_line2'] ?? 'hasil yang') ?> <span class="typewrite" data-period="2000" data-type='<?= esc($hero['typewrite_words2'] ?? '[ "kerasa.", "nyata.", "maksimal." ]') ?>'><span class="wrap"></span></span>
          </h1>

          <p class="hero__desc" style="color: white;">
            <?= esc($hero['description'] ?? 'Script + edit cepat, tampilan clean, CTA halus. Cocok buat brand & creator yang butuh konsisten.') ?>
          </p>

          <div class="hero__cta">
            <a class="btn btn--primary" href="#projects" data-tilt data-tilt-strength="14">
              <svg class="ico" aria-hidden="true">
                <use href="#i-play"></use>
              </svg>
              See Projects
              <span class="btn__glow" aria-hidden="true"></span>
            </a>
            <a class="btn btn--ghost" href="#contact" data-tilt data-tilt-strength="10">
              <svg class="ico" aria-hidden="true">
                <use href="#i-mail"></use>
              </svg>
              Contact
            </a>
            <a class="btn btn--chip" href="#resume" data-tilt data-tilt-strength="10">
              <svg class="ico" aria-hidden="true">
                <use href="#i-file"></use>
              </svg>
              Resume
            </a>
          </div>

        </div>

        <div class="hero__visual reveal">
          <div class="portrait card3d" data-tilt data-tilt-strength="16">
            <div class="portrait__frame">
              <div class="portrait__shine" aria-hidden="true"></div>

              <div class="portrait__avatar">
                <!-- No external image: data-uri placeholder -->
                <img class="avatar__img" alt="Your photo" loading="lazy" decoding="async" src="<?= !empty($hero['photo']) ? base_url('assets/uploads/hero/' . $hero['photo']) : base_url('assets/header.jpg') ?>">
              </div>

              <div class="portrait__meta">
                <?php if (!empty($heroMeta)) : ?>
                  <?php foreach ($heroMeta as $meta) : ?>
                    <div class="meta__row">
                      <span class="meta__k"><?= esc($meta['key_label']) ?></span>
                      <span class="meta__v"><?= esc($meta['value_text']) ?></span>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </div>
            </div>

            <div class="floating floating--a" aria-hidden="true"></div>
            <div class="floating floating--b" aria-hidden="true"></div>
            <div class="floating floating--c" aria-hidden="true"></div>
          </div>
        </div>

        <div class="hero__stats">
          <?php if (!empty($heroStats)) : ?>
            <?php foreach ($heroStats as $stat) : ?>
              <div class="stat card3d reveal" data-tilt data-tilt-strength="9">
                <div class="stat__num"><?= esc($stat['value']) ?></div>
                <div class="stat__label"><?= esc($stat['label']) ?></div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>
    <hr class="divider-metallic">

    <!-- ABOUT -->
    <section class="section" id="about" data-spot="about">
      <div class="container">
        <div class="about2">
          <div class="about2__story">
            <div class="about2__storyTop">
              <div class="pill">
                <span class="pill__dot" aria-hidden="true"></span>
                <?= esc($about['pill_text'] ?? 'About Me') ?>
              </div>
            </div>

            <h3 class="about2__title">
              <?= $about['title'] ?? 'Menciptakan konten yang <span class="text-pink">berkesan</span>, <br>bukan hanya sekadar viral.' ?>
            </h3>

            <p class="about2__text">
              <?= esc($about['description'] ?? 'Strategi, storytelling, dan visual yang dirancang untuk menarik perhatian dan mendorong aksi nyata.') ?>
            </p>

            <div class="about2__icons">
              <?php if (!empty($aboutIcons)) : ?>
                <?php foreach ($aboutIcons as $ai) : ?>
                  <div class="aboutIcon">
                    <div class="aboutIcon__circle">
                      <i class="<?= esc($ai['icon']) ?>" style="font-size: 20px; color: #ff69b4"></i>
                    </div>
                    <span><?= nl2br(esc($ai['label'])) ?></span>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="aboutIcon">
                  <div class="aboutIcon__circle">
                    <svg class="ico" aria-hidden="true">
                      <use href="#i-tiktok"></use>
                    </svg>
                  </div>
                  <span>Hook<br>Strategy</span>
                </div>
                <div class="aboutIcon">
                  <div class="aboutIcon__circle">
                    <svg class="ico" aria-hidden="true">
                      <use href="#i-file"></use>
                    </svg>
                  </div>
                  <span>Storytelling<br>Terstruktur</span>
                </div>
                <div class="aboutIcon">
                  <div class="aboutIcon__circle">
                    <svg class="ico" aria-hidden="true">
                      <use href="#i-play"></use>
                    </svg>
                  </div>
                  <span>Editing<br>Dinamis</span>
                </div>
                <div class="aboutIcon">
                  <div class="aboutIcon__circle">
                    <svg class="ico" aria-hidden="true">
                      <use href="#i-sliders"></use>
                    </svg>
                  </div>
                  <span>CTA<br>Menghasilkan Aksi</span>
                </div>
              <?php endif; ?>
            </div>

            <div class="about2__mini">
              <?php if (!empty($aboutMiniStats)) : ?>
                <?php foreach ($aboutMiniStats as $ams) : ?>
                  <div class="miniStat">
                    <span class="miniStat__k">
                      <i class="<?= esc($ams['icon']) ?>" style="font-size: 14px; color: #ff69b4;"></i> <?= esc($ams['label']) ?>
                    </span>
                    <span class="miniStat__v text-pink"><?= esc($ams['value']) ?></span>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="miniStat">
                  <span class="miniStat__k">
                    <svg class="ico" aria-hidden="true" style="width: 14px; height: 14px;">
                      <use href="#i-clock"></use>
                    </svg> Delivery
                  </span>
                  <span class="miniStat__v text-pink">24–72h</span>
                </div>
                <div class="miniStat">
                  <span class="miniStat__k">
                    <svg class="ico" aria-hidden="true" style="width: 14px; height: 14px;">
                      <use href="#i-play"></use>
                    </svg> Format
                  </span>
                  <span class="miniStat__v text-pink">Reels / TikTok</span>
                </div>
                <div class="miniStat">
                  <span class="miniStat__k">
                    <svg class="ico" aria-hidden="true" style="width: 14px; height: 14px;">
                      <use href="#i-spark"></use>
                    </svg> Style
                  </span>
                  <span class="miniStat__v text-pink">Clean + Cinematic</span>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="about2__cards">
            <?php if (!empty($aboutCards)) : ?>
              <?php foreach ($aboutCards as $ac) : ?>
                <article class="about2__card card3d reveal" data-tilt data-tilt-strength="10">
                  <div class="about2__icon">
                    <i class="<?= esc($ac['icon']) ?>" style="font-size: 20px; color: #ff69b4;"></i>
                  </div>
                  <div class="about2__card-content">
                    <h4><?= esc($ac['title']) ?></h4>
                    <p class="muted clamp-2"><?= esc($ac['description']) ?></p>
                  </div>
                  <svg class="ico about2__card-arrow" aria-hidden="true">
                    <use href="#i-chevron-right"></use>
                  </svg>
                </article>
              <?php endforeach; ?>
            <?php else: ?>
              <article class="about2__card card3d reveal" data-tilt data-tilt-strength="10">
                <div class="about2__icon">
                  <svg class="ico" aria-hidden="true">
                    <use href="#i-spark"></use>
                  </svg>
                </div>
                <div class="about2__card-content">
                  <h4>Hook & Structure</h4>
                  <p class="muted clamp-2">2 detik pertama harus “nangkep”. Problem → proof → CTA.</p>
                </div>
                <svg class="ico about2__card-arrow" aria-hidden="true">
                  <use href="#i-chevron-right"></use>
                </svg>
              </article>

              <article class="about2__card card3d reveal" data-tilt data-tilt-strength="10">
                <div class="about2__icon">
                  <svg class="ico" aria-hidden="true">
                    <use href="#i-play"></use>
                  </svg>
                </div>
                <div class="about2__card-content">
                  <h4>Editing Rhythm</h4>
                  <p class="muted clamp-2">Cut tegas, beat sync, sound accent biar enak ditonton.</p>
                </div>
                <svg class="ico about2__card-arrow" aria-hidden="true">
                  <use href="#i-chevron-right"></use>
                </svg>
              </article>

              <article class="about2__card card3d reveal" data-tilt data-tilt-strength="10">
                <div class="about2__icon">
                  <svg class="ico" aria-hidden="true">
                    <use href="#i-layers"></use>
                  </svg>
                </div>
                <div class="about2__card-content">
                  <h4>UGC / Ads</h4>
                  <p class="muted clamp-2">Trust-first visual, overlay tipis, versi A/B untuk testing.</p>
                </div>
                <svg class="ico about2__card-arrow" aria-hidden="true">
                  <use href="#i-chevron-right"></use>
                </svg>
              </article>

              <article class="about2__card card3d reveal" data-tilt data-tilt-strength="10">
                <div class="about2__icon">
                  <svg class="ico" aria-hidden="true">
                    <use href="#i-sliders"></use>
                  </svg>
                </div>
                <div class="about2__card-content">
                  <h4>Data Iteration</h4>
                  <p class="muted clamp-2">Improve dari retention, CTR, saves. Bukan “feeling” doang.</p>
                </div>
                <svg class="ico about2__card-arrow" aria-hidden="true">
                  <use href="#i-chevron-right"></use>
                </svg>
              </article>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <hr class="divider-metallic">

    <!-- BRANDS -->
    <section class="wp-brands section" id="brands" data-spot="brands">
      <div class="container">

        <!-- Section Header -->
        <div class="section__head reveal" style="text-align: center; margin-bottom: 40px; display: flex; flex-direction: column; align-items: center;">
          <p style="font-size: 14px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #ff69b4; margin-bottom: 8px;">OUR BRANDS</p>
          <h2 class="section__title" style="font-size: 48px; line-height: 1.1; margin-bottom: 16px; color: var(--text); font-family: serif; text-align: center;">Brand &amp; Project We've <span style="color: #ff69b4;">Worked With</span></h2>
          <p class="section__sub" style="font-size: 15px; color: var(--muted); text-align: center; margin: 0 auto; max-width: 500px;">Kolaborasi nyata, hasil yang berdampak.</p>
        </div>

      </div>
      </div> <!-- End container -->

      <!-- Brands Grid Full Width -->
      <div class="swiper brands-swiper">
        <div class="swiper-wrapper">
          <?php if (!empty($brands)) : ?>
            <?php foreach ($brands as $b) : ?>
              <div class="swiper-slide">
                <div class="wp-brand-card">
                  <div class="wp-brand-logo">
                    <img src="<?= base_url(file_exists(FCPATH . 'assets/uploads/brands/' . $b['logo']) ? 'assets/uploads/brands/' . $b['logo'] : 'assets/assets/' . $b['logo']) ?>" alt="<?= esc($b['name']) ?>">
                  </div>
                  <h3><?= esc($b['name']) ?></h3>
                  <span class="wp-brand-location">
                    <i class="ri-map-pin-line"></i> <?= esc($b['location']) ?>
                  </span>
                  <p><?= esc($b['description']) ?></p>
                  <?php if (!empty($b['project_link'])) : ?>
                    <a href="<?= esc($b['project_link']) ?>" class="btn-view-project" target="_blank">View Project <svg class="ico" aria-hidden="true">
                        <use href="#i-arrow-right"></use>
                      </svg></a>
                  <?php else : ?>
                    <a href="#projects" class="btn-view-project">View Project <svg class="ico" aria-hidden="true">
                        <use href="#i-arrow-right"></use>
                      </svg></a>
                  <?php endif; ?>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <div class="swiper-slide">
              <div class="wp-brand-card">
                <div class="wp-brand-logo">
                  <img src="<?= base_url('assets/assets/alfatih.png') ?>" alt="Al Fatih Umrah">
                </div>
                <h3>Al Fatih Umrah</h3>
                <span class="wp-brand-location">
                  <i class="ri-map-pin-line"></i> Indonesia
                </span>
                <p>Perusahaan travel umrah dengan sistem digital & promosi modern.</p>
                <a href="#" class="btn-view-project">View Project <svg class="ico" aria-hidden="true">
                    <use href="#i-arrow-right"></use>
                  </svg></a>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="wp-brand-card">
                <div class="wp-brand-logo">
                  <img src="<?= base_url('assets/assets/bisaai.png') ?>" alt="BISA AI">
                </div>
                <h3>BISA AI</h3>
                <span class="wp-brand-location">
                  <i class="ri-map-pin-line"></i> Indonesia
                </span>
                <p>Platform edukasi AI & teknologi untuk pengembangan talenta digital.</p>
                <a href="#" class="btn-view-project">View Project <svg class="ico" aria-hidden="true">
                    <use href="#i-arrow-right"></use>
                  </svg></a>
              </div>
            </div>
          <?php endif; ?>
        </div>
        <div class="swiper-button-prev brands-nav-prev"><svg class="ico" aria-hidden="true">
            <use href="#i-arrow-left"></use>
          </svg></div>
        <div class="swiper-button-next brands-nav-next"><svg class="ico" aria-hidden="true">
            <use href="#i-arrow-right"></use>
          </svg></div>
        <div class="swiper-pagination brands-pagination"></div>
      </div>
    </section>
    <hr class="divider-metallic">

    <!-- PROJECTS -->
    <section class="section wp-portfolio" id="projects" data-spot="projects">
      <div class="container">

        <!-- Section Header -->
        <div class="portfolio-header-row reveal" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; margin-bottom: 40px; gap: 24px;">

          <div class="section__head" style="text-align: left; margin: 0; max-width: 400px;">
            <p style="font-size: 14px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #ff69b4; margin-bottom: 8px;">PORTFOLIO</p>
            <h2 class="section__title" style="font-size: 48px; line-height: 1.1; margin-bottom: 16px; color: var(--text); font-family: serif;">Our Selected <span style="color: #ff69b4;">Projects</span></h2>
            <p class="section__sub" style="font-size: 15px; color: var(--muted); margin: 0;">Kumpulan karya terbaik yang kami buat<br>dengan dedikasi dan sepenuh hati.</p>
          </div>

          <div class="portfolio-filters" role="tablist" aria-label="Filter projects" style="flex: 1; justify-content: flex-end; gap: 8px;">
            <button class="portfolio-filter active" data-filter="all" role="tab" aria-selected="true">All</button>
            <button class="portfolio-filter" data-filter="property" role="tab" aria-selected="false">Property</button>
            <button class="portfolio-filter" data-filter="travel" role="tab" aria-selected="false">Travel</button>
            <button class="portfolio-filter" data-filter="f&b" role="tab" aria-selected="false">F&B</button>
            <button class="portfolio-filter" data-filter="event" role="tab" aria-selected="false">Event</button>
            <button class="portfolio-filter" data-filter="fashion" role="tab" aria-selected="false">Fashion</button>
            <button class="portfolio-filter" data-filter="branding" role="tab" aria-selected="false">Branding</button>
            <button class="portfolio-filter" data-filter="digital" role="tab" aria-selected="false">Digital</button>
          </div>

        </div>

        <div class="portfolio-search reveal" style="display: none;">
          <div class="search-box">
            <input id="projectSearch" type="search" placeholder="Search project..." aria-label="Cari project" />
            <svg class="ico search-ico" aria-hidden="true">
              <use href="#i-search"></use>
            </svg>
          </div>
        </div>

      </div> <!-- End container -->

      <!-- Projects Swiper -->
      <div class="swiper projects-swiper reveal" style="padding-top: 30px;">
        <div class="swiper-wrapper" id="projectsGrid">
          <!-- Slides injected by JS -->
        </div>

        <div class="swiper-button-prev projects-nav-prev"><svg class="ico" aria-hidden="true">
            <use href="#i-arrow-left"></use>
          </svg></div>
        <div class="swiper-button-next projects-nav-next"><svg class="ico" aria-hidden="true">
            <use href="#i-arrow-right"></use>
          </svg></div>
        <div class="swiper-pagination projects-pagination"></div>
      </div>

      <div class="container reveal">
        <!-- Stats Section (Desktop/Tablet) -->
        <div class="portfolio-stats">
          <div class="stat-item">
            <div class="stat-icon"><i class="ri-briefcase-4-line"></i></div>
            <div class="stat-text">
              <h4>120+</h4>
              <p>Projects Completed</p>
            </div>
          </div>
          <div class="stat-item">
            <div class="stat-icon"><i class="ri-team-line"></i></div>
            <div class="stat-text">
              <h4>85+</h4>
              <p>Happy Clients</p>
            </div>
          </div>
          <div class="stat-item">
            <div class="stat-icon"><i class="ri-star-line"></i></div>
            <div class="stat-text">
              <h4>5.0</h4>
              <p>Client Rating</p>
            </div>
          </div>
          <div class="stat-item">
            <div class="stat-icon"><i class="ri-medal-line"></i></div>
            <div class="stat-text">
              <h4>7+</h4>
              <p>Years Experience</p>
            </div>
          </div>
        </div>


      </div>

    </section>
    <hr class="divider-metallic">

    <!-- ACHIEVEMENTS -->
    <section class="section" id="achievements" data-spot="achievements">
      <div class="container">

        <!-- Section Header Row -->
        <div class="portfolio-header-row reveal" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; margin-bottom: 40px; gap: 24px;">
          <div class="section__head" style="text-align: left; margin: 0; max-width: 400px;">
            <p style="font-size: 14px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #ff69b4; margin-bottom: 8px;">ACHIEVEMENTS</p>
            <h2 class="section__title" style="font-size: 48px; line-height: 1.1; margin-bottom: 16px; color: var(--text); font-family: serif;">Key <span style="color: #ff69b4;">Milestones</span></h2>
            <p class="section__sub" style="font-size: 15px; color: var(--muted); margin: 0;">Pencapaian dan momen penting selama berkarir.</p>
          </div>

          <div class="filters achieve-filters" role="tablist" aria-label="Filter achievements" style="flex: 1; justify-content: flex-end; gap: 8px; margin: 0;">
            <?php if (!empty($achievementCategories)) : ?>
              <?php foreach ($achievementCategories as $idx => $cat) : ?>
                <button class="filter <?= $idx === 0 ? 'active' : '' ?>" data-target="<?= esc($cat['slug']) ?>" role="tab" aria-selected="<?= $idx === 0 ? 'true' : 'false' ?>">
                  <i class="<?= esc($cat['icon'] ?? 'bi bi-award-fill') ?>" style="margin-right: 4px;"></i> <?= esc($cat['name']) ?>
                </button>
              <?php endforeach; ?>
            <?php else: ?>
              <button class="filter active" data-target="creator" role="tab" aria-selected="true">
                <svg class="ico" aria-hidden="true">
                  <use href="#i-user"></use>
                </svg> Content Creator
              </button>
              <button class="filter" data-target="academy" role="tab" aria-selected="false">
                <svg class="ico" aria-hidden="true">
                  <use href="#i-briefcase"></use>
                </svg> Academy
              </button>
              <button class="filter" data-target="film" role="tab" aria-selected="false">
                <svg class="ico" aria-hidden="true">
                  <use href="#i-play"></use>
                </svg> Film
              </button>
            <?php endif; ?>
          </div>
        </div>

        <?php if (!empty($achievementCategories)) : ?>
          <?php foreach ($achievementCategories as $idx => $cat) : ?>
            <div class="achieve-tab-content <?= $idx === 0 ? 'active' : '' ?>" id="tab-<?= esc($cat['slug']) ?>">

              <?php
              $mainAch = null;
              $timelineAchs = [];
              foreach ($achievements as $ach) {
                if ($ach['category_id'] == $cat['id']) {
                  if ($ach['is_main'] == 1) {
                    $mainAch = $ach;
                  } else {
                    $timelineAchs[] = $ach;
                  }
                }
              }
              ?>

              <?php if ($mainAch) : ?>
                <div class="main-achieve reveal">
                  <div class="main-achieve__photo">
                    <img src="<?= base_url(file_exists(FCPATH . 'assets/uploads/achievements/' . $mainAch['photo']) ? 'assets/uploads/achievements/' . $mainAch['photo'] : 'assets/assets/' . $mainAch['photo']) ?>" alt="<?= esc($mainAch['title']) ?>" loading="lazy">
                    <div class="main-achieve__photo-text">
                      <span class="small-text"><?= esc($mainAch['small_text']) ?></span>
                      <h2><?= esc($mainAch['title']) ?></h2>
                      <span class="signature">Annisa Esce</span>
                    </div>
                  </div>
                  <div class="main-achieve__content">
                    <div class="main-achieve__year"><?= esc($mainAch['year']) ?></div>
                    <?php if (!empty($mainAch['badge_text'])) : ?>
                      <div class="main-achieve__badge">
                        <?= esc($mainAch['badge_text']) ?>
                      </div>
                    <?php endif; ?>
                    <h3><?= esc($mainAch['title']) ?></h3>
                    <p class="muted"><?= esc($mainAch['description']) ?></p>
                  </div>
                </div>
              <?php endif; ?>

              <?php if (!empty($timelineAchs)) : ?>
                <div class="achieve-timeline">
                  <?php foreach ($timelineAchs as $ach) : ?>
                    <div class="achieve-item reveal">
                      <div class="achieve-item__year-label"><?= esc($ach['year']) ?></div>
                      <div class="achieve-item__dot"></div>
                      <div class="achieve-item__photo">
                        <img src="<?= base_url(file_exists(FCPATH . 'assets/uploads/achievements/' . $ach['photo']) ? 'assets/uploads/achievements/' . $ach['photo'] : 'assets/assets/' . $ach['photo']) ?>" alt="<?= esc($ach['title']) ?>" loading="lazy">
                      </div>
                      <div class="achieve-item__text card3d" data-tilt data-tilt-strength="10">
                        <svg class="achieve-spark" aria-hidden="true">
                          <use href="#i-spark"></use>
                        </svg>
                        <div class="achieve-text-inner">
                          <div class="achieve-icon">
                            <i class="bi bi-award-fill" style="color: #ff69b4; font-size: 16px;"></i>
                          </div>
                          <div class="achieve-details">
                            <span class="achieve-date"><?= esc($ach['date_label']) ?></span>
                            <h3><?= esc($ach['title']) ?></h3>
                            <p class="muted"><?= esc($ach['description']) ?></p>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <!-- Static backup if achievements empty -->
          <div class="achieve-tab-content active" id="tab-creator">
            <div class="main-achieve reveal">
              <div class="main-achieve__photo">
                <img src="assets/main_achievement.png" alt="Main Achievement" loading="lazy">
                <div class="main-achieve__photo-text">
                  <span class="small-text">CONTENT CREATOR AWARDS</span>
                  <h2>CREATOR OF THE YEAR 2026</h2>
                  <span class="signature">Annisa Esce</span>
                </div>
              </div>
              <div class="main-achieve__content">
                <div class="main-achieve__year">2026</div>
                <div class="main-achieve__badge">
                  ★ PRESTASI UTAMA
                </div>
                <h3>Best Creator of The Year</h3>
                <p class="muted">Penghargaan tertinggi yang diraih Annisa Esce sebagai kreator paling berpengaruh di tahun 2026.</p>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </section>
    <hr class="divider-metallic">

    <!-- RESUME -->
    <section class="section" id="resume" data-spot="resume">
      <div class="container">
        <!-- Section Header Row -->
        <div class="portfolio-header-row reveal" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; margin-bottom: 40px; gap: 24px;">
          <div class="section__head" style="text-align: left; margin: 0; max-width: 500px;">
            <p style="font-size: 14px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #ff69b4; margin-bottom: 8px;">MY RESUME</p>
            <h2 class="section__title" style="font-size: 48px; line-height: 1.1; margin-bottom: 16px; color: var(--text); font-family: serif;">Professional <span style="color: #ff69b4;">Resume</span></h2>
            <p class="section__sub" style="font-size: 15px; color: var(--muted); margin: 0;">Ringkas, jelas, dan fokus value.</p>
          </div>
        </div>

        <div class="resume__grid">
          <div class="card3d resume__card reveal" data-tilt data-tilt-strength="12">
            <h3 style="margin-bottom: 30px;"><svg class="ico" aria-hidden="true">
                <use href="#i-briefcase"></use>
              </svg> Experience</h3>
            <div class="timeline">
              <?php if (!empty($experiences)) : ?>
                <?php foreach ($experiences as $exp) : ?>
                  <div class="titem">
                    <div class="titem__dot"></div>
                    <div class="titem__body">
                      <div class="titem__top">
                        <strong><?= esc($exp['title']) ?></strong>
                        <span class="muted period"><?= esc($exp['period']) ?></span>
                      </div>
                      <p class="muted clamp-2"><?= esc($exp['description']) ?></p>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="titem">
                  <div class="titem__dot"></div>
                  <div class="titem__body">
                    <div class="titem__top">
                      <strong>Content Creator</strong>
                      <span class="muted period">2023 — Now</span>
                    </div>
                    <p class="muted clamp-2">Short-form ads + brand story + content system.</p>
                  </div>
                </div>
                <div class="titem">
                  <div class="titem__dot"></div>
                  <div class="titem__body">
                    <div class="titem__top">
                      <strong>Creative Partner</strong>
                      <span class="muted period">2023 — Now</span>
                    </div>
                    <p class="muted clamp-2">This partnership is ideal for brands looking for consistency, clarity, and long-term growth through content.</p>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>

          <div class="card3d resume__card reveal" data-tilt data-tilt-strength="12">
            <h3><svg class="ico" aria-hidden="true">
                <use href="#i-sliders"></use>
              </svg> Skills</h3>
            <div class="skills">
              <?php if (!empty($skills)) : ?>
                <?php foreach ($skills as $sk) : ?>
                  <div class="skill">
                    <span><?= esc($sk['name']) ?></span>
                    <div class="bar"><i style="width: <?= (int)$sk['percentage'] ?>%"></i></div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="skill">
                  <span>Hooks & Structure</span>
                  <div class="bar"><i style="width: 92%"></i></div>
                </div>
                <div class="skill">
                  <span>Editing Rhythm</span>
                  <div class="bar"><i style="width: 88%"></i></div>
                </div>
              <?php endif; ?>
            </div>

            <div class="resume__actions">
              <a class="btn btn--primary" target="_blank" href="<?= !empty($hero['cv_file']) ? base_url('assets/uploads/hero/' . $hero['cv_file']) : base_url('assets/assets/cv annisa.pdf') ?>" id="downloadCV" download="<?= esc($hero['cv_file'] ?? 'CV Annisa.pdf') ?>"
                data-tilt data-tilt-strength="12">
                <svg class="ico" aria-hidden="true">
                  <use href="#i-download"></use>
                </svg>
                Download CV
                <span class="btn__glow" aria-hidden="true"></span>
              </a>
              <a class="btn btn--ghost"
                href="<?= esc($hero['portfolio_link'] ?? 'https://drive.google.com/drive/folders/1SlQgTtyq56oYGV9dAojJn6RFkS3hMiUS?usp=sharing') ?>"
                target="_blank" data-tilt data-tilt-strength="10">
                <svg class="ico" aria-hidden="true">
                  <use href="#i-download"></use>
                </svg>
                Portfolio
              </a>
            </div>
          </div>

          <div class="card3d resume__card reveal" data-tilt data-tilt-strength="12">
            <h3><svg class="ico" aria-hidden="true">
                <use href="#i-tool"></use>
              </svg> Tools</h3>
            <div class="chips">
              <?php if (!empty($tools)) : ?>
                <?php foreach ($tools as $tl) : ?>
                  <span class="chip"><?= esc($tl['name']) ?></span>
                <?php endforeach; ?>
              <?php else: ?>
                <span class="chip">CapCut</span>
                <span class="chip">Photoshop</span>
                <span class="chip">After Effects</span>
              <?php endif; ?>
            </div>
            <p class="muted clamp-2">Batch production + templates + A/B hooks.</p>
          </div>
        </div>
      </div>
    </section>
    <hr class="divider-metallic">

    <!-- CUSTOMER SAY -->
    <section class="section" id="customers" data-spot="customers">
      <div class="container">
        <div class="csay__header reveal">
          <div class="section__head" style="text-align: left; margin: 0; max-width: 400px;">
            <p style="font-size: 14px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #ff69b4; margin-bottom: 8px;">Testimonial</p>
            <h2 class="section__title" style="font-size: 48px; line-height: 1.1; margin-bottom: 16px; color: var(--text); font-family: serif;">What They <span style="color: #ff69b4;">Say</span></h2>
            <p class="section__sub" style="font-size: 15px; color: var(--muted); margin: 0;">Kumpulan karya terbaik yang kami buat<br>dengan dedikasi dan sepenuh hati.</p>
          </div>
          <div class="csay__header-right">
            <div class="csay__nav">
              <button class="csay__nav-btn csay-prev" aria-label="Previous testimonial" style="color: #ff69b4">
                <svg class="ico" aria-hidden="true">
                  <use href="#i-arrow-left"></use>
                </svg>
              </button>
              <button class="csay__nav-btn csay-next" aria-label="Next testimonial" style="color: #ff69b4">
                <svg class="ico" aria-hidden="true">
                  <use href="#i-arrow-right"></use>
                </svg>
              </button>
            </div>
          </div>
        </div>

        <div class="csay__slider reveal">
          <div class="swiper csay-swiper">
            <div class="swiper-wrapper">
              <?php if (!empty($testimonials)) : ?>
                <?php foreach ($testimonials as $t) : ?>
                  <div class="swiper-slide">
                    <div class="csay__card">
                      <div class="csay__logo">
                        <img src="<?= base_url(file_exists(FCPATH . 'assets/uploads/testimonials/' . $t['logo']) ? 'assets/uploads/testimonials/' . $t['logo'] : 'assets/assets/' . $t['logo']) ?>" alt="<?= esc($t['brand_name']) ?>">
                      </div>
                      <h4 class="csay__name"><?= esc($t['brand_name']) ?></h4>
                      <div class="csay__stars"><?= str_repeat('★', (int)$t['rating']) ?></div>
                      <p class="csay__text"><?= esc($t['text']) ?></p>
                      <span class="csay__quote">❝</span>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <div class="swiper-slide">
                  <div class="csay__card">
                    <div class="csay__logo">
                      <img src="<?= base_url('assets/assets/alfatih.png') ?>" alt="Al Fatih Umrah">
                    </div>
                    <h4 class="csay__name">Al Fatih Umrah</h4>
                    <div class="csay__stars">★★★★★</div>
                    <p class="csay__text">Website yang dibuat sangat profesional, modern, dan user friendly. Tim sangat responsif and detail.</p>
                    <span class="csay__quote">❝</span>
                  </div>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <hr class="divider-metallic">

    <!-- CONTACT -->
    <section class="section" id="contact" data-spot="contact">
      <div class="container">
        <!-- Section Header Row -->
        <div class="portfolio-header-row reveal" style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; margin-bottom: 40px; gap: 24px;">
          <div class="section__head" style="text-align: left; margin: 0; max-width: 500px;">
            <p style="font-size: 14px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #ff69b4; margin-bottom: 8px;">GET IN TOUCH</p>
            <h2 class="section__title" style="font-size: 48px; line-height: 1.1; margin-bottom: 16px; color: var(--text); font-family: serif;">Let's <span style="color: #ff69b4;">Connect</span></h2>
            <p class="section__sub" style="font-size: 15px; color: var(--muted); margin: 0;">Balas cepat via email / WhatsApp.</p>
          </div>
        </div>

        <div class="contact__grid">
          <div class="card3d contact__card reveal" data-tilt data-tilt-strength="10">
            <h3><svg class="ico" aria-hidden="true">
                <use href="#i-chat"></use>
              </svg> Send a message</h3>
            <form id="contactForm" class="form" method="POST" action="https://formspree.io/f/xeeoyydw">
              <label>
                <span>Name</span>
                <input type="text" name="name" placeholder="Nama kamu" required />
              </label>
              <label>
                <span>Email</span>
                <input type="email" name="email" placeholder="nama@email.com" required />
              </label>
              <label>
                <span>Message</span>
                <textarea name="message" rows="5" placeholder="Brief singkat..." required></textarea>
              </label>
              <button class="btn btn--primary" type="submit" data-tilt data-tilt-strength="12">
                <svg class="ico" aria-hidden="true">
                  <use href="#i-send"></use>
                </svg>
                Send
                <span class="btn__glow" aria-hidden="true"></span>
              </button>
              <p class="muted small">* Data akan dikirim melalui email.</p>
            </form>
          </div>

          <div class="contact__side">
            <div class="card3d contact__card reveal" data-tilt data-tilt-strength="10">
              <?php $sMap = array_column($socials ?? [], 'url', 'platform'); ?>
              <h3><svg class="ico" aria-hidden="true">
                  <use href="#i-link"></use>
                </svg> Quick links</h3>
              <div class="links">
                <a target="_blank" class="link" href="<?= esc($sMap['instagram'] ?? '#') ?>" id="linkIG">
                  <span class="link__l">
                    <svg class="ico" aria-hidden="true">
                      <use href="#i-instagram"></use>
                    </svg>
                    Instagram
                  </span>
                  <span class="link__r">↗</span>
                </a>
                <a target="_blank" class="link" href="<?= esc($sMap['tiktok'] ?? '#') ?>" id="linkTT">
                  <span class="link__l">
                    <svg class="ico" aria-hidden="true">
                      <use href="#i-tiktok"></use>
                    </svg>
                    TikTok
                  </span>
                  <span class="link__r">↗</span>
                </a>
                <a target="_blank" class="link" href="<?= esc($sMap['youtube'] ?? '#') ?>" id="linkYT">
                  <span class="link__l">
                    <svg class="ico" aria-hidden="true">
                      <use href="#i-youtube"></use>
                    </svg>
                    YouTube
                  </span>
                  <span class="link__r">↗</span>
                </a>
                <a target="_blank" class="link" href="mailto:<?= esc($sMap['email'] ?? 'annisa@example.com') ?>" id="linkEmail">
                  <span class="link__l">
                    <svg class="ico" aria-hidden="true">
                      <use href="#i-mail"></use>
                    </svg>
                    Email
                  </span>
                  <span class="link__r">↗</span>
                </a>
                <a target="_blank" class="link" href="<?= esc($sMap['lemon8'] ?? 'https://s.lemon8-app.com/s/GgUMhyccpw') ?>" id="linkLemon">
                  <span class="link__l">
                    <span>🍋</span>
                    Lemon
                  </span>
                  <span class="link__r">↗</span>
                </a>
              </div>

              <div style="margin-top: 12px;" class="wa">
                <a class="btn btn--ghost w-full" href="<?= esc($sMap['whatsapp'] ?? '#') ?>" id="whatsappBtn" data-tilt data-tilt-strength="12">
                  <svg class="ico" aria-hidden="true">
                    <use href="#i-whatsapp"></use>
                  </svg>
                  WhatsApp
                </a>
              </div>
            </div>

            <div style="margin-top: 15px;" class="card3d contact__card reveal" data-tilt data-tilt-strength="10">
              <h3><svg class="ico" aria-hidden="true">
                  <use href="#i-clock"></use>
                </svg> Availability</h3>
              <p class="muted clamp-2">Open untuk monthly retainer & campaign.</p>
              <div class="availability">
                <span class="badge"><i></i> Open</span>
                <span class="muted small">Response: 2–6 jam</span>
              </div>
            </div>
          </div>
        </div>

        <footer class="footer">
          <div class="muted small">© <span id="year"></span> <?= esc($settings['site_title'] ?? 'Annisa Esce') ?> - All rights reserved.</div>
      </div>
      </footer>
      </div>
    </section>
  </main>

  <!-- FLOATING QUICK BUTTONS -->
  <div class="floatbar" aria-label="Quick actions">
    <a class="floatbar__btn floatbar__btn--wa" id="fabWhatsApp" href="<?= esc($sMap['whatsapp'] ?? '#') ?>" target="_blank" rel="noreferrer"
      data-label="WhatsApp" aria-label="WhatsApp">
      <svg class="ico" aria-hidden="true">
        <use href="#i-whatsapp"></use>
      </svg>
    </a>
    <a class="floatbar__btn" id="fabInstagram" href="<?= esc($sMap['instagram'] ?? '#') ?>" target="_blank" rel="noreferrer" data-label="Instagram"
      aria-label="Instagram">
      <svg class="ico" aria-hidden="true">
        <use href="#i-instagram"></use>
      </svg>
    </a>
    <a class="floatbar__btn" id="fabTikTok" href="<?= esc($sMap['tiktok'] ?? '#') ?>" target="_blank" rel="noreferrer" data-label="TikTok"
      aria-label="TikTok">
      <svg class="ico" aria-hidden="true">
        <use href="#i-tiktok"></use>
      </svg>
    </a>
    <a class="floatbar__btn" id="fabLemon" href="<?= esc($sMap['lemon8'] ?? 'https://s.lemon8-app.com/s/GgUMhyccpw') ?>" target="_blank"
      rel="noreferrer" data-label="Lemon" aria-label="TikTok">
      🍋
    </a>
    <button class="floatbar__btn floatbar__btn--theme" id="fabTheme" type="button" data-label="Theme"
      aria-label="Toggle theme">
      <svg class="ico" id="fabMoon" aria-hidden="true">
        <use href="#i-moon"></use>
      </svg>
      <svg class="ico hidden" id="fabSun" aria-hidden="true">
        <use href="#i-sun"></use>
      </svg>
    </button>
  </div>

  <!-- MODAL -->
  <div class="modal" id="modal" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Project case study">
    <div class="modal__backdrop" data-close-modal></div>
    <div class="modal__panel" role="document">
      <!-- <button class="modal__close" aria-label="Tutup" data-close-modal>✕ Close</button> -->
      <div class="modal__content">
        <!-- Media (Slider/Video) at the top -->
        <div class="modal__media" id="modalMedia">
          <div class="main-media" id="mainMedia"></div>
          <div class="thumbnail-gallery-wrapper" id="thumbnailGalleryWrapper" style="display: none;">
            <button class="slider-btn prev" id="sliderPrev" aria-label="Previous">&larr;</button>
            <div class="thumbnail-gallery" id="thumbnailGallery"></div>
            <button class="slider-btn next" id="sliderNext" aria-label="Next">&rarr;</button>
          </div>
        </div>

        <div class="modal__top">
          <div class="modal__tag" id="modalTag">Platform</div>
          <h3 class="modal__title" id="modalTitle">Project Title</h3>
          <p class="modal__desc" id="modalDesc">Description</p>
          <ul class="modal__bullets" id="modalBullets" style="margin-top: 16px; padding-left: 0; list-style: none; display: flex; flex-direction: column; gap: 8px;"></ul>
        </div>

        <div class="modal__actions">
          <a class="btn btn--primary" id="modalOutcomeBtn" href="#contact" data-close-modal>
            <svg class="ico" aria-hidden="true">
              <use href="#i-spark"></use>
            </svg>
            <span id="modalOutcomeText">Start a Project</span>
            <span class="btn__glow" aria-hidden="true"></span>
          </a>
          <button class="btn btn--ghost" data-close-modal>
            <svg class="ico" aria-hidden="true">
              <use href="#i-x"></use>
            </svg>
            Close
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- TOAST -->
  <div class="toast" id="toast" role="status" aria-live="polite" aria-atomic="true"></div>

  <!-- SVG ICON SPRITE (no library) -->
  <svg class="sprite" aria-hidden="true">
    <symbol id="i-arrow-right" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <line x1="5" y1="12" x2="19" y2="12"></line>
      <polyline points="12 5 19 12 12 19"></polyline>
    </symbol>
    <symbol id="i-arrow-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <line x1="19" y1="12" x2="5" y2="12"></line>
      <polyline points="12 19 5 12 12 5"></polyline>
    </symbol>

    <symbol id="i-chevron-right" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <polyline points="9 18 15 12 9 6"></polyline>
    </symbol>
    <symbol id="i-moon" viewBox="0 0 24 24">
      <path d="M21 14.5A8.5 8.5 0 0 1 9.5 3a7 7 0 1 0 11.5 11.5Z" fill="currentColor" />
    </symbol>
    <symbol id="i-sun" viewBox="0 0 24 24">
      <path d="M12 18a6 6 0 1 0 0-12 6 6 0 0 0 0 12Z" fill="currentColor" />
      <path d="M12 2v2M12 20v2M4 12H2M22 12h-2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M19.1 4.9l-1.4 1.4M6.3 17.7l-1.4 1.4"
        stroke="currentColor" stroke-width="2" stroke-linecap="round" />
    </symbol>

    <symbol id="i-instagram" viewBox="0 0 24 24">
      <path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5Z" fill="none"
        stroke="currentColor" stroke-width="2" />
      <path d="M12 16a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" fill="none" stroke="currentColor" stroke-width="2" />
      <path d="M17.5 6.5h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
    </symbol>

    <symbol id="i-youtube" viewBox="0 0 24 24">
      <path
        d="M21.8 8.1s-.2-1.6-.8-2.3c-.8-.9-1.7-.9-2.1-1C15.9 4.5 12 4.5 12 4.5h0s-3.9 0-6 .3c-.4.1-1.3.1-2.1 1C3.3 6.5 3.1 8.1 3.1 8.1S2.8 10 2.8 11.9v.2c0 1.9.3 3.8.3 3.8s.2 1.6.8 2.3c.8.9 1.9.9 2.4 1 1.7.2 5.7.3 5.7.3s3.9 0 6-.3c.4-.1 1.3-.1 2.1-1 .6-.7.8-2.3.8-2.3s.3-1.9.3-3.8v-.2c0-1.9-.3-3.8-.3-3.8Z"
        fill="none" stroke="currentColor" stroke-width="1.6" />
      <path d="M10 9.5v5l5-2.5-5-2.5Z" fill="currentColor" />
    </symbol>

    <symbol id="i-tiktok" viewBox="0 0 24 24">
      <path d="M14 3v10.2a3.8 3.8 0 1 1-3-3.7V7.2a6.4 6.4 0 1 0 6.4 6.4V7.6c1.1.9 2.5 1.4 4 1.4V6a6 6 0 0 1-4-3h-3Z"
        fill="currentColor" />
    </symbol>

    <symbol id="i-whatsapp" viewBox="0 0 24 24">
      <path d="M20 11.9A8 8 0 1 1 6.4 6.4 8 8 0 0 1 20 11.9Z" fill="none" stroke="currentColor" stroke-width="2" />
      <path d="M7 20.5 8.2 17.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
      <path
        d="M10.2 9.5c.3-.6.6-.7 1-.7h.7c.2 0 .5.1.6.4l.7 1.6c.1.3.1.6-.1.8l-.5.6c.6 1 1.5 1.8 2.5 2.4l.6-.5c.2-.2.6-.2.9-.1l1.6.7c.3.1.4.4.4.6v.7c0 .4-.1.7-.7 1-1 .4-2.7.2-4.6-.8-2-.9-3.8-2.7-4.7-4.7-1-1.9-1.2-3.6-.8-4.6Z"
        fill="currentColor" opacity=".9" />
    </symbol>

    <symbol id="i-mail" viewBox="0 0 24 24">
      <path d="M4 6h16v12H4V6Z" fill="none" stroke="currentColor" stroke-width="2" />
      <path d="m4 7 8 6 8-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
    </symbol>
    <symbol id="i-send" viewBox="0 0 24 24">
      <path d="M3 11.5 21 3l-8.5 18-2.5-7L3 11.5Z" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linejoin="round" />
      <path d="M21 3 10 14" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
    </symbol>
    <symbol id="i-play" viewBox="0 0 24 24">
      <path d="M10 8.5v7l6-3.5-6-3.5Z" fill="currentColor" />
      <path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20Z" fill="none" stroke="currentColor" stroke-width="2" />
    </symbol>
    <symbol id="i-file" viewBox="0 0 24 24">
      <path d="M7 3h7l3 3v15H7V3Z" fill="none" stroke="currentColor" stroke-width="2" />
      <path d="M14 3v4h4" fill="none" stroke="currentColor" stroke-width="2" />
    </symbol>
    <symbol id="i-download" viewBox="0 0 24 24">
      <path d="M12 3v10" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
      <path d="m8 11 4 4 4-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
      <path d="M4 20h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
    </symbol>
    <symbol id="i-user" viewBox="0 0 24 24">
      <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z" fill="none" stroke="currentColor" stroke-width="2" />
      <path d="M4 21a8 8 0 0 1 16 0" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
    </symbol>
    <symbol id="i-clock" viewBox="0 0 24 24">
      <path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20Z" fill="none" stroke="currentColor" stroke-width="2" />
      <path d="M12 6v6l4 2" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
    </symbol>
    <symbol id="i-link" viewBox="0 0 24 24">
      <path d="M10 13a5 5 0 0 0 7.1 0l1.4-1.4a5 5 0 0 0-7.1-7.1L10.6 4.3" fill="none" stroke="currentColor"
        stroke-width="2" stroke-linecap="round" />
      <path d="M14 11a5 5 0 0 0-7.1 0L5.5 12.4a5 5 0 1 0 7.1 7.1L13.4 19.7" fill="none" stroke="currentColor"
        stroke-width="2" stroke-linecap="round" />
    </symbol>
    <symbol id="i-x" viewBox="0 0 24 24">
      <path d="M6 6 18 18M18 6 6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
    </symbol>
    <symbol id="i-chat" viewBox="0 0 24 24">
      <path d="M4 5h16v11H7l-3 3V5Z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
    </symbol>
    <symbol id="i-spark" viewBox="0 0 24 24">
      <path d="M12 2l1.4 5.2L19 9l-5.6 1.8L12 16l-1.4-5.2L5 9l5.6-1.8L12 2Z" fill="currentColor" />
      <path d="M5 14l.8 3L9 18l-3.2 1-.8 3-.8-3L1 17l3.2-1 .8-3Z" fill="currentColor" opacity=".65" />
    </symbol>
    <symbol id="i-briefcase" viewBox="0 0 24 24">
      <path d="M9 6V5a2 2 0 0 1 2-2h2a2 2 0 0 1 2 2v1" fill="none" stroke="currentColor" stroke-width="2" />
      <path d="M4 7h16v13H4V7Z" fill="none" stroke="currentColor" stroke-width="2" />
      <path d="M4 12h16" stroke="currentColor" stroke-width="2" />
    </symbol>
    <symbol id="i-sliders" viewBox="0 0 24 24">
      <path d="M4 21v-7M4 10V3M12 21v-9M12 8V3M20 21v-5M20 12V3" stroke="currentColor" stroke-width="2"
        stroke-linecap="round" />
      <path d="M2 14h4M10 12h4M18 16h4" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
    </symbol>
    <symbol id="i-tool" viewBox="0 0 24 24">
      <path d="M14 7 7 14l3 3 7-7-3-3Z" fill="none" stroke="currentColor" stroke-width="2" stroke-linejoin="round" />
      <path d="M16 3 21 8" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
      <path d="M3 21l5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
    </symbol>
    <symbol id="i-grid" viewBox="0 0 24 24">
      <path d="M4 4h7v7H4V4Zm9 0h7v7h-7V4ZM4 13h7v7H4v-7Zm9 0h7v7h-7v-7Z" fill="currentColor" />
    </symbol>
    <symbol id="i-layers" viewBox="0 0 24 24">
      <path d="m12 3 9 6-9 6-9-6 9-6Z" fill="none" stroke="currentColor" stroke-width="2" />
      <path d="m3 15 9 6 9-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
    </symbol>
    <symbol id="i-switch" viewBox="0 0 24 24">
      <path d="M7 7h10a5 5 0 0 1 0 10H7A5 5 0 0 1 7 7Z" fill="none" stroke="currentColor" stroke-width="2" />
      <path d="M9 12a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" fill="currentColor" />
    </symbol>
    <symbol id="i-info" viewBox="0 0 24 24">
      <path d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20Z" fill="none" stroke="currentColor" stroke-width="2" />
      <path d="M12 10v7" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
      <path d="M12 7h.01" stroke="currentColor" stroke-width="3" stroke-linecap="round" />
    </symbol>
    <symbol id="i-award" viewBox="0 0 24 24">
      <path d="M12 3a6 6 0 1 0 0 12 6 6 0 0 0 0-12Z" fill="none" stroke="currentColor" stroke-width="2" />
      <path d="M8.5 14.5 7 22l5-2 5 2-1.5-7.5" fill="none" stroke="currentColor" stroke-width="2"
        stroke-linejoin="round" />
      <path d="M10.2 9.2 12 7l1.8 2.2 2.7.7-1.7 2.2.1 2.9L12 14l-2.9 1.1.1-2.9-1.7-2.2 2.7-.7Z" fill="currentColor"
        opacity=".9" />
    </symbol>
    <symbol id="i-lemon-premium" viewBox="0 0 24 24">
      <path d="M7 6c3-3 7-3 10 0s3 7 0 10-7 3-10 0-3-7 0-10Z" fill="currentColor" />
      <path d="M12 8v8M8 12h8" stroke="#fff" stroke-width="1" opacity="0.4" />
      <path d="M6 4c-1.5-1-3-1-4 0M18 20c1.5 1 3 1 4 0" stroke="currentColor" stroke-width="1.5"
        stroke-linecap="round" />
    </symbol>
    <symbol id="i-lemon-outline" viewBox="0 0 24 24">
      <path d="M7 7c3-3 7-3 10 0s3 7 0 10-7 3-10 0-3-7 0-10Z" fill="none" stroke="currentColor" stroke-width="2" />
      <path d="M5 5c-1.5-1-3-1-4 0M19 19c1.5 1 3 1 4 0" stroke="currentColor" stroke-width="1.5"
        stroke-linecap="round" />
    </symbol>


  </svg>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    window.PROJECTS = <?= json_encode(array_map(function ($p) {
                        return [
                          'id' => 'p' . $p['id'],
                          'platform' => $p['category_slug'] ?? 'travel',
                          'title' => $p['title'],
                          'desc' => $p['description'],
                          'views' => $p['views'] ?? '',
                          'ctr' => $p['ctr'] ?? '',
                          'outcome' => $p['project_link'] ?? '',
                          'tag' => $p['tag'] ?? '',
                          'bullets' => $p['bullets'] ?? [],
                          'thumb' => base_url('assets/uploads/projects/' . $p['thumbnail']),
                          'images' => $p['images'] ?? [],
                          'gallery' => $p['gallery'] ?? [],
                          'youtube' => $p['youtube_url'] ?? ''
                        ];
                      }, $projects)) ?>;
    window.LINKS = {
      instagram: "<?= esc($sMap['instagram'] ?? 'https://www.instagram.com/annisaesce/') ?>",
      tiktok: "<?= esc($sMap['tiktok'] ?? 'https://www.tiktok.com/@annisaesce') ?>",
      youtube: "<?= esc($sMap['youtube'] ?? 'https://www.youtube.com/@AnnisaHanif') ?>",
      email: "mailto:<?= esc($sMap['email'] ?? 'annisahanif161@gmail.com') ?>",
      whatsapp: "<?= esc($sMap['whatsapp'] ?? 'https://wa.me/6289519561589?text=Halo%20saya%20mau%20collab%20untuk%20project%20konten.') ?>"
    };
  </script>
  <script src="<?= base_url('assets/script.js?v=' . time()) ?>" defer></script>

  <script
    type="text/javascript">
    window.$crisp = [];
    window.CRISP_WEBSITE_ID = "db91ee50-f9dd-4b59-97c3-53d4a9a13353";
    (function() {
      d = document;
      s = d.createElement("script");
      s.src = "https://client.crisp.chat/l.js";
      s.async = 1;
      d.getElementsByTagName("head")[0].appendChild(s);
    })();
  </script>

  <script>
    window.$crisp = window.$crisp || [];
    $crisp.push(["config", "position:reverse", true]);
  </script>

</body>

</html>