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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id('id_repair');
            $table->string('status',20)->comment('สถานะผู้เเจ้งงานซ่อม')->nullable();
            $table->string('name',100)->comment('ชื่อผู้แจ้งซ่อม')->nullable();
            $table->string('type',50)->comment('ประเภทงานซ่อม')->nullable()->default('0');
            $table->string('equipment',100)->comment('รายการของที่ต้องซ่อม');
            $table->text('details')->comment('รายละเอียดงานซ่อม')->nullable();
            $table->text('site')->comment('สถานที่')->nullable();
            $table->string('email')->comment('Email ผู้เเจ้งซ่อม')->nullable();
            $table->string('number',10)->comment('เบอร์โทรผู้แจ้งซ่อม')->nullable();
            $table->string('tag_repair',20)->comment('รหัสงานซ่อม');
            $table->string('status_repair',20)->comment('สถานะงานเเจ้งซ่อม')->default('รอซ่อม')->nullable();
            $table->tinyInteger('user_responsible')->comment('ผู้รับผิดชอบ')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
