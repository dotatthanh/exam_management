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
        Schema::create('exam_users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('exam_room_id')->comment('phòng');
            $table->integer('exam_id')->comment('đề');
            $table->tinyInteger('status')->default(0)->comment('0: Chưa thi | 1: Đã thi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_users');
    }
};
