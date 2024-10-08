<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('exam_qa', function (Blueprint $table) {
            $table->id();
            $table->integer('exam_id');
            $table->integer('qa_id');
            $table->integer('index')->comment('Câu hỏi số. VD: Câu 1, Câu 2');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_qa');
    }
};
