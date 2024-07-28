<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'course_id',
        'name',
        'exam_quantity',
        'time',
        'start_time',
        'end_time',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
