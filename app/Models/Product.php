<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Relationship with ProductImage
    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    // Accessor for discount percentage
    public function getDiscountPercentageAttribute()
    {
        if ($this->discount_amount > 0) {
            if ($this->discount_type == 'percentage') {
                return $this->discount_amount;
            } else {
                return round(($this->discount_amount / $this->sell_price) * 100);
            }
        }
        return 0;
    }

    // Accessor for sale price
    public function getSalePriceAttribute()
    {
        if ($this->discount_percentage > 0) {
            if ($this->discount_type == 'percentage') {
                return $this->sell_price - ($this->sell_price * $this->discount_percentage / 100);
            } else {
                return $this->sell_price - $this->discount_amount;
            }
        }
        return $this->sell_price;
    }

    // Accessor for regular price
    public function getRegularPriceAttribute()
    {
        return $this->sell_price;
    }
}
