<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breadcrumb extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //Relationship with Breadcrumb
    public function pageName()
    {
        return $this->belongsTo(PageName::class, 'page_id', 'id');
    }
}
