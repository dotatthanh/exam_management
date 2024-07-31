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
        Schema::create('assignment_proposals', function (Blueprint $table) {
            $table->id();
            $table->string('academic_year', 10)->comment('Năm học');
            $table->string('semester', 10)->comment('Học kỳ');
            $table->unsignedBigInteger('course_id')->comment('Mã học phần và Tên học phần lấy ở trong bảng courses');
            $table->integer('number_of_assignments')->comment('Số lượng đề');
            $table->string('instructor', 255)->comment('Giảng viên đảm nhận');
            $table->unsignedBigInteger('user_id')->comment('Người phân công');
            $table->date('start_date')->comment('Ngày bắt đầu');
            $table->date('deadline')->comment('Ngày phải hoàn thành');
            $table->tinyInteger('status')->default('1')->comment('Trạng thái: 1: Giao nhiệm vụ | 2: Đang thực hiện | 3: Hoàn thành');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_proposals');
    }
};
