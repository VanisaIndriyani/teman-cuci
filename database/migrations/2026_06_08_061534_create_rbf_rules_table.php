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
        Schema::create('rbf_rules', function (Blueprint $table) {
            $table->id();
            $table->string('rule_code', 10)->unique();
            $table->string('fabric')->nullable();
            $table->string('color')->nullable();
            $table->string('motif')->nullable();
            $table->string('dirt_level')->nullable();
            $table->text('condition_desc')->nullable();
            $table->string('eliminated_method', 10);
            $table->text('reason')->nullable();
            $table->string('iso_ref', 50)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rbf_rules');
    }
};
