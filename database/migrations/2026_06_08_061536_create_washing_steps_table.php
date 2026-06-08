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
        Schema::create('washing_steps', function (Blueprint $table) {
            $table->id();
            $table->string('method_code', 10);
            $table->tinyInteger('step_order');
            $table->string('title', 100);
            $table->text('description');
            $table->text('tip')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('washing_steps');
    }
};
