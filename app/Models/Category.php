<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'file', 'is_active'];

    public function products()
    {
        // Assuming you have a products table that relates to categories
        // return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
