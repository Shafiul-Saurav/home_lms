<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileImage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    // Relationship with Profile
    public function profile() {
        return $this->belongsTo(Profile::class, 'profile_id', 'id');
    }
}
