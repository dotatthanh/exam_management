<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamQA extends Model
{
    use HasFactory;

    protected $table = 'exam_qa';

    protected $fillable = [
        'exam_id',
        'qa_id',
    ];

    public function qa() {
        return $this->belongsTo(QA::class);
    }
}
