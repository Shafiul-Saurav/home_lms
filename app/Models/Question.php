<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function exams()
    {
        return $this->belongsToMany(Exam::class, 'exam_question')->withPivot('order_num')->orderBy('pivot_order_num');
    }
}
