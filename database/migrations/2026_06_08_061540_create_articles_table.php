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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->nullable()->constrained('admins')->nullOnDelete();
            $table->string('title', 255);
            $table->string('slug', 255)->unique();
            $table->longText('content');
            $table->string('status')->default('published'); // Using string for ENUM
            $table->string('meta_title', 100)->nullable();
            $table->string('meta_desc', 160)->nullable();
            $table->string('thumbnail', 255)->nullable();
            $table->integer('views')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
