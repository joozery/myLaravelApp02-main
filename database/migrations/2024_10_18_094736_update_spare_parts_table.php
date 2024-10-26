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
        Schema::table('spare_parts', function (Blueprint $table) {
            $table->string('image')->nullable()->change(); // เปลี่ยนให้ฟิลด์ image สามารถเป็น null ได้
        });
    }

    public function down()
    {
        Schema::table('spare_parts', function (Blueprint $table) {
            $table->string('image')->nullable(false)->change(); // คืนค่าฟิลด์กลับเป็น not null
        });
    }
};
