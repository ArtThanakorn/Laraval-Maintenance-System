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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('ชื่อผู้ใช้งาน');
            $table->string('email')->unique()->comment('อีเมลผู้ใช้งาน');
            $table->string('password')->comment('รหัสผ่านผู้ใช้งาน');
            $table->integer('role')->default(0)->comment('กำหนด ระดับของ user เช่น admin หรือ user ปกติ');
            $table->integer('department')->default(0)->comment('แผนกของ user ตาม departments id ถ้าเป็น admin จะเป็น 0');
            $table->integer('level')->default(0)->comment('กำหนด ระดับของ พนักงาน เช่น หัวหน้า หรือ พนักงาน ปกติ  ถ้าเป็น admin จะเป็น 0');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
