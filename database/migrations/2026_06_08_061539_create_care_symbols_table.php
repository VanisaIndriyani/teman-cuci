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
        Schema::create('care_symbols', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('category_id')->unsigned();
            $table->string('iso_code', 20)->unique();
            $table->string('name', 100);
            $table->string('image_path', 255)->nullable();
            $table->string('description_short', 255)->nullable();
            $table->text('description_long')->nullable();
            $table->smallInteger('sort_order')->default(0);
            $table->integer('views')->default(0);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('symbol_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('care_symbols');
    }
};
