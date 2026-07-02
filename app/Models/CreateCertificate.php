<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreateCertificate extends Model
{
    use HasFactory;

    protected $table = 'create_certificates';

    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'certificate_number',
        'issued_date',
        'rejection_reason',
    ];

    protected $casts = [
        'issued_date' => 'datetime',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}

