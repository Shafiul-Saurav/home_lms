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
        'main_call_to_action_text',
        'main_call_to_action_url',
        'benefits_title',
        'benefits_list',
        'why_buy_title',
        'why_buy_description',
        'why_buy_call_to_action_text',
        'why_buy_call_to_action_url',
        'usage_title',
        'usage_instructions',
        'usage_call_to_action_text',
        'usage_call_to_action_url',
        'certificate_title',
        'certificate_subtitle',
        'certificate_image',
        'reviews_title',
        'customer_reviews',
        'cover_image',
        'cover_description',
        'original_price',
        'offer_price',
        'pricing_subtitle',
        'cta_banner_image',
        'cta_banner_text',
        'cta_banner_phone',
        'cta_banner_call_to_action_text',
        'cta_banner_call_to_action_url',
        'footer_text',
        'is_active',
        'section_visibility',
    ];

    protected $casts = [
        'benefits_list' => 'array',
        'customer_reviews' => 'array',
        'section_visibility' => 'array',
        'is_active' => 'boolean',
    ];

    // Relationship with Products (Many-to-Many)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'landingpage_product')
                    ->withPivot(['order', 'is_featured'])
                    ->withTimestamps();
    }

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
}