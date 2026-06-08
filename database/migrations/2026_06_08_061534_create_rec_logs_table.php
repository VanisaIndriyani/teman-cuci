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
        Schema::create('rec_logs', function (Blueprint $table) {
            $table->id();
            $table->char('session_id', 36)->nullable();
            $table->string('fabric')->nullable(); // Using string for ENUM in ERD
            $table->string('color')->nullable();
            $table->string('motif')->nullable();
            $table->string('dirt_level')->nullable();
            $table->boolean('is_batik_modern')->default(false);
            $table->boolean('is_poly_blend')->default(false);
            $table->boolean('is_denim_new')->default(false);
            $table->boolean('is_sablon_rubber')->default(false);
            $table->boolean('is_bordir_small')->default(false);
            $table->json('passed_methods')->nullable();
            $table->string('top_method', 10)->nullable();
            $table->json('saw_scores')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rec_logs');
    }
};
