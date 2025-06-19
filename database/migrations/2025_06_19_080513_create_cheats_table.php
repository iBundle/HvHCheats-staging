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
        Schema::create('cheats', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // название чита
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->unsignedInteger('love')->default(0);

            // Связи
            $table->foreignId('game_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('cheat_status_id')->default(1);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');

            // SEO и метаданные
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Индексы для производительности
            $table->index(['game_id']);
            $table->index('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cheats');
    }
};
