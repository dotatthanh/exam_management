<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'exam_room_id',
        'exam_id',
    ];

    public function examRoom()
    {
        return $this->belongsTo(ExamRoom::class);
    }
    
    public function qaResult()
    {
        return $this->hasMany(QaResult::class);
    }

    public function calculateExamScore() {
        return $this->qaResult->where('is_correct', true)->count();
    }
}
