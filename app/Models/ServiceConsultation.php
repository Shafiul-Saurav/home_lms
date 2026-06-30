<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceConsultation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function service()
    {
        return $this->belongsTo(Servicetwo::class, 'service_id');
    }

    public function timeslot()
    {
        return $this->belongsTo(ServiceConsultationTimeslot::class, 'timeslot_id');
    }
}
