<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id(); // primary key
            $table->string('item', 255); // สร้างฟิลด์ item ขนาดสูงสุด 255 characters
            $table->integer('quantity'); // สร้างฟิลด์ quantity เป็น integer
            $table->unsignedBigInteger('withdraw_by'); // ฟิลด์นี้ใช้เพื่อเก็บ ID ของผู้ทำการเบิก
            $table->timestamps(); // สร้างฟิลด์ created_at และ updated_at

            // สร้าง foreign key relationship กับ users table
            $table->foreign('withdraw_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('withdraws');
    }
}
