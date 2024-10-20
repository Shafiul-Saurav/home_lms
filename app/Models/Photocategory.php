<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photocategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function photoGalleries()
    {
        return $this->hasMany(Photogallery::class, 'category_id', 'id');
    }
}
