<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(ExamCategory::class, 'category_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
