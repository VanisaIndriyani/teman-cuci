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
        Schema::create('care_tips', function (Blueprint $table) {
            $table->id();
            $table->string('method_code', 10);
            $table->string('fabric_filter')->nullable();
            $table->string('color_filter')->nullable();
            $table->string('motif_filter')->nullable();
            $table->text('tip_text');
            $table->smallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('care_tips');
    }
};
