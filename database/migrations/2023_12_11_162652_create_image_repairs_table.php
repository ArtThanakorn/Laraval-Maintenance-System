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
        Schema::create('image_repairs', function (Blueprint $table) {
            $table->id('id_image');
            $table->integer('id_repair')->unsigned()->comment('idที่ใช้ระบุรายการแจ้งซ่อม');
            $table->string('nameImage')->comment('ชื่อรูป');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_repairs');
    }
};
