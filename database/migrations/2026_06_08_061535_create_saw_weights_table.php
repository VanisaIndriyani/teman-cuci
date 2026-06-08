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
        Schema::create('saw_weights', function (Blueprint $table) {
            $table->id();
            $table->string('criterion_code', 10)->unique();
            $table->string('criterion_name', 50);
            $table->decimal('weight', 3, 2); // DECIMAL(3,2) per ERD
            $table->string('type')->nullable(); // benefit/cost
            $table->timestamps();
            $table->foreignId('updated_by')->nullable()->constrained('admins')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saw_weights');
    }
};
