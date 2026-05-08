<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    //relationship with Lesson
    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }

    public function courseModules()
    {
        return $this->hasMany(CourseModule::class, 'course_id', 'id');
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'course_teachers', 'course_id', 'teacher_id')
                    ->withPivot('is_active')
                    ->withTimestamps();
    }

    public function reviews()
    {
        return $this->hasMany(CourseReview::class);
    }

    public function averageRating()
    {
        return round($this->reviews()->where('is_approved', 1)->avg('rating'), 1) ?: 0;
    }

    public function reviewCount()
    {
        return $this->reviews()->where('is_approved', 1)->count();
    }
}
