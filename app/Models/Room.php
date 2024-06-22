<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //Relationship with Roomtype
    public function roomtype()
    {
        return $this->belongsTo(Roomtype::class, 'roomtype_id', 'id');
    }
}
