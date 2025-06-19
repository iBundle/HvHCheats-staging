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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // CS2, Valorant, etc.
            $table->string('slug')->unique(); // cs2, valorant, etc.
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // путь к логотипу игры
            $table->string('version')->nullable(); // текущая версия игры
            $table->boolean('is_active')->default(true);
            $table->date('release_date')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();

            // Индексы для производительности
            $table->index(['is_active', 'sort_order']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
