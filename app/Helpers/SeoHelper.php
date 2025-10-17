<?php

namespace App\Helpers;

class SeoHelper
{
    /**
     * Generate meta title
     *
     * @param string $title
     * @param string $siteName
     * @param int $maxLength
     * @return string
     */
    public static function generateTitle($title, $siteName = null, $maxLength = 60)
    {
        $fullTitle = $title;
        if ($siteName) {
            $fullTitle .= ' | ' . $siteName;
        }

        // Truncate if too long
        if (strlen($fullTitle) > $maxLength) {
            $fullTitle = substr($fullTitle, 0, $maxLength - 3) . '...';
        }

        return $fullTitle;
    }

    /**
     * Generate meta description
     *
     * @param string $description
     * @param int $maxLength
     * @return string
     */
    public static function generateDescription($description, $maxLength = 160)
    {
        // Strip HTML tags
        $cleanDescription = strip_tags($description);
        
        // Truncate if too long
        if (strlen($cleanDescription) > $maxLength) {
            $cleanDescription = substr($cleanDescription, 0, $maxLength - 3) . '...';
        }

        return $cleanDescription;
    }

    /**
     * Generate keywords from product name and category
     *
     * @param string $productName
     * @param string|null $categoryName
     * @param array $additionalKeywords
     * @return string
     */
    public static function generateKeywords($productName, $categoryName = null, $additionalKeywords = [])
    {
        $keywords = [];
        
        // Split product name into words
        $nameWords = explode(' ', $productName);
        $keywords = array_merge($keywords, $nameWords);
        
        // Add category if available
        if ($categoryName) {
            $categoryWords = explode(' ', $categoryName);
            $keywords = array_merge($keywords, $categoryWords);
        }
        
        // Add additional keywords
        $keywords = array_merge($keywords, $additionalKeywords);
        
        // Remove duplicates and empty values
        $keywords = array_filter(array_unique($keywords));
        
        return implode(', ', $keywords);
    }

    /**
     * Generate Open Graph data for product
     *
     * @param object $product
     * @param string $siteName
     * @return array
     */
    public static function generateProductOpenGraph($product, $siteName)
    {
        $ogData = [
            'title' => self::generateTitle($product->name, $siteName),
            'description' => self::generateDescription($product->description ?? $product->name),
            'url' => route('product.details', $product->slug),
            'type' => 'product',
        ];

        // Add image if available
        if (!empty($product->image) && $product->image !== 'default_product.jpg') {
            $ogData['image'] = asset('uploads/products/' . $product->image);
        } elseif ($product->productImages->first()) {
            $ogData['image'] = asset('uploads/products/' . $product->productImages->first()->multiple_image);
        } else {
            $ogData['image'] = asset('uploads/logos/default.png');
        }

        return $ogData;
    }

    /**
     * Generate structured data for product
     *
     * @param object $product
     * @param string $siteName
     * @return array
     */
    public static function generateProductStructuredData($product, $siteName)
    {
        $images = [];
        
        // Add main image
        if (!empty($product->image) && $product->image !== 'default_product.jpg') {
            $images[] = asset('uploads/products/' . $product->image);
        }
        
        // Add additional images
        foreach ($product->productImages as $image) {
            $images[] = asset('uploads/products/' . $image->multiple_image);
        }
        
        // Fallback if no images
        if (empty($images)) {
            $images[] = asset('uploads/logos/default.png');
        }

        $structuredData = [
            '@context' => 'https://schema.org/',
            '@type' => 'Product',
            'name' => $product->name,
            'description' => self::generateDescription($product->description ?? $product->name),
            'image' => $images,
            'offers' => [
                '@type' => 'Offer',
                'url' => route('product.details', $product->slug),
                'priceCurrency' => 'BDT',
                'price' => $product->sale_price,
                'availability' => $product->is_stock ? 'https://schema.org/InStock' : 'https://schema.org/OutOfStock',
                'priceValidUntil' => date('Y-m-d', strtotime('+1 year')),
            ],
        ];

        // Add brand if available (assuming you have a brand field)
        if (!empty($product->brand)) {
            $structuredData['brand'] = [
                '@type' => 'Brand',
                'name' => $product->brand,
            ];
        }

        // Add category if available
        if (!empty($product->category)) {
            $structuredData['category'] = $product->category->name;
        }

        // Add SKU if available
        if (!empty($product->sku)) {
            $structuredData['sku'] = $product->sku;
        }

        return $structuredData;
    }

    /**
     * Generate breadcrumbs structured data
     *
     * @param array $breadcrumbs
     * @return array
     */
    public static function generateBreadcrumbsStructuredData($breadcrumbs)
    {
        $items = [];
        foreach ($breadcrumbs as $index => $breadcrumb) {
            $items[] = [
                '@type' => 'ListItem',
                'position' => $index + 1,
                'name' => $breadcrumb['name'],
                'item' => $breadcrumb['url'] ?? null,
            ];
        }

        return [
            '@context' => 'https://schema.org/',
            '@type' => 'BreadcrumbList',
            'itemListElement' => $items,
        ];
    }

    /**
     * Generate canonical URL
     *
     * @param string $url
     * @return string
     */
    public static function generateCanonicalUrl($url)
    {
        // Ensure URL is absolute
        if (!str_starts_with($url, 'http')) {
            $url = url($url);
        }
        
        // Remove query parameters for canonical (unless they change content)
        $urlParts = explode('?', $url);
        return $urlParts[0];
    }
}