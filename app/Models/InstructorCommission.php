<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstructorCommission extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'instructor_commissions';

    protected $guarded = ['id'];

    protected $casts = [
        'admin_percentage' => 'decimal:2',
        'gateway_percentage' => 'decimal:2',
    ];

    /**
     * Relationship to the teacher (instructor).
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Calculate revenue distribution for a given course price.
     *
     * @param float $price
     * @return array ['admin' => float, 'gateway' => float, 'instructor' => float]
     */
    public function calculateShares(float $price): array
    {
        $adminPct   = $this->admin_percentage / 100;
        $gatewayPct = $this->gateway_percentage / 100;
        $adminShare = $price * $adminPct;
        $gatewayFee = $price * $gatewayPct;
        $instructorShare = $price - $adminShare - $gatewayFee;
        return [
            'admin'       => round($adminShare, 2),
            'gateway'     => round($gatewayFee, 2),
            'instructor'  => round($instructorShare, 2),
        ];
    }

    public function getInstructorPercentageAttribute(): float
    {
        return round(100 - $this->admin_percentage - $this->gateway_percentage, 2);
    }
}
