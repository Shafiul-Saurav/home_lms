<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicetwocategory extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function servicetwos()
    {
        return $this->hasMany(Servicetwo::class, 'servicetwocategory_id', 'id');
    }
}
