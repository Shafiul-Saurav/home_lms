<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class SitemapController extends Controller
{
    public function index()
    {
        // Cache the sitemap for 12 hours
        $sitemap = Cache::remember('sitemap', 60*12, function () {
            // Get all products
            $products = Product::where('is_active', 1)->where('is_stock', 1)->get();
            
            // Get all categories
            $categories = Category::where('is_active', 1)->get();
            
            // Generate sitemap XML
            $xml = '<?xml version="1.0" encoding="UTF-8"?>';
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xhtml="http://www.w3.org/1999/xhtml">';
            
            // Add homepage
            $xml .= '<url>';
            $xml .= '<loc>' . url('/') . '</loc>';
            $xml .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
            $xml .= '<changefreq>daily</changefreq>';
            $xml .= '<priority>1.0</priority>';
            $xml .= '</url>';
            
            // Add categories
            foreach ($categories as $category) {
                $xml .= '<url>';
                $xml .= '<loc>' . route('category.products', $category->id) . '</loc>';
                $xml .= '<lastmod>' . $category->updated_at->format('Y-m-d') . '</lastmod>';
                $xml .= '<changefreq>weekly</changefreq>';
                $xml .= '<priority>0.8</priority>';
                $xml .= '</url>';
            }
            
            // Add products
            foreach ($products as $product) {
                $xml .= '<url>';
                $xml .= '<loc>' . route('product.details', $product->slug) . '</loc>';
                $xml .= '<lastmod>' . $product->updated_at->format('Y-m-d') . '</lastmod>';
                $xml .= '<changefreq>weekly</changefreq>';
                $xml .= '<priority>0.7</priority>';
                $xml .= '</url>';
            }
            
            // Add static pages
            $staticPages = [
                'about' => ['route' => 'about', 'priority' => '0.6', 'changefreq' => 'monthly'],
                'services' => ['route' => 'services', 'priority' => '0.6', 'changefreq' => 'monthly'],
                'photogallery' => ['route' => 'photo.gallery', 'priority' => '0.5', 'changefreq' => 'monthly'],
                'videogallery' => ['route' => 'video.gallery', 'priority' => '0.5', 'changefreq' => 'monthly'],
                'news' => ['route' => 'news.search', 'priority' => '0.6', 'changefreq' => 'weekly'],
                'faqs' => ['route' => 'faq.page', 'priority' => '0.5', 'changefreq' => 'monthly'],
                'contacts' => ['route' => 'contact.page', 'priority' => '0.5', 'changefreq' => 'monthly'],
            ];
            
            foreach ($staticPages as $page) {
                if (route_exists($page['route'])) {
                    $xml .= '<url>';
                    $xml .= '<loc>' . route($page['route']) . '</loc>';
                    $xml .= '<lastmod>' . date('Y-m-d') . '</lastmod>';
                    $xml .= '<changefreq>' . $page['changefreq'] . '</changefreq>';
                    $xml .= '<priority>' . $page['priority'] . '</priority>';
                    $xml .= '</url>';
                }
            }
            
            $xml .= '</urlset>';
            
            return $xml;
        });
        
        return response($sitemap, 200)
            ->header('Content-Type', 'text/xml');
    }
}

// Helper function to check if route exists
if (!function_exists('route_exists')) {
    function route_exists($route_name) {
        try {
            route($route_name);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}