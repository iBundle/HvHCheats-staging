<?php

declare(strict_types=1);

namespace App\Actions\Games;

use App\Models\Game;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Create Game Action
 *
 * Обрабатывает создание новой игровой коллекции
 * с загрузкой изображения и генерацией мета-данных
 */
class CreateGameAction
{
    /**
     * Выполнить создание новой игровой коллекции
     */
    public function execute(array $data, ?UploadedFile $imageFile = null): Game
    {
        // Обработка изображения
        if ($imageFile) {
            $data['image'] = $this->handleImageUpload($imageFile, $data['slug']);
        }

        // Генерация мета-данных если они не заданы
        $data = $this->generateMetaData($data);

        // Создание игры
        $game = Game::create($data);

        return $game;
    }

    /**
     * Обработка загрузки изображения
     */
    private function handleImageUpload(UploadedFile $file, string $slug): string
    {
        // Генерируем уникальное имя файла
        $extension = $file->getClientOriginalExtension();
        $filename = $slug . '-' . time() . '.' . $extension;

        // Определяем путь для сохранения
        $directory = 'games/images';

        // Сохраняем файл в storage/app/public/games/images/
        $path = $file->storeAs($directory, $filename, 'public');

        // Возвращаем публичный путь
        return Storage::url($path);
    }

    /**
     * Генерация мета-данных для SEO
     */
    private function generateMetaData(array $data): array
    {
        $name = $data['name'];

        // Генерируем META Title если не задан
        if (empty($data['meta_title'])) {
            $data['meta_title'] = "Читы для {$name} - скачать бесплатно | HvHCheats";
        }

        // Генерируем META Description если не задано
        if (empty($data['meta_description'])) {
            $description = !empty($data['description'])
                ? Str::limit($data['description'], 120)
                : "Лучшие читы для {$name}. Безопасные, проверенные и постоянно обновляемые читы с гарантией качества.";

            $data['meta_description'] = $description;
        }

        // Генерируем META Keywords если не заданы
        if (empty($data['meta_keywords'])) {
            $keywords = [
                'читы',
                strtolower($name),
                'скачать',
                'бесплатно',
                'hvhcheats',
                'игровые читы',
                'безопасные читы'
            ];

            $data['meta_keywords'] = implode(', ', $keywords);
        }

        return $data;
    }

    /**
     * Валидация уникальности slug
     */
    public function validateSlugUniqueness(string $slug, ?int $excludeId = null): bool
    {
        $query = Game::where('slug', $slug);

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return !$query->exists();
    }

    /**
     * Генерация уникального slug из названия
     */
    public function generateUniqueSlug(string $name, ?int $excludeId = null): string
    {
        $baseSlug = Str::slug($name);
        $slug = $baseSlug;
        $counter = 1;

        // Проверяем уникальность и добавляем суффикс при необходимости
        while (!$this->validateSlugUniqueness($slug, $excludeId)) {
            $slug = $baseSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Очистка старых временных файлов (можно вызывать в cron)
     */
    public function cleanupTempFiles(): void
    {
        $tempPath = storage_path('app/livewire-tmp');

        if (is_dir($tempPath)) {
            $files = glob($tempPath . '/*');
            $now = time();

            foreach ($files as $file) {
                if (is_file($file) && ($now - filemtime($file)) > 3600) { // 1 час
                    unlink($file);
                }
            }
        }
    }
}