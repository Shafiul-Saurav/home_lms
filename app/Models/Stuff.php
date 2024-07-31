<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stuff extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    //Relationship with Department
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    //  Relationship with StaffPayment
    public function staffPayments()
    {
        return $this->hasMany(StaffPayment::class);
    }
}
