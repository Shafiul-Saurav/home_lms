<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LandingPageReviewImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'landingpage_id',
        'image_path',
        'section_type',
        'order',
    ];

    /**
     * Get the landing page that owns the review image.
     */
    public function landingPage(): BelongsTo
    {
        return $this->belongsTo(LandingPage::class, 'landingpage_id');
    }
}