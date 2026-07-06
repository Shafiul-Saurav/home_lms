<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSubcategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['product_category_id', 'name', 'slug', 'file', 'is_active', 'is_home'];

    public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id', 'id');
    }
}
