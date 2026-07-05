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

    public function servicetwosubcategories()
    {
        return $this->hasMany(Servicetwosubcategory::class, 'category_id', 'id');
    }

    // Alias for convenience
    public function subcategories()
    {
        return $this->servicetwosubcategories();
    }
}
