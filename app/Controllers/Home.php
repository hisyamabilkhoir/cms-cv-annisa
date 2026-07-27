<?php

namespace App\Controllers;

use App\Models\SiteSettingModel;
use App\Models\HeroSectionModel;
use App\Models\ServiceModel;
use App\Models\PortfolioModel;
use App\Models\ProductModel;
use App\Models\TestimonialModel;
use App\Models\PricingPackageModel;
use App\Models\FaqModel;
use App\Models\StatisticModel;
use App\Models\MarqueeClientModel;
use App\Models\FounderModel;
use App\Models\GalleryItemModel;
use App\Models\AboutContentModel;
use App\Models\MissionItemModel;

class Home extends BaseController
{
    public function index()
    {
        // Settings
        $settingModel = new SiteSettingModel();
        $settings = [];
        foreach ($settingModel->findAll() as $set) {
            $settings[$set['setting_key']] = $set['setting_value'];
        }

        // Hero Section
        $heroModel = new HeroSectionModel();
        $hero = $heroModel->where('page_slug', 'home')->where('is_active', 1)->first();

        // About Content & Missions
        $aboutModel = new AboutContentModel();
        $about = $aboutModel->first();

        $missionModel = new MissionItemModel();
        $missions = $missionModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();

        // Services
        $serviceModel = new ServiceModel();
        $services = $serviceModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();

        // Portfolios (select with category join)
        $portfolioModel = new PortfolioModel();
        $portfolios = $portfolioModel->select('portfolios.*, portfolio_categories.slug as category_slug, portfolio_categories.name as category_name')
                                    ->join('portfolio_categories', 'portfolio_categories.id = portfolios.portfolio_category_id')
                                    ->where('portfolios.is_active', 1)
                                    ->where('portfolios.is_featured', 1)
                                    ->orderBy('portfolios.sort_order', 'ASC')
                                    ->findAll();

        // Products
        $productModel = new ProductModel();
        $products = $productModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();
        
        // Fetch product features for each product
        $db = \Config\Database::connect();
        foreach ($products as &$prod) {
            $prod['features'] = $db->table('product_features')
                                   ->where('product_id', $prod['id'])
                                   ->orderBy('sort_order', 'ASC')
                                   ->get()
                                   ->getResultArray();
        }

        // Testimonials
        $testimonialModel = new TestimonialModel();
        $testimonials = $testimonialModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();

        // Pricing Categories
        $pricingCategoryModel = new \App\Models\PricingCategoryModel();
        $pricingCategories = $pricingCategoryModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();

        // Pricing Packages
        $pricingModel = new PricingPackageModel();
        $pricingPackages = $pricingModel->select('pricing_packages.*, pricing_categories.slug as category_slug, pricing_categories.name as category_name')
                                        ->join('pricing_categories', 'pricing_categories.id = pricing_packages.pricing_category_id', 'left')
                                        ->where('pricing_packages.is_active', 1)
                                        ->orderBy('pricing_packages.sort_order', 'ASC')
                                        ->findAll();
        foreach ($pricingPackages as &$pkg) {
            $pkg['features'] = $db->table('pricing_features')
                                   ->where('pricing_package_id', $pkg['id'])
                                   ->orderBy('sort_order', 'ASC')
                                   ->get()
                                   ->getResultArray();
        }

        // FAQs
        $faqModel = new FaqModel();
        $faqs = $faqModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();

        // Statistics
        $statModel = new StatisticModel();
        $stats = $statModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();

        // Marquee Clients
        $marqueeModel = new MarqueeClientModel();
        $marquee = $marqueeModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();

        // Founders
        $founderModel = new FounderModel();
        $founders = $founderModel->where('is_active', 1)->orderBy('sort_order', 'ASC')->findAll();

        // Gallery
        $galleryModel = new GalleryItemModel();
        $gallery = $galleryModel->where('is_active', 1)->where('is_featured', 1)->orderBy('sort_order', 'ASC')->findAll();

        $data = [
            'settings'        => $settings,
            'hero'            => $hero,
            'about'           => $about,
            'missions'        => $missions,
            'services'        => $services,
            'portfolios'      => $portfolios,
            'products'        => $products,
            'testimonials'    => $testimonials,
            'pricingCategories' => $pricingCategories,
            'pricingPackages' => $pricingPackages,
            'faqs'            => $faqs,
            'stats'           => $stats,
            'marquee'         => $marquee,
            'founders'        => $founders,
            'gallery'         => $gallery
        ];

        return view('front/home', $data);
    }
}
