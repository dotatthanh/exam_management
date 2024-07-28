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
        Schema::create('exam_rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->integer('course_id');
            $table->string('name')->comment('Tên phòng thi');
            $table->integer('exam_quantity')->comment('Số lượng đề thi');
            $table->integer('time')->comment('Thời gian thi');
            $table->time('start_time')->comment('Thời gian bắt đầu thi');
            $table->time('end_time')->comment('Thời gian kết thúc thi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_rooms');
    }
};
