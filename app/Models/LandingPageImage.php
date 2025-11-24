<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandingPageImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'landingpage_id',
        'image_path',
        'section_type',
        'order',
    ];

    // Relationship with Landing Page
    public function landingPage()
    {
        return $this->belongsTo(LandingPage::class, 'landingpage_id');
    }
}
