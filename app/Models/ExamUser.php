<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamUser extends Model
{
    use HasFactory;

    const NOT_TAKEN_EXAM = 0;

    const TAKEN_EXAM = 1;

    protected $fillable = [
        'user_id',
        'exam_room_id',
        'exam_id',
        'status',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function examRoom()
    {
        return $this->belongsTo(ExamRoom::class);
    }

    public function qaResult()
    {
        return $this->hasMany(QaResult::class);
    }

    public function calculateExamScore()
    {
        return $this->qaResult->where('is_correct', true)->count();
    }
}
