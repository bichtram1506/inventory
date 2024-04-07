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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Thêm cột user_id
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Khai báo khóa ngoại
            $table->string('title'); // Thêm cột title
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Xóa khóa ngoại trước khi xóa bảng
        });
        
        Schema::dropIfExists('posts');
    }
};
