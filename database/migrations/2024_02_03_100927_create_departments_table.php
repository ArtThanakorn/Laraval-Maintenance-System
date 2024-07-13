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
        Schema::create('departments', function (Blueprint $table) {
            $table->id('department_id'); // bigint(20) unsigned NOT NULL AUTO_INCREMENT
            $table->string('department_name', 100)->comment('ชื่อแผนก'); // varchar(100) NOT NULL
            $table->tinyInteger('status_display')->comment('0=เปิดใช้งาน, 1=ไม่เปิดใช้งาน')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
