<?php
if (!function_exists('getAchSvgPlaceholder')) {
  function getAchSvgPlaceholder($title = 'No Image Available', $w = 600, $h = 420)
  {
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $w . '" height="' . $h . '" viewBox="0 0 ' . $w . ' ' . $h . '">'
      . '<defs>'
      . '<linearGradient id="g" x1="0%" y1="0%" x2="100%" y2="100%">'
      . '<stop offset="0%" stop-color="#140f1d"/>'
      . '<stop offset="50%" stop-color="#231730"/>'
      . '<stop offset="100%" stop-color="#180e24"/>'
      . '</linearGradient>'
      . '</defs>'
      . '<rect width="100%" height="100%" fill="url(#g)"/>'
      . '<rect x="8" y="8" width="' . ($w - 16) . '" height="' . ($h - 16) . '" rx="16" fill="none" stroke="#ff69b4" stroke-width="1.5" stroke-opacity="0.25" stroke-dasharray="6 6"/>'
      . '<g transform="translate(' . ($w / 2) . ', ' . ($h / 2 - 18) . ')">'
      . '<circle r="34" fill="#ff69b4" fill-opacity="0.12" stroke="#ff69b4" stroke-width="1.5" stroke-opacity="0.3"/>'
      . '<path d="M-12 -8 h24 a2 2 0 0 1 2 2 v16 a2 2 0 0 1 -2 2 h-24 a2 2 0 0 1 -2 -2 v-16 a2 2 0 0 1 2 -2 Z M-8 6 l6 -6 l5 5 l4 -4 l5 5" fill="none" stroke="#ff80ab" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>'
      . '<circle cx="6" cy="-2" r="2.5" fill="#ff80ab"/>'
      . '</g>'
      . '<text x="50%" y="' . ($h / 2 + 36) . '" dominant-baseline="middle" text-anchor="middle" fill="#ff80ab" font-family="sans-serif" font-size="14" font-weight="700">NO IMAGE</text>'
      . '<text x="50%" y="' . ($h / 2 + 56) . '" dominant-baseline="middle" text-anchor="middle" fill="#a090b0" font-family="sans-serif" font-size="11">Foto belum di-upload</text>'
      . '</svg>';
    return 'data:image/svg+xml;base64,' . base64_encode($svg);
  }
}

if (!function_exists('getLogoSvgPlaceholder')) {
  function getLogoSvgPlaceholder($name = 'LOGO', $w = 200, $h = 80)
  {
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $w . '" height="' . $h . '" viewBox="0 0 ' . $w . ' ' . $h . '">'
      . '<rect width="100%" height="100%" rx="12" fill="#231730"/>'
      . '<rect x="2" y="2" width="' . ($w - 4) . '" height="' . ($h - 4) . '" rx="10" fill="none" stroke="#ff69b4" stroke-width="1" stroke-opacity="0.2"/>'
      . '<text x="50%" y="50%" dominant-baseline="middle" text-anchor="middle" fill="#ff80ab" font-family="sans-serif" font-size="13" font-weight="700">' . htmlspecialchars($name) . '</text>'
      . '</svg>';
    return 'data:image/svg+xml;base64,' . base64_encode($svg);
  }
}

if (!function_exists('resolveAchieveIconClass')) {
  function resolveAchieveIconClass($icon, $default = 'bi bi-award-fill')
  {
    if (empty($icon)) {
      return $default;
    }
    $icon = trim($icon);
    if (str_starts_with($icon, 'bi-')) {
      return 'bi ' . $icon;
    }
    if (str_contains($icon, 'bi ') || str_contains($icon, 'ri-') || str_contains($icon, 'fa-')) {
      return $icon;
    }
    $lower = strtolower($icon);
    if (str_contains($lower, 'film') || str_contains($lower, 'movie') || str_contains($lower, 'cinema') || str_contains($lower, 'festival')) {
      return 'bi bi-film';
    }
    if (str_contains($lower, 'award') || str_contains($lower, 'winner') || str_contains($lower, 'juara') || str_contains($lower, 'documentary')) {
      return 'bi bi-award-fill';
    }
    if (str_contains($lower, 'trophy') || str_contains($lower, 'champion')) {
      return 'bi bi-trophy-fill';
    }
    if (str_contains($lower, 'star') || str_contains($lower, 'creator')) {
      return 'bi bi-star-fill';
    }
    if (str_contains($lower, 'edu') || str_contains($lower, 'book') || str_contains($lower, 'academy') || str_contains($lower, 'pendidikan')) {
      return 'bi bi-mortarboard-fill';
    }
    if (preg_match('/^[a-zA-Z0-9_-]+$/', $icon)) {
      return 'bi bi-' . $icon;
    }
    return $default;
  }
}
?>
<!doctype html>
<html lang="id" data-theme="dark">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="theme-color" content="#060711" />

  <!-- FAVICON -->
  <link rel="icon" type="image/jpeg" href="<?= base_url('assets/uploads/logo.jpeg') ?>">
  <link rel="shortcut icon" type="image/jpeg" href="<?= base_url('assets/uploads/logo.jpeg') ?>">

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
    /* Achievements Timeline Icon Styling */
    .achieve-icon {
      flex-shrink: 0 !important;
      width: 44px !important;
      height: 44px !important;
      border-radius: 50% !important;
      background: linear-gradient(135deg, #ff69b4, #d65a7f) !important;
      color: #ffffff !important;
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      box-shadow: 0 4px 15px rgba(255, 105, 180, 0.35) !important;
    }

    .achieve-icon i {
      font-size: 20px !important;
      color: #ffffff !important;
      line-height: 1 !important;
    }

    .achieve-icon .ico {
      width: 22px !important;
      height: 22px !important;
      fill: #ffffff !important;
    }

    /* Achievements Photo Uncropped (100% Fit & No Cutting) */
    .main-achieve__photo {
      display: flex !important;
      align-items: center !important;
      justify-content: center !important;
      background: rgba(10, 6, 18, 0.45) !important;
      padding: 20px !important;
      min-height: 380px !important;
      overflow: hidden !important;
    }

    .main-achieve__photo img {
      position: relative !important;
      top: auto !important;
      left: auto !important;
      width: 100% !important;
      height: 100% !important;
      max-height: 480px !important;
      object-fit: contain !important;
      object-position: center !important;
      border-radius: 14px !important;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.35) !important;
    }

    .main-achieve__photo::after {
      display: none !important;
    }

    .main-achieve__photo-text {
      display: none !important;
    }

    .achieve-item__photo img {
      object-fit: contain !important;
      background: rgba(10, 6, 18, 0.35) !important;
      padding: 8px !important;
    }

    @media (max-width: 992px) {
      .main-achieve__photo {
        min-height: 260px !important;
        padding: 14px !important;
      }

      .main-achieve__photo img {
        max-height: 360px !important;
      }
    }

    /* Achievement Detail Trigger Buttons & Modal */
    .main-achieve__action-wrap {
      margin-top: 24px;
    }

    .btn-achieve-detail {
      display: inline-flex;
      align-items: center;
      background: linear-gradient(135deg, #ff69b4 0%, #d65a7f 100%);
      color: #ffffff !important;
      border: none;
      border-radius: 50px;
      padding: 11px 26px;
      font-size: 13.5px;
      font-weight: 600;
      letter-spacing: 0.3px;
      cursor: pointer;
      box-shadow: 0 4px 18px rgba(255, 105, 180, 0.35);
      transition: all 0.25s ease;
    }

    .btn-achieve-detail:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(255, 105, 180, 0.5);
    }

    .btn-achieve-detail-sm {
      display: inline-flex;
      align-items: center;
      gap: 5px;
      background: rgba(255, 105, 180, 0.12);
      border: 1px solid rgba(255, 105, 180, 0.35);
      color: #ff80ab !important;
      border-radius: 999px;
      padding: 6px 16px;
      font-size: 12.5px;
      font-weight: 600;
      margin-top: 14px;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .btn-achieve-detail-sm:hover {
      background: #ff69b4;
      border-color: #ff69b4;
      color: #ffffff !important;
      transform: translateY(-2px);
      box-shadow: 0 4px 15px rgba(255, 105, 180, 0.4);
    }

    .main-achieve__photo[data-achieve-detail],
    .achieve-item__photo[data-achieve-detail] {
      cursor: pointer;
    }

    .achieve-photo-zoom-badge {
      position: absolute;
      bottom: 14px;
      right: 14px;
      background: rgba(15, 8, 22, 0.85);
      border: 1px solid rgba(255, 105, 180, 0.4);
      color: #ff80ab;
      padding: 4px 12px;
      border-radius: 999px;
      font-size: 11px;
      font-weight: 600;
      backdrop-filter: blur(8px);
      opacity: 0;
      transform: translateY(6px);
      transition: all 0.25s ease;
      pointer-events: none;
      z-index: 5;
    }

    .main-achieve__photo:hover .achieve-photo-zoom-badge,
    .achieve-item__photo:hover .achieve-photo-zoom-badge {
      opacity: 1;
      transform: translateY(0);
    }

    /* Modal Overlay & Dialog */
    .achieve-modal {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      z-index: 9999999;
      display: none;
      opacity: 0;
      transition: opacity 0.25s ease;
    }

    .achieve-modal.active {
      display: block;
      opacity: 1;
    }

    .achieve-modal__backdrop {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(4, 2, 10, 0.82);
      backdrop-filter: blur(12px);
      -webkit-backdrop-filter: blur(12px);
    }

    .achieve-modal__container {
      position: relative;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
      pointer-events: none;
    }

    .achieve-modal__dialog {
      position: relative;
      width: 100%;
      max-width: 860px;
      max-height: 90vh;
      background: linear-gradient(145deg, rgba(28, 14, 38, 0.96) 0%, rgba(14, 10, 22, 0.98) 100%);
      border: 1px solid rgba(255, 105, 180, 0.28);
      border-radius: 24px;
      box-shadow: 0 25px 70px rgba(0, 0, 0, 0.7), 0 0 50px rgba(255, 105, 180, 0.2);
      pointer-events: auto;
      overflow-y: auto;
      transform: scale(0.94) translateY(20px);
      transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .achieve-modal.active .achieve-modal__dialog {
      transform: scale(1) translateY(0);
    }

    .achieve-modal__close {
      position: absolute;
      top: 18px;
      right: 18px;
      width: 38px;
      height: 38px;
      border-radius: 50%;
      background: rgba(255, 105, 180, 0.15);
      border: 1px solid rgba(255, 105, 180, 0.3);
      color: #ffffff;
      font-size: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      z-index: 10;
      transition: all 0.2s ease;
    }

    .achieve-modal__close:hover {
      background: #ff69b4;
      transform: scale(1.1) rotate(90deg);
      box-shadow: 0 0 15px rgba(255, 105, 180, 0.6);
    }

    .achieve-modal__body {
      display: flex;
      flex-wrap: wrap;
      padding: 32px;
      gap: 28px;
    }

    .achieve-modal__media {
      flex: 1 1 360px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: rgba(8, 5, 14, 0.5);
      border: 1px solid rgba(255, 105, 180, 0.15);
      border-radius: 18px;
      padding: 16px;
    }

    .achieve-modal__img-box {
      width: 100%;
      min-height: 260px;
      max-height: 380px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .achieve-modal__img-box img {
      width: 100%;
      height: 100%;
      max-height: 380px;
      object-fit: contain;
      border-radius: 10px;
    }

    .achieve-modal__zoom-link {
      display: inline-flex;
      align-items: center;
      font-size: 12px;
      color: #ff80ab;
      text-decoration: none;
      margin-top: 12px;
      opacity: 0.85;
      transition: all 0.2s ease;
    }

    .achieve-modal__zoom-link:hover {
      opacity: 1;
      color: #ff69b4;
      text-decoration: underline;
    }

    .achieve-modal__info {
      flex: 1 1 340px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .achieve-modal__tags {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-bottom: 14px;
    }

    .achieve-modal__tag {
      font-size: 11.5px;
      font-weight: 700;
      padding: 4px 12px;
      border-radius: 999px;
      letter-spacing: 0.5px;
      text-transform: uppercase;
    }

    .achieve-modal__tag--cat {
      background: rgba(255, 105, 180, 0.15);
      border: 1px solid rgba(255, 105, 180, 0.35);
      color: #ff80ab;
    }

    .achieve-modal__tag--year {
      background: rgba(255, 255, 255, 0.1);
      border: 1px solid rgba(255, 255, 255, 0.2);
      color: #ffffff;
    }

    .achieve-modal__tag--badge {
      background: #ff69b4;
      color: #ffffff;
    }

    .achieve-modal__title {
      font-family: serif;
      font-size: 24px;
      line-height: 1.3;
      color: #ffffff !important;
      margin: 0 0 10px;
      font-weight: 700;
      text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    }

    .achieve-modal__date {
      font-size: 13px;
      color: rgba(255, 255, 255, 0.75);
      margin-bottom: 18px;
    }

    .achieve-modal__section-heading {
      font-size: 12px;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #ff80ab;
      font-weight: 700;
      margin: 0 0 8px;
    }

    .achieve-modal__desc {
      font-size: 14px;
      color: rgba(255, 255, 255, 0.88) !important;
      line-height: 1.7;
      margin: 0 0 20px;
    }

    .achieve-modal__meta {
      display: flex;
      flex-direction: column;
      gap: 8px;
      background: rgba(255, 255, 255, 0.05);
      border-radius: 12px;
      padding: 12px 16px;
      margin-bottom: 22px;
    }

    .achieve-modal__meta-item {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }

    .achieve-modal__meta-item .meta-label {
      font-size: 11px;
      color: #ff80ab;
      font-weight: 600;
      text-transform: uppercase;
    }

    .achieve-modal__meta-item .meta-val {
      font-size: 13.5px;
      color: #ffffff;
      font-weight: 500;
    }

    .achieve-modal__footer {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .achieve-modal__btn-contact {
      display: inline-flex;
      align-items: center;
      background: linear-gradient(135deg, #ff69b4, #e66377);
      color: #ffffff !important;
      padding: 10px 22px;
      border-radius: 50px;
      font-size: 13px;
      font-weight: 600;
      text-decoration: none;
      box-shadow: 0 4px 15px rgba(255, 105, 180, 0.35);
      transition: all 0.25s ease;
    }

    .achieve-modal__btn-contact:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(255, 105, 180, 0.5);
    }

    @media (max-width: 768px) {
      .achieve-modal__body {
        padding: 24px 18px;
        gap: 20px;
      }

      .achieve-modal__title {
        font-size: 20px;
      }

      .achieve-modal__img-box {
        max-height: 280px;
      }
    }

    /* Achievements Empty State Styling */
    .achieve-empty-state {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 30px 16px 70px;
      width: 100%;
    }

    .achieve-empty-card {
      max-width: 560px;
      width: 100%;
      background: rgba(20, 10, 26, 0.85) !important;
      border: 1px solid rgba(255, 105, 180, 0.25) !important;
      border-radius: 24px !important;
      padding: 44px 32px 38px !important;
      text-align: center !important;
      position: relative !important;
      overflow: hidden !important;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4), 0 0 30px rgba(255, 105, 180, 0.12) !important;
      backdrop-filter: blur(16px) !important;
      -webkit-backdrop-filter: blur(16px) !important;
      margin: 0 auto !important;
    }

    .achieve-empty-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 260px;
      height: 2px;
      background: linear-gradient(90deg, transparent, #ff69b4, transparent);
    }

    .achieve-empty-icon-wrap {
      position: relative;
      margin: 0 auto 20px;
      width: 84px;
      height: 84px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .achieve-empty-circle {
      width: 76px;
      height: 76px;
      border-radius: 50%;
      background: linear-gradient(135deg, rgba(255, 105, 180, 0.2), rgba(230, 99, 119, 0.08));
      border: 1.5px solid rgba(255, 105, 180, 0.4);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #ff69b4;
      font-size: 34px;
      box-shadow: 0 0 30px rgba(255, 105, 180, 0.3);
      animation: achieveEmptyFloat 3s ease-in-out infinite alternate;
    }

    @keyframes achieveEmptyFloat {
      0% {
        transform: translateY(0px) scale(0.98);
      }

      100% {
        transform: translateY(-6px) scale(1.02);
      }
    }

    .achieve-empty-pill {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(255, 105, 180, 0.12);
      border: 1px solid rgba(255, 105, 180, 0.3);
      color: #ff80ab;
      padding: 5px 16px;
      border-radius: 999px;
      font-size: 11.5px;
      font-weight: 700;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      margin-bottom: 18px;
    }

    .achieve-pulse-dot {
      width: 8px;
      height: 8px;
      border-radius: 50%;
      background: #ff69b4;
      box-shadow: 0 0 10px #ff69b4;
      animation: achieveEmptyPulse 1.6s ease-in-out infinite;
    }

    @keyframes achieveEmptyPulse {

      0%,
      100% {
        opacity: 0.5;
        transform: scale(0.9);
      }

      50% {
        opacity: 1;
        transform: scale(1.25);
        box-shadow: 0 0 14px #ff69b4;
      }
    }

    .achieve-empty-title {
      font-family: serif !important;
      font-size: 26px !important;
      line-height: 1.25 !important;
      color: #ffffff !important;
      margin: 0 0 12px !important;
      font-weight: 700 !important;
      text-shadow: 0 2px 12px rgba(0, 0, 0, 0.6) !important;
    }

    .achieve-empty-desc {
      font-size: 14.5px !important;
      color: rgba(255, 255, 255, 0.9) !important;
      line-height: 1.7 !important;
      max-width: 460px !important;
      margin: 0 auto 26px !important;
      text-shadow: 0 1px 6px rgba(0, 0, 0, 0.5) !important;
    }

    .achieve-empty-desc .text-pink {
      color: #ff80ab !important;
      font-weight: 700 !important;
    }

    .achieve-empty-btn {
      display: inline-flex;
      align-items: center;
      background: linear-gradient(135deg, #ff69b4 0%, #e66377 100%);
      color: #ffffff !important;
      font-weight: 600;
      font-size: 13.5px;
      padding: 11px 26px;
      border-radius: 50px;
      text-decoration: none;
      box-shadow: 0 6px 20px rgba(255, 105, 180, 0.35);
      transition: all 0.25s ease;
    }

    .achieve-empty-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 28px rgba(255, 105, 180, 0.5);
      color: #ffffff !important;
    }

    @media (max-width: 768px) {
      .achieve-empty-card {
        padding: 36px 20px 32px;
      }

      .achieve-empty-title {
        font-size: 20px;
      }

      .achieve-empty-desc {
        font-size: 13px;
      }
    }

    /* Dynamic Section Backgrounds */
    #about.section::before {
      <?php if (!empty($about['bg_image'])): ?>
        background-image: url('<?= base_url('assets/uploads/about/' . $about['bg_image']) ?>') !important;
        background-size: cover !important;
        background-position: center !important;
        opacity: 1 !important;
        filter: none !important;
      <?php endif; ?>
    }

    @media (max-width: 768px) {
      #about.section::before {
        <?php if (!empty($about['bg_mobile'])): ?>
          background-image: url('<?= base_url('assets/uploads/about/' . $about['bg_mobile']) ?>') !important;
          background-size: cover !important;
          background-position: center !important;
          opacity: 1 !important;
          filter: none !important;
        <?php endif; ?>
      }
    }

    #brands.section::before,
    #brands {
      <?php if (!empty($brandSettings['bg_desktop'])): ?>
        background-image: url('<?= base_url('assets/uploads/brands/' . $brandSettings['bg_desktop']) ?>') !important;
        background-size: cover !important;
        background-position: center !important;
      <?php endif; ?>
    }

    @media (max-width: 768px) {

      #brands.section::before,
      #brands {
        <?php if (!empty($brandSettings['bg_mobile'])): ?>
          background-image: url('<?= base_url('assets/uploads/brands/' . $brandSettings['bg_mobile']) ?>') !important;
          background-size: cover !important;
          background-position: center !important;
        <?php endif; ?>
      }
    }
  </style>

  <!-- ICON -->
  <link rel="icon" type="image/jpeg"
    href="<?= !empty($settings['site_logo']) ? base_url('assets/uploads/settings/' . $settings['site_logo']) : base_url('assets/logo.jpeg') ?>">
  <link rel="shortcut icon" type="image/jpeg"
    href="<?= !empty($settings['site_logo']) ? base_url('assets/uploads/settings/' . $settings['site_logo']) : base_url('assets/logo.jpeg') ?>">
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
  <!-- FEMININE FLORAL & BUTTERFLY PRELOADER (CIWI-CIWI ESTETIK) -->
  <div id="pageLoader" class="page-loader">
    <div class="loader-bg-glow"></div>
    <div class="loader-content">
      <!-- Aesthetic Butterfly & Flower SVG Container -->
      <div class="loader-art-wrap">
        <!-- Rotating Floral Wreath Ring -->
        <svg class="floral-wreath-ring" viewBox="0 0 200 200">
          <circle cx="100" cy="100" r="85" fill="none" stroke="rgba(255, 105, 180, 0.2)" stroke-width="1.5"
            stroke-dasharray="6 8" />
          <circle cx="100" cy="100" r="72" fill="none" stroke="url(#pinkGlowGrad)" stroke-width="2.5"
            stroke-dasharray="140 300" class="ring-spinner" />
          <defs>
            <linearGradient id="pinkGlowGrad" x1="0%" y1="0%" x2="100%" y2="100%">
              <stop offset="0%" stop-color="#ff69b4" />
              <stop offset="50%" stop-color="#ec407a" />
              <stop offset="100%" stop-color="#ab47bc" />
            </linearGradient>
          </defs>
        </svg>

        <!-- Animated Floating Petals & Sparkles -->
        <div class="loader-petals">
          <span class="petal p1">🌸</span>
          <span class="petal p2">✨</span>
          <span class="petal p3">🌺</span>
          <span class="petal p4">💖</span>
          <span class="petal p5">✨</span>
          <span class="petal p6">🌸</span>
        </div>

        <!-- Animated Glowing Pink Butterfly Center -->
        <div class="butterfly-box">
          <svg class="butterfly-svg" viewBox="0 0 100 100">
            <!-- Left Wing -->
            <path class="wing wing-left"
              d="M50 45 C35 15, 5 20, 10 45 C15 65, 38 60, 50 50 C40 65, 20 85, 30 90 C40 95, 48 70, 50 55 Z"
              fill="url(#wingGradLeft)" />
            <!-- Right Wing -->
            <path class="wing wing-right"
              d="M50 45 C65 15, 95 20, 90 45 C85 65, 62 60, 50 50 C60 65, 80 85, 70 90 C60 95, 52 70, 50 55 Z"
              fill="url(#wingGradRight)" />
            <!-- Body & Antenna -->
            <ellipse cx="50" cy="50" rx="3.5" ry="18" fill="#ffffff" />
            <path d="M49 33 Q42 22 36 20 M51 33 Q58 22 64 20" stroke="#ff80ab" stroke-width="2" stroke-linecap="round"
              fill="none" />
            <defs>
              <linearGradient id="wingGradLeft" x1="100%" y1="0%" x2="0%" y2="100%">
                <stop offset="0%" stop-color="#ff80ab" />
                <stop offset="50%" stop-color="#ec407a" />
                <stop offset="100%" stop-color="#8e44ad" />
              </linearGradient>
              <linearGradient id="wingGradRight" x1="0%" y1="0%" x2="100%" y2="100%">
                <stop offset="0%" stop-color="#ff80ab" />
                <stop offset="50%" stop-color="#ec407a" />
                <stop offset="100%" stop-color="#8e44ad" />
              </linearGradient>
            </defs>
          </svg>
        </div>
      </div>

      <!-- Text & Progress Bar -->
      <div class="loader-text-group">
        <h2 class="loader-brand-title">Annisa <span class="text-pink">Esce</span></h2>
        <p class="loader-subtitle">Creating Magic & Aesthetic Visuals ✨</p>
        <div class="loader-progress-track">
          <div class="loader-progress-fill" id="loaderProgress"></div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const loader = document.getElementById("pageLoader");
      const progress = document.getElementById("loaderProgress");

      if (progress) {
        setTimeout(function () {
          progress.style.width = "100%";
        }, 100);
      }

      function hideLoader() {
        if (loader && !loader.classList.contains("fade-out")) {
          loader.classList.add("fade-out");
          setTimeout(function () {
            loader.style.display = "none";
          }, 850);
        }
      }

      window.addEventListener("load", function () {
        setTimeout(hideLoader, 1000);
      });

      // Fallback timeout
      setTimeout(hideLoader, 2200);
    });
  </script>

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
            <?= esc($hero['title_line1'] ?? 'Konten yang') ?> <span class="typewrite" data-period="2000"
              data-type='<?= esc($hero['typewrite_words1'] ?? '[ "nempel,", "berkesan,", "viral," ]') ?>'><span
                class="wrap"></span></span><br>
            <?= esc($hero['title_line2'] ?? 'hasil yang') ?> <span class="typewrite" data-period="2000"
              data-type='<?= esc($hero['typewrite_words2'] ?? '[ "kerasa.", "nyata.", "maksimal." ]') ?>'><span
                class="wrap"></span></span>
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
          <!-- Animated Glowing Pink Butterfly Ornament (di luar frame, tidak ter-clip) -->
          <div class="frame-butterfly-ornament" title="Aesthetic Butterfly">
            <svg class="frame-butterfly-svg" viewBox="0 0 100 100">
              <!-- Left Wing -->
              <path class="f-wing f-wing-left"
                d="M50 45 C35 15, 5 20, 10 45 C15 65, 38 60, 50 50 C40 65, 20 85, 30 90 C40 95, 48 70, 50 55 Z"
                fill="url(#fWingGradLeft)" />
              <!-- Right Wing -->
              <path class="f-wing f-wing-right"
                d="M50 45 C65 15, 95 20, 90 45 C85 65, 62 60, 50 50 C60 65, 80 85, 70 90 C60 95, 52 70, 50 55 Z"
                fill="url(#fWingGradRight)" />
              <!-- Body & Antenna -->
              <ellipse cx="50" cy="50" rx="3.5" ry="18" fill="#ffffff" />
              <path d="M49 33 Q42 22 36 20 M51 33 Q58 22 64 20" stroke="#ff80ab" stroke-width="2" stroke-linecap="round"
                fill="none" />
              <defs>
                <linearGradient id="fWingGradLeft" x1="100%" y1="0%" x2="0%" y2="100%">
                  <stop offset="0%" stop-color="#ff9ebb" />
                  <stop offset="50%" stop-color="#ff4081" />
                  <stop offset="100%" stop-color="#ab47bc" />
                </linearGradient>
                <linearGradient id="fWingGradRight" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#ff9ebb" />
                  <stop offset="50%" stop-color="#ff4081" />
                  <stop offset="100%" stop-color="#ab47bc" />
                </linearGradient>
              </defs>
            </svg>
          </div>

          <div class="portrait card3d" data-tilt data-tilt-strength="16">
            <div class="portrait__frame">
              <div class="portrait__shine" aria-hidden="true"></div>

              <div class="portrait__avatar">
                <!-- No external image: data-uri placeholder -->
                <img class="avatar__img" alt="Your photo" loading="lazy" decoding="async"
                  src="<?= !empty($hero['photo']) ? base_url('assets/uploads/hero/' . $hero['photo']) : base_url('assets/header.jpg') ?>"
                  onerror="this.src='<?= getAchSvgPlaceholder('Annisa Esce', 400, 500) ?>'">
              </div>

              <div class="portrait__meta">
                <?php if (!empty($heroMeta)): ?>
                  <?php foreach ($heroMeta as $meta): ?>
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
          <?php if (!empty($heroStats)): ?>
            <?php foreach ($heroStats as $stat): ?>
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

            <h3 class="about2__title" id="butterfly-landing-target">
              <?= $about['title'] ?? 'Menciptakan konten yang <span class="text-pink">berkesan</span>, <br>bukan hanya sekadar viral.' ?>
            </h3>

            <p class="about2__text">
              <?= esc($about['description'] ?? 'Strategi, storytelling, dan visual yang dirancang untuk menarik perhatian dan mendorong aksi nyata.') ?>
            </p>

            <div class="about2__icons">
              <?php if (!empty($aboutIcons)): ?>
                <?php foreach ($aboutIcons as $ai): ?>
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
              <?php if (!empty($aboutMiniStats)): ?>
                <?php foreach ($aboutMiniStats as $ams): ?>
                  <div class="miniStat">
                    <span class="miniStat__k">
                      <i class="<?= esc($ams['icon']) ?>" style="font-size: 14px; color: #ff69b4;"></i>
                      <?= esc($ams['label']) ?>
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
            <?php if (!empty($aboutCards)): ?>
              <?php foreach ($aboutCards as $ac): ?>
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
        <div class="section__head reveal"
          style="text-align: center; margin-bottom: 40px; display: flex; flex-direction: column; align-items: center;">
          <p
            style="font-size: 14px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #ff69b4; margin-bottom: 8px;">
            OUR BRANDS</p>
          <h2 class="section__title" id="bfly-brands"
            style="font-size: 48px; line-height: 1.1; margin-bottom: 16px; color: var(--text); font-family: serif; text-align: center;">
            Brand &amp; Project We've <span style="color: #ff69b4;">Worked With</span></h2>
          <p class="section__sub"
            style="font-size: 15px; color: var(--muted); text-align: center; margin: 0 auto; max-width: 500px;">
            Kolaborasi nyata, hasil yang berdampak.</p>
        </div>

      </div>
      </div> <!-- End container -->

      <!-- Brands Grid Full Width -->
      <div class="swiper brands-swiper">
        <div class="swiper-wrapper">
          <?php if (!empty($brands)): ?>
            <?php foreach ($brands as $b): ?>
              <div class="swiper-slide">
                <div class="wp-brand-card">
                  <div class="wp-brand-logo">
                    <img
                      src="<?= base_url(file_exists(FCPATH . 'assets/uploads/brands/' . $b['logo']) ? 'assets/uploads/brands/' . $b['logo'] : 'assets/assets/' . $b['logo']) ?>"
                      alt="<?= esc($b['name']) ?>" onerror="this.src='<?= getLogoSvgPlaceholder(esc($b['name'])) ?>'">
                  </div>
                  <h3><?= esc($b['name']) ?></h3>
                  <span class="wp-brand-location">
                    <i class="ri-map-pin-line"></i> <?= esc($b['location']) ?>
                  </span>
                  <p><?= esc($b['description']) ?></p>
                  <?php if (!empty($b['project_link'])): ?>
                    <a href="<?= esc($b['project_link']) ?>" class="btn-view-project" target="_blank">View Project <svg
                        class="ico" aria-hidden="true">
                        <use href="#i-arrow-right"></use>
                      </svg></a>
                  <?php else: ?>
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
        <div class="portfolio-header-row reveal"
          style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; margin-bottom: 40px; gap: 24px;">

          <div class="section__head" style="text-align: left; margin: 0; max-width: 400px;">
            <p
              style="font-size: 14px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #ff69b4; margin-bottom: 8px;">
              PORTFOLIO</p>
            <h2 class="section__title" id="bfly-projects"
              style="font-size: 48px; line-height: 1.1; margin-bottom: 16px; color: var(--text); font-family: serif;">
              Our Selected <span style="color: #ff69b4;">Projects</span></h2>
            <p class="section__sub" style="font-size: 15px; color: var(--muted); margin: 0;">Kumpulan karya terbaik yang
              kami buat<br>dengan dedikasi dan sepenuh hati.</p>
          </div>

          <div class="portfolio-filters" role="tablist" aria-label="Filter projects"
            style="flex: 1; justify-content: flex-end; gap: 8px;">
            <button class="portfolio-filter active" data-filter="all" role="tab" aria-selected="true">All</button>
            <?php if (!empty($projectCategories)): ?>
              <?php foreach ($projectCategories as $cat): ?>
                <button class="portfolio-filter" data-filter="<?= esc($cat['slug']) ?>" role="tab"
                  aria-selected="false"><?= esc($cat['name']) ?></button>
              <?php endforeach; ?>
            <?php endif; ?>
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
        <div class="portfolio-header-row reveal"
          style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; margin-bottom: 40px; gap: 24px;">
          <div class="section__head" style="text-align: left; margin: 0; max-width: 400px;">
            <p
              style="font-size: 14px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #ff69b4; margin-bottom: 8px;">
              ACHIEVEMENTS</p>
            <h2 class="section__title" id="bfly-achievements"
              style="font-size: 48px; line-height: 1.1; margin-bottom: 16px; color: var(--text); font-family: serif;">
              Key <span style="color: #ff69b4;">Milestones</span></h2>
            <p class="section__sub" style="font-size: 15px; color: var(--muted); margin: 0;">Pencapaian dan momen
              penting selama berkarir.</p>
          </div>

          <div class="filters achieve-filters" role="tablist" aria-label="Filter achievements"
            style="flex: 1; justify-content: flex-end; gap: 8px; margin: 0;">
            <?php if (!empty($achievementCategories)): ?>
              <?php foreach ($achievementCategories as $idx => $cat): ?>
                <button class="filter <?= $idx === 0 ? 'active' : '' ?>" data-target="<?= esc($cat['slug']) ?>" role="tab"
                  aria-selected="<?= $idx === 0 ? 'true' : 'false' ?>">
                  <i class="<?= esc($cat['icon'] ?? 'bi bi-award-fill') ?>" style="margin-right: 4px;"></i>
                  <?= esc($cat['name']) ?>
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

        <?php if (!empty($achievementCategories)): ?>
          <?php foreach ($achievementCategories as $idx => $cat): ?>
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

              <?php if ($mainAch): ?>
                <?php
                $mainPlaceholder = getAchSvgPlaceholder('Highlight Achievement', 600, 420);
                $mainPhotoUrl = '';
                if (!empty($mainAch['photo'])) {
                  if (file_exists(FCPATH . 'assets/uploads/achievements/' . $mainAch['photo'])) {
                    $mainPhotoUrl = base_url('assets/uploads/achievements/' . $mainAch['photo']);
                  } elseif (file_exists(FCPATH . 'assets/images/' . $mainAch['photo'])) {
                    $mainPhotoUrl = base_url('assets/images/' . $mainAch['photo']);
                  } elseif (file_exists(FCPATH . 'assets/' . $mainAch['photo'])) {
                    $mainPhotoUrl = base_url('assets/' . $mainAch['photo']);
                  }
                }
                if (empty($mainPhotoUrl)) {
                  $mainPhotoUrl = $mainPlaceholder;
                }
                ?>
                <?php
                $mainAchJson = htmlspecialchars(json_encode([
                  'title' => $mainAch['title'] ?? '',
                  'year' => $mainAch['year'] ?? '',
                  'date_label' => $mainAch['date_label'] ?? '',
                  'badge' => $mainAch['badge_text'] ?? '',
                  'category' => $cat['name'] ?? 'Pencapaian',
                  'description' => $mainAch['description'] ?? '',
                  'photo' => $mainPhotoUrl,
                  'small_text' => $mainAch['small_text'] ?? '',
                  'heading_text' => $mainAch['heading_text'] ?? '',
                  'signature_text' => $mainAch['signature_text'] ?? ''
                ]), ENT_QUOTES, 'UTF-8');
                ?>
                <div class="main-achieve reveal">
                  <div class="main-achieve__photo" role="button" tabindex="0" title="Klik untuk melihat detail sertifikat"
                    data-achieve-detail="<?= $mainAchJson ?>">
                    <img src="<?= $mainPhotoUrl ?>" alt="<?= esc($mainAch['title']) ?>" loading="lazy"
                      onerror="this.src='<?= $mainPlaceholder ?>'">
                    <span class="achieve-photo-zoom-badge">
                      <i class="bi bi-zoom-in"></i> Klik untuk Detail
                    </span>
                  </div>
                  <div class="main-achieve__content">
                    <div class="main-achieve__year"><?= esc($mainAch['year']) ?></div>
                    <?php if (!empty($mainAch['badge_text'])): ?>
                      <div class="main-achieve__badge">
                        <?= esc($mainAch['badge_text']) ?>
                      </div>
                    <?php endif; ?>
                    <h3><?= esc($mainAch['title']) ?></h3>
                    <p class="muted"><?= esc($mainAch['description']) ?></p>
                    <div class="main-achieve__action-wrap">
                      <button type="button" class="btn-achieve-detail" data-achieve-detail="<?= $mainAchJson ?>">
                        <i class="bi bi-eye-fill me-2"></i> Lihat Detail
                      </button>
                    </div>
                  </div>
                </div>
              <?php endif; ?>

              <?php if (!empty($timelineAchs)): ?>
                <div class="achieve-timeline">
                  <?php foreach ($timelineAchs as $ach): ?>
                    <?php
                    $itemPlaceholder = getAchSvgPlaceholder('Achievement Item', 500, 340);
                    $itemPhotoUrl = '';
                    if (!empty($ach['photo'])) {
                      if (file_exists(FCPATH . 'assets/uploads/achievements/' . $ach['photo'])) {
                        $itemPhotoUrl = base_url('assets/uploads/achievements/' . $ach['photo']);
                      } elseif (file_exists(FCPATH . 'assets/images/' . $ach['photo'])) {
                        $itemPhotoUrl = base_url('assets/images/' . $ach['photo']);
                      } elseif (file_exists(FCPATH . 'assets/' . $ach['photo'])) {
                        $itemPhotoUrl = base_url('assets/' . $ach['photo']);
                      }
                    }
                    if (empty($itemPhotoUrl)) {
                      $itemPhotoUrl = $itemPlaceholder;
                    }
                    $itemAchJson = htmlspecialchars(json_encode([
                      'title' => $ach['title'] ?? '',
                      'year' => $ach['year'] ?? '',
                      'date_label' => $ach['date_label'] ?? '',
                      'badge' => $ach['badge_text'] ?? '',
                      'category' => $cat['name'] ?? 'Pencapaian',
                      'description' => $ach['description'] ?? '',
                      'photo' => $itemPhotoUrl,
                      'small_text' => $ach['small_text'] ?? '',
                      'heading_text' => $ach['heading_text'] ?? '',
                      'signature_text' => $ach['signature_text'] ?? ''
                    ]), ENT_QUOTES, 'UTF-8');
                    ?>
                    <div class="achieve-item reveal">
                      <div class="achieve-item__year-label"><?= esc($ach['year']) ?></div>
                      <div class="achieve-item__dot"></div>
                      <div class="achieve-item__photo" role="button" tabindex="0" title="Klik untuk melihat detail"
                        data-achieve-detail="<?= $itemAchJson ?>">
                        <img src="<?= $itemPhotoUrl ?>" alt="<?= esc($ach['title']) ?>" loading="lazy"
                          onerror="this.src='<?= $itemPlaceholder ?>'">
                        <span class="achieve-photo-zoom-badge">
                          <i class="bi bi-zoom-in"></i> Detail
                        </span>
                      </div>
                      <div class="achieve-item__text card3d" data-tilt data-tilt-strength="10">
                        <svg class="achieve-spark" aria-hidden="true">
                          <use href="#i-spark"></use>
                        </svg>
                        <div class="achieve-text-inner">
                          <div class="achieve-icon">
                            <i class="<?= esc(resolveAchieveIconClass($ach['icon'] ?? '', 'bi bi-award-fill')) ?>"></i>
                          </div>
                          <div class="achieve-details">
                            <span class="achieve-date"><?= esc($ach['date_label']) ?></span>
                            <h3><?= esc($ach['title']) ?></h3>
                            <p class="muted"><?= esc($ach['description']) ?></p>
                            <button type="button" class="btn-achieve-detail-sm" data-achieve-detail="<?= $itemAchJson ?>">
                              Lihat Detail <i class="bi bi-arrow-right-short ms-1"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>

              <?php if (empty($mainAch) && empty($timelineAchs)): ?>
                <div class="achieve-empty-state reveal">
                  <div class="achieve-empty-card" data-tilt data-tilt-strength="6">
                    <div class="achieve-empty-icon-wrap">
                      <div class="achieve-empty-circle">
                        <?php
                        $catIcon = 'bi bi-award';
                        $catNameLower = strtolower($cat['name']);
                        if (str_contains($catNameLower, 'creator')) {
                          $catIcon = 'bi bi-stars';
                        } elseif (str_contains($catNameLower, 'academy') || str_contains($catNameLower, 'edu')) {
                          $catIcon = 'bi bi-mortarboard';
                        } elseif (str_contains($catNameLower, 'film')) {
                          $catIcon = 'bi bi-film';
                        }
                        ?>
                        <i class="<?= $catIcon ?>"></i>
                      </div>
                    </div>
                    <div class="achieve-empty-pill">
                      <span class="achieve-pulse-dot"></span> Segera Hadir
                    </div>
                    <h3 class="achieve-empty-title">Belum Ada Milestone di Kategori Ini</h3>
                    <p class="achieve-empty-desc">
                      Dokumentasi prestasi dan karya untuk kategori <strong
                        class="text-pink"><?= esc($cat['name']) ?></strong> sedang dalam proses kurasi portofolio. Nantikan
                      momen spesial berikutnya! ✨
                    </p>
                    <div class="achieve-empty-action">
                      <a href="#contact" class="achieve-empty-btn">
                        <i class="bi bi-chat-heart-fill me-2"></i> Hubungi untuk Kolaborasi
                      </a>
                    </div>
                  </div>
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
                <p class="muted">Penghargaan tertinggi yang diraih Annisa Esce sebagai kreator paling berpengaruh di tahun
                  2026.</p>
              </div>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </section>

    <!-- ACHIEVEMENT DETAIL MODAL -->
    <div id="achieveDetailModal" class="achieve-modal" aria-hidden="true" role="dialog" aria-modal="true">
      <div class="achieve-modal__backdrop" id="achieveModalBackdrop"></div>
      <div class="achieve-modal__container">
        <div class="achieve-modal__dialog">
          <button type="button" class="achieve-modal__close" id="achieveModalClose" aria-label="Tutup Detail">
            <i class="bi bi-x-lg"></i>
          </button>

          <div class="achieve-modal__body">
            <!-- Left: Certificate / Image Preview -->
            <div class="achieve-modal__media">
              <div class="achieve-modal__img-box">
                <img id="achieveModalImg" src="" alt="Achievement Detail">
              </div>
              <a id="achieveModalImgLink" href="#" target="_blank" class="achieve-modal__zoom-link"
                rel="noopener noreferrer">
                <i class="bi bi-arrows-fullscreen me-1"></i> Buka Gambar Resolusi Penuh
              </a>
            </div>

            <!-- Right: Details Info -->
            <div class="achieve-modal__info">
              <div class="achieve-modal__tags">
                <span class="achieve-modal__tag achieve-modal__tag--cat" id="achieveModalCat">
                  <i class="bi bi-tag-fill me-1"></i> <span>Kategori</span>
                </span>
                <span class="achieve-modal__tag achieve-modal__tag--year" id="achieveModalYear">
                  <i class="bi bi-calendar3 me-1"></i> <span>2024</span>
                </span>
                <span class="achieve-modal__tag achieve-modal__tag--badge" id="achieveModalBadge"
                  style="display: none;">
                  <span></span>
                </span>
              </div>

              <h2 class="achieve-modal__title" id="achieveModalTitle">Judul Pencapaian</h2>

              <div class="achieve-modal__date" id="achieveModalDateWrap">
                <i class="bi bi-clock-history me-1 text-pink"></i> <span id="achieveModalDate"></span>
              </div>

              <div class="achieve-modal__desc-wrap">
                <h4 class="achieve-modal__section-heading">Deskripsi & Penghargaan</h4>
                <p class="achieve-modal__desc" id="achieveModalDesc"></p>
              </div>

              <div class="achieve-modal__meta" id="achieveModalMeta" style="display: none;">
                <div class="achieve-modal__meta-item" id="achieveModalSmallWrap" style="display: none;">
                  <span class="meta-label"><i class="bi bi-info-circle me-1"></i> Keterangan</span>
                  <span class="meta-val" id="achieveModalSmall"></span>
                </div>
                <div class="achieve-modal__meta-item" id="achieveModalHeadingWrap" style="display: none;">
                  <span class="meta-label"><i class="bi bi-person-fill me-1"></i> Sutradara / Tim</span>
                  <span class="meta-val" id="achieveModalHeading"></span>
                </div>
              </div>

              <div class="achieve-modal__footer">
                <a href="#contact" class="achieve-modal__btn-contact" id="achieveModalContact">
                  <i class="bi bi-chat-heart-fill me-2"></i> Hubungi untuk Kolaborasi
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <hr class="divider-metallic">

    <!-- RESUME -->
    <section class="section" id="resume" data-spot="resume">
      <div class="container">
        <!-- Section Header Row -->
        <div class="portfolio-header-row reveal"
          style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; margin-bottom: 40px; gap: 24px;">
          <div class="section__head" style="text-align: left; margin: 0; max-width: 500px;">
            <p
              style="font-size: 14px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #ff69b4; margin-bottom: 8px;">
              MY RESUME</p>
            <h2 class="section__title" id="bfly-resume"
              style="font-size: 48px; line-height: 1.1; margin-bottom: 16px; color: var(--text); font-family: serif;">
              Professional <span style="color: #ff69b4;">Resume</span></h2>
            <p class="section__sub" style="font-size: 15px; color: var(--muted); margin: 0;">Ringkas, jelas, dan fokus
              value.</p>
          </div>
        </div>

        <div class="resume__grid">
          <div class="card3d resume__card reveal" data-tilt data-tilt-strength="12">
            <h3 style="margin-bottom: 30px;"><svg class="ico" aria-hidden="true">
                <use href="#i-briefcase"></use>
              </svg> Experience</h3>
            <div class="timeline">
              <?php if (!empty($experiences)): ?>
                <?php foreach ($experiences as $exp): ?>
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
                    <p class="muted clamp-2">This partnership is ideal for brands looking for consistency, clarity, and
                      long-term growth through content.</p>
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
              <?php if (!empty($skills)): ?>
                <?php foreach ($skills as $sk): ?>
                  <div class="skill">
                    <span><?= esc($sk['name']) ?></span>
                    <div class="bar"><i style="width: <?= (int) $sk['percentage'] ?>%"></i></div>
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
              <a class="btn btn--primary" target="_blank"
                href="<?= !empty($hero['cv_file']) ? base_url('assets/uploads/hero/' . $hero['cv_file']) : base_url('assets/assets/cv annisa.pdf') ?>"
                id="downloadCV" download="<?= esc($hero['cv_file'] ?? 'CV Annisa.pdf') ?>" data-tilt
                data-tilt-strength="12">
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
              <?php if (!empty($tools)): ?>
                <?php foreach ($tools as $tl): ?>
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
            <p
              style="font-size: 14px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #ff69b4; margin-bottom: 8px;">
              Testimonial</p>
            <h2 class="section__title" id="bfly-customers"
              style="font-size: 48px; line-height: 1.1; margin-bottom: 16px; color: var(--text); font-family: serif;">
              What They <span style="color: #ff69b4;">Say</span></h2>
            <p class="section__sub" style="font-size: 15px; color: var(--muted); margin: 0;">Kumpulan karya terbaik yang
              kami buat<br>dengan dedikasi dan sepenuh hati.</p>
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
              <?php if (!empty($testimonials)): ?>
                <?php foreach ($testimonials as $t): ?>
                  <div class="swiper-slide">
                    <div class="csay__card">
                      <div class="csay__logo">
                        <img
                          src="<?= base_url(file_exists(FCPATH . 'assets/uploads/testimonials/' . $t['logo']) ? 'assets/uploads/testimonials/' . $t['logo'] : 'assets/assets/' . $t['logo']) ?>"
                          alt="<?= esc($t['brand_name']) ?>"
                          onerror="this.src='<?= getLogoSvgPlaceholder(esc($t['brand_name'])) ?>'">
                      </div>
                      <h4 class="csay__name"><?= esc($t['brand_name']) ?></h4>
                      <div class="csay__stars"><?= str_repeat('★', (int) $t['rating']) ?></div>
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
                    <p class="csay__text">Website yang dibuat sangat profesional, modern, dan user friendly. Tim sangat
                      responsif and detail.</p>
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
        <div class="portfolio-header-row reveal"
          style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; margin-bottom: 40px; gap: 24px;">
          <div class="section__head" style="text-align: left; margin: 0; max-width: 500px;">
            <p
              style="font-size: 14px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase; color: #ff69b4; margin-bottom: 8px;">
              GET IN TOUCH</p>
            <h2 class="section__title" id="bfly-contact"
              style="font-size: 48px; line-height: 1.1; margin-bottom: 16px; color: var(--text); font-family: serif;">
              Let's <span style="color: #ff69b4;">Connect</span></h2>
            <p class="section__sub" style="font-size: 15px; color: var(--muted); margin: 0;">Balas cepat via email /
              WhatsApp.</p>
          </div>
        </div>

        <div class="contact__grid">
          <div class="card3d contact__card reveal" data-tilt data-tilt-strength="10">
            <h3><svg class="ico" aria-hidden="true">
                <use href="#i-chat"></use>
              </svg> Send a message</h3>
            <form id="contactForm" class="form" method="POST" action="<?= base_url('send-message') ?>">
              <?= csrf_field() ?>
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
              <button class="btn btn--primary" type="submit" id="contactSubmitBtn" data-tilt data-tilt-strength="12">
                <span class="btn-text" style="display: inline-flex; align-items: center; gap: 8px;">
                  <svg class="ico" aria-hidden="true">
                    <use href="#i-send"></use>
                  </svg>
                  Send
                </span>
                <span class="btn-loading d-none align-items-center justify-content-center gap-2" style="display: none;">
                  <i class="ri-loader-4-line spin fs-5"></i>
                  Sending...
                </span>
                <span class="btn__glow" aria-hidden="true"></span>
              </button>
              <p class="muted small">* Pesan kamu akan dibalas maksimal dalam 1 × 24 jam.</p>
            </form>
          </div>

          <div class="contact__side">
            <div class="card3d contact__card reveal" data-tilt data-tilt-strength="10">
              <h3><svg class="ico" aria-hidden="true">
                  <use href="#i-link"></use>
                </svg> Quick links</h3>
              <div class="links">
                <?php if (!empty($socials)): ?>
                  <?php foreach ($socials as $soc): ?>
                    <?php
                    $pLower = strtolower($soc['platform']);
                    $href = $soc['url'];
                    if ($pLower === 'email' && !str_starts_with($href, 'mailto:')) {
                      $href = 'mailto:' . $href;
                    }
                    $iconClass = !empty($soc['icon']) ? $soc['icon'] : 'ri-link';
                    ?>
                    <a target="_blank" class="link" href="<?= esc($href) ?>">
                      <span class="link__l">
                        <?php if ($pLower === 'lemon8' || $pLower === 'lemon'): ?>
                          <span>🍋</span>
                        <?php else: ?>
                          <i class="<?= esc($iconClass) ?> me-1 text-pink fs-5"></i>
                        <?php endif; ?>
                        <?= esc($soc['platform']) ?>
                      </span>
                      <span class="link__r">↗</span>
                    </a>
                  <?php endforeach; ?>
                <?php endif; ?>

                <?php if (!empty($settings['contact_email'])): ?>
                  <a target="_blank" class="link" href="mailto:<?= esc($settings['contact_email']) ?>">
                    <span class="link__l">
                      <i class="ri-mail-fill me-1 text-pink fs-5"></i>
                      Email Direct
                    </span>
                    <span class="link__r">↗</span>
                  </a>
                <?php endif; ?>
              </div>

              <?php if (!empty($settings['contact_phone'])): ?>
                <?php
                $phoneClean = preg_replace('/[^0-9]/', '', $settings['contact_phone']);
                if (str_starts_with($phoneClean, '0')) {
                  $phoneClean = '62' . substr($phoneClean, 1);
                }
                $waUrl = 'https://wa.me/' . $phoneClean . '?text=Halo%20Annisa,%20saya%20mau%20diskusi%20project%20konten.';
                ?>
                <div style="margin-top: 12px;" class="wa">
                  <a class="btn btn--ghost w-full" target="_blank" href="<?= esc($waUrl) ?>" id="whatsappBtn" data-tilt
                    data-tilt-strength="12">
                    <i class="bi bi-whatsapp fs-5 text-pink me-2"></i>
                    WhatsApp (<?= esc($settings['contact_phone']) ?>)
                  </a>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <!-- FULL WIDTH MAPS & AVAILABILITY -->
        <?php if (!empty($settings['contact_map_iframe'])): ?>
          <div style="margin-top: 24px;" class="card3d contact__card reveal p-0 overflow-hidden" data-tilt
            data-tilt-strength="5">
            <div
              style="width: 100%; height: 260px; border-radius: 20px; overflow: hidden; border: 1px solid rgba(255,105,180,0.25);">
              <?= $settings['contact_map_iframe'] ?>
            </div>
          </div>
        <?php endif; ?>

        <div style="margin-top: 20px;" class="card3d contact__card reveal" data-tilt data-tilt-strength="5">
          <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
            <div>
              <h3 class="mb-1"><svg class="ico me-1" aria-hidden="true">
                  <use href="#i-clock"></use>
                </svg> Availability &amp; Location</h3>
              <p class="muted mb-0" style="font-size: 14px; line-height: 1.5;">
                <?php if (!empty($settings['contact_address'])): ?>
                  <i class="ri-map-pin-2-fill text-pink me-1"></i> <?= esc($settings['contact_address']) ?> &bull;
                <?php endif; ?>
                Open untuk monthly retainer &amp; campaign.
              </p>
            </div>
            <div class="availability mt-0">
              <span class="badge"><i></i> Open</span>
              <span class="muted small ms-2">Response: 2–6 jam</span>
            </div>
          </div>
        </div>
      </div>

      <footer class="footer">
        <div class="muted small">© <span id="year"></span> <?= esc($settings['site_title'] ?? 'Annisa Esce') ?> - All
          rights reserved.</div>
        </div>
      </footer>
      </div>
    </section>
  </main>

  <!-- FLOATING QUICK BUTTONS -->
  <div class="floatbar" aria-label="Quick actions">
    <?php if (!empty($settings['contact_phone'])): ?>
      <?php
      $phoneClean = preg_replace('/[^0-9]/', '', $settings['contact_phone']);
      if (str_starts_with($phoneClean, '0')) {
        $phoneClean = '62' . substr($phoneClean, 1);
      }
      $waFloatUrl = 'https://wa.me/' . $phoneClean . '?text=Halo%20Annisa,%20saya%20mau%20diskusi%20project%20konten.';
      ?>
      <a class="floatbar__btn floatbar__btn--wa" id="fabWhatsApp" href="<?= esc($waFloatUrl) ?>" target="_blank"
        rel="noreferrer" data-label="WhatsApp" aria-label="WhatsApp">
        <i class="bi bi-whatsapp fs-5 text-pink"></i>
      </a>
    <?php endif; ?>

    <?php if (!empty($socials)): ?>
      <?php foreach ($socials as $soc): ?>
        <?php
        $pLower = strtolower($soc['platform']);
        if ($pLower === 'whatsapp')
          continue;
        $href = $soc['url'];
        if ($pLower === 'email' && !str_starts_with($href, 'mailto:')) {
          $href = 'mailto:' . $href;
        }
        $iconClass = !empty($soc['icon']) ? $soc['icon'] : 'ri-link';
        ?>
        <a class="floatbar__btn" href="<?= esc($href) ?>" target="_blank" rel="noreferrer"
          data-label="<?= esc($soc['platform']) ?>" aria-label="<?= esc($soc['platform']) ?>">
          <?php if ($pLower === 'instagram'): ?>
            <svg class="ico" aria-hidden="true">
              <use href="#i-instagram"></use>
            </svg>
          <?php elseif ($pLower === 'tiktok'): ?>
            <svg class="ico" aria-hidden="true">
              <use href="#i-tiktok"></use>
            </svg>
          <?php elseif ($pLower === 'youtube'): ?>
            <svg class="ico" aria-hidden="true">
              <use href="#i-youtube"></use>
            </svg>
          <?php elseif ($pLower === 'lemon8' || $pLower === 'lemon'): ?>
            🍋
          <?php else: ?>
            <i class="<?= esc($iconClass) ?> fs-5 text-pink"></i>
          <?php endif; ?>
        </a>
      <?php endforeach; ?>
    <?php endif; ?>

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
          <ul class="modal__bullets" id="modalBullets"
            style="margin-top: 16px; padding-left: 0; list-style: none; display: flex; flex-direction: column; gap: 8px;">
          </ul>
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
    <symbol id="i-arrow-right" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
      stroke-linecap="round" stroke-linejoin="round">
      <line x1="5" y1="12" x2="19" y2="12"></line>
      <polyline points="12 5 19 12 12 19"></polyline>
    </symbol>
    <symbol id="i-arrow-left" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
      stroke-linecap="round" stroke-linejoin="round">
      <line x1="19" y1="12" x2="5" y2="12"></line>
      <polyline points="12 19 5 12 12 5"></polyline>
    </symbol>

    <symbol id="i-chevron-right" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
      stroke-linecap="round" stroke-linejoin="round">
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
    <?php $sMap = array_column($socials ?? [], 'url', 'platform'); ?>
    window.LINKS = {
      instagram: "<?= esc($sMap['Instagram'] ?? $sMap['instagram'] ?? '') ?>",
      tiktok: "<?= esc($sMap['TikTok'] ?? $sMap['tiktok'] ?? '') ?>",
      youtube: "<?= esc($sMap['YouTube'] ?? $sMap['youtube'] ?? '') ?>",
      email: "mailto:<?= esc($settings['contact_email'] ?? $sMap['Email'] ?? $sMap['email'] ?? '') ?>",
      whatsapp: "<?= esc(!empty($settings['contact_phone']) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $settings['contact_phone']) : ($sMap['WhatsApp'] ?? $sMap['whatsapp'] ?? '')) ?>"
    };
  </script>
  <script src="<?= base_url('assets/script.js?v=' . time()) ?>" defer></script>

  <!-- Crisp Chat Widget (Disabled / Commented out)
  <script type="text/javascript">
    // window.$crisp = [];
    // window.CRISP_WEBSITE_ID = "db91ee50-f9dd-4b59-97c3-53d4a9a13353";
    // (function() {
    //   d = document;
    //   s = d.createElement("script");
    //   s.src = "https://client.crisp.chat/l.js";
    //   s.async = 1;
    //   d.getElementsByTagName("head")[0].appendChild(s);
    // })();
  </script>
  -->

  <!-- Style Custom Modal Estetik -->
  <style>
    .aesthetic-modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(30, 15, 32, 0.65);
      backdrop-filter: blur(14px);
      -webkit-backdrop-filter: blur(14px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999999;
      opacity: 0;
      pointer-events: none;
      transition: opacity 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .aesthetic-modal-overlay.active {
      opacity: 1;
      pointer-events: auto;
    }

    .aesthetic-modal-card {
      background: rgba(255, 255, 255, 0.95);
      border: 2px solid rgba(255, 105, 180, 0.35);
      border-radius: 28px;
      padding: 38px 32px 32px;
      width: 90%;
      max-width: 430px;
      text-align: center;
      box-shadow:
        0 25px 60px rgba(230, 99, 119, 0.35),
        0 10px 25px rgba(0, 0, 0, 0.1),
        inset 0 0 15px rgba(255, 182, 193, 0.4);
      transform: scale(0.75) translateY(20px);
      transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .aesthetic-modal-overlay.active .aesthetic-modal-card {
      transform: scale(1) translateY(0);
    }

    .aesthetic-modal-icon {
      width: 76px;
      height: 76px;
      margin: 0 auto 20px;
      border-radius: 50%;
      background: linear-gradient(135deg, #ff69b4 0%, #ec407a 100%);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #ffffff;
      font-size: 42px;
      box-shadow:
        0 10px 25px rgba(236, 64, 122, 0.45),
        0 0 0 6px rgba(255, 182, 193, 0.35);
      animation: modalPulse 2s infinite ease-in-out;
    }

    @keyframes modalPulse {

      0%,
      100% {
        transform: scale(1);
        box-shadow: 0 10px 25px rgba(236, 64, 122, 0.45), 0 0 0 6px rgba(255, 182, 193, 0.35);
      }

      50% {
        transform: scale(1.06);
        box-shadow: 0 14px 30px rgba(236, 64, 122, 0.6), 0 0 0 10px rgba(255, 182, 193, 0.2);
      }
    }

    .aesthetic-modal-title {
      font-size: 22px;
      font-weight: 800;
      color: #2d1b2e;
      margin: 0 0 10px;
      letter-spacing: -0.3px;
    }

    .aesthetic-modal-desc {
      font-size: 14px;
      line-height: 1.6;
      color: #6a556d;
      margin: 0 0 26px;
    }

    .aesthetic-modal-btn {
      background: linear-gradient(135deg, #ff69b4 0%, #ec407a 100%);
      color: #ffffff !important;
      font-weight: 700;
      font-size: 15px;
      border: none;
      border-radius: 50px;
      padding: 13px 38px;
      cursor: pointer;
      box-shadow: 0 8px 20px rgba(236, 64, 122, 0.35);
      transition: all 0.25s ease;
      display: inline-block;
      text-decoration: none;
    }

    .aesthetic-modal-btn:hover {
      transform: translateY(-2px) scale(1.03);
      box-shadow: 0 12px 28px rgba(236, 64, 122, 0.5);
      background: linear-gradient(135deg, #ff7ab8 0%, #f04e85 100%);
    }
  </style>

  <!-- Modal Sukses Kontak Estetik -->
  <div id="aestheticSuccessModal" class="aesthetic-modal-overlay">
    <div class="aesthetic-modal-card">
      <div class="aesthetic-modal-icon">
        <i class="ri-checkbox-circle-fill"></i>
      </div>
      <h3 class="aesthetic-modal-title">Pesan Terkirim! 🎉</h3>
      <p class="aesthetic-modal-desc">
        Terima kasih sudah menghubungi <strong>Annisa Esce</strong>.<br>
        Pesan kamu sudah diterima dan akan dibalas maksimal dalam <strong>1 × 24 jam</strong>.
      </p>
      <button type="button" class="aesthetic-modal-btn" onclick="closeAestheticModal()">
        Sama-sama! 💖
      </button>
    </div>
  </div>

  <script>
    function showAestheticModal() {
      const modal = document.getElementById('aestheticSuccessModal');
      if (modal) modal.classList.add('active');
    }

    function closeAestheticModal() {
      const modal = document.getElementById('aestheticSuccessModal');
      if (modal) modal.classList.remove('active');
    }

    document.addEventListener('DOMContentLoaded', function () {
      const contactForm = document.getElementById('contactForm');
      if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
          e.preventDefault();
          const submitBtn = document.getElementById('contactSubmitBtn');
          const btnText = submitBtn ? submitBtn.querySelector('.btn-text') : null;
          const btnLoading = submitBtn ? submitBtn.querySelector('.btn-loading') : null;

          if (submitBtn) submitBtn.disabled = true;
          if (btnText) btnText.style.display = 'none';
          if (btnLoading) btnLoading.style.display = 'inline-flex';

          const formData = new FormData(contactForm);

          fetch(contactForm.action, {
            method: 'POST',
            headers: {
              'X-Requested-With': 'XMLHttpRequest'
            },
            body: formData
          })
            .then(response => response.json())
            .then(data => {
              if (submitBtn) submitBtn.disabled = false;
              if (btnText) btnText.style.display = 'inline-flex';
              if (btnLoading) btnLoading.style.display = 'none';

              if (data.status === 'success') {
                contactForm.reset();
                showAestheticModal();
              } else {
                alert('Terjadi kesalahan. Silakan coba lagi.');
              }
            })
            .catch(error => {
              console.error('Error:', error);
            });
        });
      }
    });
  </script>

  <!-- FLOATING SPARKLE BUTTERFLY BUTTON (KIRI BAWAH) -->
  <div class="landing-butterfly-fab" id="landingButterflyBtn" title="Magic Sparkles ✨">
    <i class="ri-sparkling-fill"></i>
  </div>

  <style>
    /* Floating Butterfly Button - Kiri Bawah Landing Page */
    .landing-butterfly-fab {
      position: fixed;
      bottom: 24px;
      left: 24px;
      width: 52px;
      height: 52px;
      border-radius: 50%;
      background: linear-gradient(135deg, #ff69b4 0%, #ec407a 100%);
      color: #ffffff;
      font-size: 24px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 10px 30px rgba(236, 64, 122, 0.45);
      cursor: pointer;
      z-index: 999999;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .landing-butterfly-fab:hover {
      transform: scale(1.12) rotate(15deg);
      box-shadow: 0 14px 35px rgba(236, 64, 122, 0.65);
    }

    .landing-butterfly-fab.btn-pop {
      animation: fabPopEffect 0.4s ease-out;
    }

    @keyframes fabPopEffect {
      0% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.35) rotate(-20deg);
      }

      100% {
        transform: scale(1);
      }
    }

    /* Butterfly Elements */
    .butterfly-particle {
      position: fixed;
      pointer-events: none;
      z-index: 999999;
      will-change: transform, opacity;
      display: inline-block;
      filter: drop-shadow(0 4px 12px rgba(236, 64, 122, 0.45));
    }

    .butterfly-body {
      display: flex;
      align-items: center;
      justify-content: center;
      transform-style: preserve-3d;
    }

    .butterfly-wing-l {
      transform-origin: right center;
      animation: wingFlapLeft 0.16s infinite alternate cubic-bezier(0.45, 0.05, 0.55, 0.95);
    }

    .butterfly-wing-r {
      transform-origin: left center;
      animation: wingFlapRight 0.16s infinite alternate cubic-bezier(0.45, 0.05, 0.55, 0.95);
    }

    @keyframes wingFlapLeft {
      0% {
        transform: rotateY(0deg);
      }

      100% {
        transform: rotateY(-65deg);
      }
    }

    @keyframes wingFlapRight {
      0% {
        transform: rotateY(0deg);
      }

      100% {
        transform: rotateY(65deg);
      }
    }
  </style>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const landingFab = document.getElementById('landingButterflyBtn');
      if (!landingFab) return;

      landingFab.addEventListener('click', function (e) {
        landingFab.classList.remove('btn-pop');
        void landingFab.offsetWidth;
        landingFab.classList.add('btn-pop');

        const rect = landingFab.getBoundingClientRect();
        const startX = rect.left + rect.width / 2;
        const startY = rect.top + rect.height / 2;

        const colors = [
          { l: '#ff69b4', r: '#ec407a' },
          { l: '#ff80ab', r: '#ff4081' },
          { l: '#f48fb1', r: '#d81b60' },
          { l: '#f06292', r: '#c2185b' },
          { l: '#ba68c8', r: '#ab47bc' },
          { l: '#ffd54f', r: '#ffb300' }
        ];

        const count = 50;

        for (let i = 0; i < count; i++) {
          setTimeout(() => {
            createLandingButterfly(startX, startY, colors[i % colors.length]);
          }, i * 35);
        }
      });

      function createLandingButterfly(startX, startY, color) {
        const butterfly = document.createElement('div');
        butterfly.className = 'butterfly-particle';

        const size = Math.floor(Math.random() * 26) + 24;
        const flapSpeed = (Math.random() * 0.10 + 0.12).toFixed(2);

        butterfly.style.width = size + 'px';
        butterfly.style.height = size + 'px';
        butterfly.style.left = (startX - size / 2) + 'px';
        butterfly.style.top = (startY - size / 2) + 'px';

        butterfly.innerHTML = `
          <div class="butterfly-body">
            <svg class="butterfly-wing-l" width="${size / 2}" height="${size}" viewBox="0 0 50 80" style="animation-duration: ${flapSpeed}s;">
              <path d="M50 40 C30 0, 0 10, 5 35 C10 50, 45 45, 50 40 Z M50 42 C30 50, 10 65, 20 78 C35 85, 48 55, 50 42 Z" fill="${color.l}" opacity="0.95"/>
              <circle cx="30" cy="25" r="4" fill="#ffffff" opacity="0.85"/>
              <circle cx="20" cy="35" r="2.5" fill="#ffffff" opacity="0.85"/>
            </svg>
            <svg class="butterfly-wing-r" width="${size / 2}" height="${size}" viewBox="0 0 50 80" style="animation-duration: ${flapSpeed}s;">
              <path d="M0 40 C20 0, 50 10, 45 35 C40 50, 5 45, 0 40 Z M0 42 C20 50, 40 65, 30 78 C15 85, 2 55, 0 42 Z" fill="${color.r}" opacity="0.95"/>
              <circle cx="20" cy="25" r="4" fill="#ffffff" opacity="0.85"/>
              <circle cx="30" cy="35" r="2.5" fill="#ffffff" opacity="0.85"/>
            </svg>
          </div>
        `;

        document.body.appendChild(butterfly);

        // Fly from bottom-left across the entire landing page screen to top-right
        const targetX = Math.random() * (window.innerWidth - 100);
        const targetY = - (Math.random() * (window.innerHeight + 300) + 400);
        const rotation = (Math.random() - 0.5) * 120;
        const duration = Math.random() * 3000 + 4500; // 4.5s to 7.5s
        const swirlAmp = (Math.random() - 0.5) * 220;

        const animation = butterfly.animate([
          {
            transform: `translate(0px, 0px) rotate(0deg) scale(0.3)`,
            opacity: 1
          },
          {
            transform: `translate(${targetX * 0.25 + swirlAmp}px, ${targetY * 0.25}px) rotate(${rotation * 0.4}deg) scale(1.1)`,
            opacity: 0.95,
            offset: 0.25
          },
          {
            transform: `translate(${targetX * 0.6 - swirlAmp}px, ${targetY * 0.6}px) rotate(${rotation * 0.8}deg) scale(1)`,
            opacity: 0.85,
            offset: 0.6
          },
          {
            transform: `translate(${targetX * 0.85 + swirlAmp * 0.5}px, ${targetY * 0.85}px) rotate(${rotation * 1.1}deg) scale(0.85)`,
            opacity: 0.5,
            offset: 0.85
          },
          {
            transform: `translate(${targetX}px, ${targetY}px) rotate(${rotation}deg) scale(0.4)`,
            opacity: 0
          }
        ], {
          duration: duration,
          easing: 'cubic-bezier(0.2, 0.4, 0.4, 1)',
          fill: 'forwards'
        });

        animation.onfinish = function () {
          butterfly.remove();
        };
      }
    });
  </script>

  <!-- ============================================================
       SCROLL BUTTERFLY – TERBANG KE SETIAP SECTION
  ============================================================= -->
  <script>
    (function () {
      /* ─── 1. CONFIG: urutan section + target landing ─── */
      var SECTIONS = [
        { sectionId: 'home', targetId: null,               /* hero butterfly itu sendiri */ },
        { sectionId: 'about', targetId: 'butterfly-landing-target' },
        { sectionId: 'brands', targetId: 'bfly-brands' },
        { sectionId: 'projects', targetId: 'bfly-projects' },
        { sectionId: 'achievements', targetId: 'bfly-achievements' },
        { sectionId: 'resume', targetId: 'bfly-resume' },
        { sectionId: 'customers', targetId: 'bfly-customers' },
        { sectionId: 'contact', targetId: 'bfly-contact' },
      ];

      var heroBfly = document.querySelector('.frame-butterfly-ornament');
      if (!heroBfly) return;

      var currentIdx = 0;   // index SECTIONS yang aktif sekarang
      var isFlying = false;
      var flyingClone = null;
      var landedEl = null;
      var rafId = null;

      /* ─── 2. Detect active section index by scroll ─── */
      function getActiveIdx() {
        var best = 0;
        var vh = window.innerHeight;
        for (var i = 0; i < SECTIONS.length; i++) {
          var el = document.getElementById(SECTIONS[i].sectionId);
          if (!el) continue;
          var rect = el.getBoundingClientRect();
          // section dianggap aktif jika bagian atasnya sudah melewati 40% viewport
          if (rect.top <= vh * 0.4) best = i;
        }
        return best;
      }

      /* ─── 3. Helper: quadratic bezier ─── */
      function easeInOut(t) {
        return t < 0.5 ? 4 * t * t * t : 1 - Math.pow(-2 * t + 2, 3) / 2;
      }

      function bezier(p0, cp, p1, t) {
        return Math.pow(1 - t, 2) * p0 + 2 * (1 - t) * t * cp + t * t * p1;
      }

      /* ─── 4. Fly animation between two screen coords ─── */
      function flyBetween(fx, fy, tx, ty, dur, onDone) {
        if (flyingClone) { flyingClone.remove(); flyingClone = null; }
        if (rafId) { cancelAnimationFrame(rafId); rafId = null; }

        flyingClone = document.createElement('div');
        flyingClone.className = 'frame-butterfly-ornament';
        flyingClone.innerHTML = heroBfly.innerHTML;
        flyingClone.style.cssText =
          'position:fixed;z-index:99999;pointer-events:none;width:100px;height:100px;' +
          'left:' + fx + 'px;top:' + fy + 'px;' +
          'filter:drop-shadow(0 0 20px rgba(255,64,129,.95)) drop-shadow(0 0 8px #ff80ab);' +
          'will-change:transform,left,top;transition:none;';
        document.body.appendChild(flyingClone);

        // control point: arc bulging upward & sideways
        var midX = (fx + tx) / 2;
        var cpX = midX + (Math.random() > 0.5 ? 1 : -1) * 100;
        var cpY = Math.min(fy, ty) - 180;
        var startTime = null;

        function step(ts) {
          if (!startTime) startTime = ts;
          var p = Math.min((ts - startTime) / dur, 1);
          var t = easeInOut(p);
          var x = bezier(fx, cpX, tx, t);
          var y = bezier(fy, cpY, ty, t);
          var rot = -15 + t * 40;
          var sc = 0.95 + Math.sin(t * Math.PI) * 0.2;
          var op = t < 0.85 ? 1 : 1 - ((t - 0.85) / 0.15) * 0.5;
          if (flyingClone) {
            flyingClone.style.left = x + 'px';
            flyingClone.style.top = y + 'px';
            flyingClone.style.transform = 'rotate(' + rot + 'deg) scale(' + sc + ')';
            flyingClone.style.opacity = op;
          }
          if (p < 1) { rafId = requestAnimationFrame(step); }
          else {
            if (flyingClone) { flyingClone.remove(); flyingClone = null; }
            if (onDone) onDone();
          }
        }
        rafId = requestAnimationFrame(step);
      }

      /* ─── 5. Get landing position (fixed coords) for a section index ─── */
      function getLandingPos(idx) {
        if (idx === 0) {
          // Home: hero butterfly itself
          var r = heroBfly.getBoundingClientRect();
          return { x: r.left, y: r.top };
        }
        var el = document.getElementById(SECTIONS[idx].targetId);
        if (!el) {
          var sec = document.getElementById(SECTIONS[idx].sectionId);
          if (!sec) return { x: 80, y: 80 };
          var r2 = sec.getBoundingClientRect();
          return { x: r2.left + 20, y: r2.top + 20 };
        }
        var r3 = el.getBoundingClientRect();
        return { x: r3.left - 20, y: r3.top - 40 };
      }

      /* ─── 6. Show/hide landed ornament at a target element ─── */
      function removeLanded() {
        if (landedEl) {
          landedEl.style.opacity = '0';
          var el = landedEl; landedEl = null;
          setTimeout(function () { if (el && el.parentNode) el.parentNode.removeChild(el); }, 350);
        }
      }

      function showLanded(idx) {
        removeLanded();
        if (idx === 0) {
          // Back on hero: just show hero butterfly
          heroBfly.style.transition = 'opacity 0.35s ease';
          heroBfly.style.opacity = '1';
          return;
        }
        var targetId = SECTIONS[idx].targetId;
        if (!targetId) return;
        var titleEl = document.getElementById(targetId);
        if (!titleEl) return;

        landedEl = document.createElement('div');
        landedEl.innerHTML = heroBfly.innerHTML;
        landedEl.style.cssText =
          'position:absolute;top:-36px;left:-10px;width:80px;height:80px;' +
          'pointer-events:none;z-index:10;' +
          'filter:drop-shadow(0 0 18px rgba(255,64,129,.95));' +
          'animation:aboutButterflyLanded 3s ease-in-out infinite alternate;' +
          'transform-origin:center bottom;opacity:0;transition:opacity 0.4s ease;';
        titleEl.style.position = 'relative';
        titleEl.appendChild(landedEl);
        setTimeout(function () { if (landedEl) landedEl.style.opacity = '1'; }, 50);
      }

      /* ─── 7. Fly from section A → section B ─── */
      function flyToSection(fromIdx, toIdx) {
        if (isFlying) return;
        isFlying = true;

        // Hide hero butterfly if leaving home
        if (fromIdx === 0) {
          heroBfly.style.transition = 'opacity 0.2s ease';
          heroBfly.style.opacity = '0';
        }
        // Fade out current landed ornament immediately
        removeLanded();

        var from = getLandingPos(fromIdx);
        var to = getLandingPos(toIdx);
        var dist = Math.hypot(to.x - from.x, to.y - from.y);
        var dur = Math.max(900, Math.min(1800, dist * 1.2));

        flyBetween(from.x, from.y, to.x, to.y, dur, function () {
          currentIdx = toIdx;
          isFlying = false;
          showLanded(toIdx);
        });
      }

      /* ─── 8. Scroll watcher ─── */
      var ticking = false;
      window.addEventListener('scroll', function () {
        if (ticking) return;
        ticking = true;
        requestAnimationFrame(function () {
          ticking = false;
          if (isFlying) return;
          var newIdx = getActiveIdx();
          if (newIdx !== currentIdx) {
            flyToSection(currentIdx, newIdx);
          }
        });
      }, { passive: true });

      /* ─── 9. Init state on page load (e.g. refresh mid-page) ─── */
      var initIdx = getActiveIdx();
      if (initIdx !== 0) {
        heroBfly.style.opacity = '0';
        currentIdx = initIdx;
        showLanded(initIdx);
      }

    })();
  </script>

  <!-- Achievement Detail Modal Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const modal = document.getElementById('achieveDetailModal');
      if (!modal) return;

      const backdrop = document.getElementById('achieveModalBackdrop');
      const closeBtn = document.getElementById('achieveModalClose');
      const modalImg = document.getElementById('achieveModalImg');
      const modalImgLink = document.getElementById('achieveModalImgLink');
      const modalCat = document.getElementById('achieveModalCat');
      const modalYear = document.getElementById('achieveModalYear');
      const modalBadge = document.getElementById('achieveModalBadge');
      const modalTitle = document.getElementById('achieveModalTitle');
      const modalDate = document.getElementById('achieveModalDate');
      const modalDateWrap = document.getElementById('achieveModalDateWrap');
      const modalDesc = document.getElementById('achieveModalDesc');
      const modalMeta = document.getElementById('achieveModalMeta');
      const modalSmallWrap = document.getElementById('achieveModalSmallWrap');
      const modalSmall = document.getElementById('achieveModalSmall');
      const modalHeadingWrap = document.getElementById('achieveModalHeadingWrap');
      const modalHeading = document.getElementById('achieveModalHeading');
      const contactBtn = document.getElementById('achieveModalContact');

      function openModal(data) {
        if (!data) return;

        // Image
        if (data.photo) {
          modalImg.src = data.photo;
          modalImgLink.href = data.photo;
          modalImgLink.style.display = 'inline-flex';
        } else {
          modalImgLink.style.display = 'none';
        }

        // Tags
        if (data.category) {
          modalCat.querySelector('span').textContent = data.category;
          modalCat.style.display = 'inline-flex';
        } else {
          modalCat.style.display = 'none';
        }

        if (data.year) {
          modalYear.querySelector('span').textContent = data.year;
          modalYear.style.display = 'inline-flex';
        } else {
          modalYear.style.display = 'none';
        }

        if (data.badge && data.badge.trim() !== '') {
          modalBadge.querySelector('span').textContent = data.badge;
          modalBadge.style.display = 'inline-flex';
        } else {
          modalBadge.style.display = 'none';
        }

        // Title & Date & Desc
        modalTitle.textContent = data.title || 'Detail Pencapaian';

        if (data.date_label && data.date_label.trim() !== '') {
          modalDate.textContent = data.date_label;
          modalDateWrap.style.display = 'block';
        } else {
          modalDateWrap.style.display = 'none';
        }

        modalDesc.textContent = data.description || '-';

        // Extra metadata (small_text, heading_text)
        let hasMeta = false;
        if (data.small_text && data.small_text.trim() !== '') {
          modalSmall.textContent = data.small_text;
          modalSmallWrap.style.display = 'flex';
          hasMeta = true;
        } else {
          modalSmallWrap.style.display = 'none';
        }

        if (data.heading_text && data.heading_text.trim() !== '') {
          modalHeading.textContent = data.heading_text;
          modalHeadingWrap.style.display = 'flex';
          hasMeta = true;
        } else {
          modalHeadingWrap.style.display = 'none';
        }

        modalMeta.style.display = hasMeta ? 'flex' : 'none';

        // Show Modal
        modal.classList.add('active');
        modal.setAttribute('aria-hidden', 'false');
        document.body.style.overflow = 'hidden';
      }

      function closeModal() {
        modal.classList.remove('active');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = '';
      }

      // Triggers
      document.addEventListener('click', function (e) {
        const trigger = e.target.closest('[data-achieve-detail]');
        if (trigger) {
          e.preventDefault();
          try {
            const data = JSON.parse(trigger.getAttribute('data-achieve-detail'));
            openModal(data);
          } catch (err) {
            console.error('Failed to parse achievement data:', err);
          }
        }
      });

      if (closeBtn) closeBtn.addEventListener('click', closeModal);
      if (backdrop) backdrop.addEventListener('click', closeModal);
      if (contactBtn) {
        contactBtn.addEventListener('click', function () {
          closeModal();
        });
      }

      document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
          closeModal();
        }
      });
    });
  </script>

</body>

</html>