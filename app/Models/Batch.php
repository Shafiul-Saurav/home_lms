<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'batch_courses', 'batch_id', 'course_id')
                    ->withPivot('is_active')
                    ->withTimestamps();
    }
}
