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
        Schema::create('saw_criteria_scores', function (Blueprint $table) {
            $table->id();
            $table->string('method_code'); // M1, M2, M3, M4, M5
            $table->string('criterion_code'); // C1, C2, C3, C4
            $table->string('attribute_value'); // e.g., Katun, Putih, Rendah
            $table->integer('score'); // 1-5
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saw_criteria_scores');
    }
};
