<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QaResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_user_id',
        'qa_id',
        'answer',
        'is_correct',
    ];

    public function qa() {
        return $this->belongsTo(QA::class);
    }
}
