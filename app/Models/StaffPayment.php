<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffPayment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //  Relationship with Stuff
    public function staff()
    {
        return $this->belongsTo(Stuff::class, 'staff_id', 'id');
    }
}
