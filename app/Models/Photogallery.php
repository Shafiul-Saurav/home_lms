<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photogallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function photoCategory()
    {
        return $this->belongsTo(Photocategory::class, 'category_id', 'id');
    }
}
