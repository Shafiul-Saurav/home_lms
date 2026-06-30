<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceConsultationTimeslot extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function consultations()
    {
        return $this->hasMany(ServiceConsultation::class, 'timeslot_id');
    }
}
