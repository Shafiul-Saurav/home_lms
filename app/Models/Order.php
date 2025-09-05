<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'order_number',
        'name',
        'email',
        'phone',
        'address',
        'subtotal',
        'shipping_cost',
        'total',
        'status'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total' => 'decimal:2'
    ];

    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the order items for the order.
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Generate a unique order number with date prefix.
     * Format: DDMMYYYY + 6-digit unique number
     */
    public static function generateOrderNumber()
    {
        $datePrefix = now()->format('dmY'); // DDMMYYYY format
        $uniqueNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT); // 6-digit unique number
        return $datePrefix . $uniqueNumber;
    }
}
