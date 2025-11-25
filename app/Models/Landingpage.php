<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPage extends Model
{
    use HasFactory;

    protected $fillable = [
        'main_heading',
        'main_description',
        'video_url',
        'benefits_title',
        'benefits_list',
        'why_buy_title',
        'why_buy_description',
        'usage_title',
        'usage_instructions',
        'certificate_title',
        'certificate_subtitle',
        'certificate_image',
        'cta_banner_image',
        'cta_banner_text',
        'cta_banner_phone',
        'footer_text',
        'is_active',
        'section_visibility',
    ];

    // Relationship with Landing Page Images
    public function landingPageImages()
    {
        return $this->hasMany(LandingPageImage::class, 'landingpage_id');
    }

    // Specific relationship for Why Buy Images
    public function whyBuyImages()
    {
        return $this->hasMany(LandingPageImage::class, 'landingpage_id')
                    ->where('section_type', 'why_buy')
                    ->orderBy('order');
    }

    // Relationship for Review Images
    public function reviewImages()
    {
        return $this->hasMany(LandingPageReviewImage::class, 'landingpage_id')
                    ->where('section_type', 'review')
                    ->orderBy('order');
    }

    protected $casts = [
        'benefits_list' => 'array',
        'customer_reviews' => 'array',
        'section_visibility' => 'array',
        'is_active' => 'boolean',
    ];

    // Relationship with Products (Many-to-Many)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'landingpage_product', 'landingpage_id', 'product_id')
                    ->withPivot(['order', 'is_featured'])
                    ->withTimestamps();
    }

}
