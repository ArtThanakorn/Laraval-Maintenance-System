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
        Schema::create('repair_follows', function (Blueprint $table) {
            $table->id();
            $table->integer('repair_id')->comment('id แจ้งซ้อม');
            $table->string('status_repair',20)->comment('สถานะงานเเจ้งซ่อม');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repair_follows');
    }
};
