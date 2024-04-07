<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Chèn dữ liệu vào bảng categories
        DB::table('categories')->insert([
            ['name' => 'Thể thao'],
            ['name' => 'Công nghệ'],
            ['name' => 'Âm nhạc'],
            ['name' => 'Du lịch'],
            ['name' => 'Sức khỏe'],
            // Thêm các danh mục khác nếu cần
            // Thêm các dòng dữ liệu khác nếu cần
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
