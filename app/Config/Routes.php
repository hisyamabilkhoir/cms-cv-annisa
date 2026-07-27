<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Landing Page
$routes->get('/', 'HomeController::index');
$routes->post('send-message', 'HomeController::sendMessage');

// Admin Auth
$routes->get('admin', 'Admin\AuthController::login');
$routes->get('admin/login', 'Admin\AuthController::login');
$routes->post('admin/login/process', 'Admin\AuthController::process');
$routes->get('admin/logout', 'Admin\AuthController::logout');

// Admin Group (with filter)
$routes->group('admin', ['filter' => 'auth'], static function ($routes) {
    // Dashboard
    $routes->get('dashboard', 'Admin\DashboardController::index');

    // Hero Settings
    $routes->get('hero', 'Admin\HeroController::index');
    $routes->post('hero/update', 'Admin\HeroController::update');
    
    // About
    $routes->get('about', 'Admin\AboutController::index');
    $routes->post('about/update', 'Admin\AboutController::update');
    // About Icons
    $routes->post('about/icon/store', 'Admin\AboutController::storeIcon');
    $routes->post('about/icon/update/(:num)', 'Admin\AboutController::updateIcon/$1');
    $routes->post('about/icon/delete/(:num)', 'Admin\AboutController::deleteIcon/$1');
    // About Mini Stats
    $routes->post('about/ministat/store', 'Admin\AboutController::storeMiniStat');
    $routes->post('about/ministat/update/(:num)', 'Admin\AboutController::updateMiniStat/$1');
    $routes->post('about/ministat/delete/(:num)', 'Admin\AboutController::deleteMiniStat/$1');
    // About Cards
    $routes->post('about/card/store', 'Admin\AboutController::storeCard');
    $routes->post('about/card/update/(:num)', 'Admin\AboutController::updateCard/$1');
    $routes->post('about/card/delete/(:num)', 'Admin\AboutController::deleteCard/$1');

    // Brands
    $routes->get('brands', 'Admin\BrandController::index');
    $routes->post('brands/settings/update', 'Admin\BrandController::updateSettings');
    $routes->post('brands/store', 'Admin\BrandController::store');
    $routes->post('brands/update/(:num)', 'Admin\BrandController::update/$1');
    $routes->post('brands/delete/(:num)', 'Admin\BrandController::delete/$1');

    // Contacts & Messages
    $routes->get('contacts', 'Admin\ContactController::index');
    $routes->get('contact-messages', 'Admin\ContactController::index');
    $routes->post('contacts/settings/update', 'Admin\ContactController::updateSettings');
    // Social
    $routes->post('contacts/social/store', 'Admin\ContactController::storeSocial');
    $routes->post('contacts/social/update/(:num)', 'Admin\ContactController::updateSocial/$1');
    $routes->post('contacts/social/delete/(:num)', 'Admin\ContactController::deleteSocial/$1');
    // Messages
    $routes->post('contacts/message/read/(:num)', 'Admin\ContactController::markAsRead/$1');
    $routes->post('contacts/message/delete/(:num)', 'Admin\ContactController::deleteMessage/$1');
    // Projects
    $routes->get('projects', 'Admin\ProjectController::index');
    $routes->get('projects/create', 'Admin\ProjectController::create');
    $routes->post('projects/store', 'Admin\ProjectController::store');
    $routes->get('projects/edit/(:num)', 'Admin\ProjectController::edit/$1');
    $routes->post('projects/update/(:num)', 'Admin\ProjectController::update/$1');
    $routes->post('projects/delete/(:num)', 'Admin\ProjectController::delete/$1');
    $routes->post('projects/gallery/delete/(:num)', 'Admin\ProjectController::deleteGallery/$1');

    // Project Galleries (Galeri Proyek Dedicated Page)
    $routes->get('project-galleries', 'Admin\ProjectGalleryController::index');
    $routes->post('project-galleries/store', 'Admin\ProjectGalleryController::store');
    $routes->post('project-galleries/update/(:num)', 'Admin\ProjectGalleryController::update/$1');
    $routes->post('project-galleries/delete/(:num)', 'Admin\ProjectGalleryController::delete/$1');

    // Project Categories
    $routes->get('project-categories', 'Admin\ProjectCategoryController::index');
    $routes->post('project-categories/store', 'Admin\ProjectCategoryController::store');
    $routes->post('project-categories/update/(:num)', 'Admin\ProjectCategoryController::update/$1');
    $routes->post('project-categories/delete/(:num)', 'Admin\ProjectCategoryController::delete/$1');

    // Achievements
    $routes->get('achievements', 'Admin\AchievementController::index');
    $routes->post('achievements/store', 'Admin\AchievementController::store');
    $routes->post('achievements/update/(:num)', 'Admin\AchievementController::update/$1');
    $routes->post('achievements/delete/(:num)', 'Admin\AchievementController::delete/$1');
    
    // Achievement Categories
    $routes->get('achievement-categories', 'Admin\AchievementCategoryController::index');
    $routes->post('achievement-categories/store', 'Admin\AchievementCategoryController::store');
    $routes->post('achievement-categories/update/(:num)', 'Admin\AchievementCategoryController::update/$1');
    $routes->post('achievement-categories/delete/(:num)', 'Admin\AchievementCategoryController::delete/$1');

    // Testimonials
    $routes->get('testimonials', 'Admin\TestimonialController::index');
    $routes->post('testimonials/store', 'Admin\TestimonialController::store');
    $routes->post('testimonials/update/(:num)', 'Admin\TestimonialController::update/$1');
    $routes->post('testimonials/delete/(:num)', 'Admin\TestimonialController::delete/$1');

    // Resume
    $routes->get('resume', 'Admin\ResumeController::index');
    // Resume Experience
    $routes->post('resume/experience/store', 'Admin\ResumeController::storeExperience');
    $routes->post('resume/experience/update/(:num)', 'Admin\ResumeController::updateExperience/$1');
    $routes->post('resume/experience/delete/(:num)', 'Admin\ResumeController::deleteExperience/$1');
    // Resume Skill
    $routes->post('resume/skill/store', 'Admin\ResumeController::storeSkill');
    $routes->post('resume/skill/update/(:num)', 'Admin\ResumeController::updateSkill/$1');
    $routes->post('resume/skill/delete/(:num)', 'Admin\ResumeController::deleteSkill/$1');
    // Resume Tool
    $routes->post('resume/tool/store', 'Admin\ResumeController::storeTool');
    $routes->post('resume/tool/update/(:num)', 'Admin\ResumeController::updateTool/$1');
    $routes->post('resume/tool/delete/(:num)', 'Admin\ResumeController::deleteTool/$1');
    $routes->post('settings/update', 'Admin\SettingsController::update');

    // Account & Settings
    $routes->get('account', 'Admin\AccountController::index');
    $routes->post('account/update', 'Admin\AccountController::update');
    $routes->get('settings', 'Admin\AccountController::index');
    $routes->post('settings/update', 'Admin\AccountController::update');
});
