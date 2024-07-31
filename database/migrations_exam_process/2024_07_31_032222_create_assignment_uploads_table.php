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
        Schema::create('assignment_uploads', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assignment_proposal_id')->comment('ID của bộ đề thi liên quan');
            $table->date('upload_date')->comment('Ngày upload');
            $table->string('file_path')->comment('Đường dẫn tới tập tin docx hoặc pdf');
            $table->tinyInteger('status')->default('1')->comment('Trạng thái: 1: Đang thực hiện | 2: Đề xuất duyệt | 3: Đang duyệt | 4: Đã duyệt | 5: Không duyệt');
            $table->timestamps();

            $table->foreign('assignment_proposal_id')->references('id')->on('assignment_proposals')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assignment_uploads');
    }
};
