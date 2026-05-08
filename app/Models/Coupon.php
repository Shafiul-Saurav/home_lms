<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function getDiscountAmount($totalAmount)
    {
        if ($this->discount_type === 'flat') {
            return min($this->discount_value, $totalAmount); // Cannot exceed total amount
        } elseif ($this->discount_type === 'percentage') {
            $discount = ($totalAmount * $this->discount_value) / 100;
            return min($discount, $totalAmount); // Cannot exceed total amount
        }
        
        return 0;
    }

    public function isValid()
    {
        return $this->is_active && 
               $this->start_date <= now() && 
               $this->end_date >= now() &&
               ($this->usage_limit == null || $this->used_count < $this->usage_limit);
    }
}
