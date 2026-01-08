<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'subcategory_id', 
        'childcategory_id',
        'name',
        'slug',
        'description',
        'type',
        'purchase_price',
        'sell_price',
        'product_price',
        'product_discount',
        'product_quantity',
        'color',
        'discount_type',
        'size',
        'discount_amount',
        'is_stock',
        'is_active',
        'is_home',
        'image',
        'product_image',
        'short_description',
        'long_description',
        'additional_info',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function childcategory()
    {
        return $this->belongsTo(Childcategory::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
}