<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicetwo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Servicetwocategory::class, 'servicetwocategory_id', 'id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Servicetwosubcategory::class, 'servicetwosubcategory_id', 'id');
    }
}
