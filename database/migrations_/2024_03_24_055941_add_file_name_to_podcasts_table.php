<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('podcasts', function (Blueprint $table) {
            $table->string('file_name')->nullable()->after('id'); // Thêm cột 'file_name'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('podcasts', function (Blueprint $table) {
            $table->dropColumn('file_name'); // Xóa cột 'file_name' nếu cần rollback
        });
    }
};
