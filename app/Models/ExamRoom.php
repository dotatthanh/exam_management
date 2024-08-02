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
        'user_id',
    ];

    public function class()
    {
        return $this->belongsTo(Classes::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function isBeforeStartTime()
    {
        if (now() < $this->start_time) {
            return true;
        }

        return false;
    }

    public function isAfterEndTime()
    {
        if (now() > $this->end_time) {
            return true;
        }

        return false;
    }

    public function canTakeExam()
    {
        if ($this->isBeforeStartTime()) {
            return false;
        }
        if ($this->isAfterEndTime()) {
            return false;
        }

        $hasTakenExam = ExamUser::where([
            'user_id' => auth()->id(),
            'exam_room_id' => $this->id,
            'status' => 1,
        ])->exists();
        if ($hasTakenExam) {
            return false;
        }

        return true;
    }
}
