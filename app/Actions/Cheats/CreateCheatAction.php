<?php

declare(strict_types=1);

namespace App\Actions\Cheats;

use App\Models\Cheat;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Create Cheat Action
 *
 * Обрабатывает создание нового чита
 * с загрузкой изображения и генерацией мета-данных
 */
class CreateCheatAction
{
    /**
     * Выполнить создание нового чита
     */
    public function execute(array $data, ?UploadedFile $imageFile = null): Cheat
    {
        // Debug: Log file information
        if ($imageFile) {
            \Illuminate\Support\Facades\Log::info('CreateCheatAction: Image file received', [
                'original_name' => $imageFile->getClientOriginalName(),
                'size' => $imageFile->getSize(),
                'mime_type' => $imageFile->getMimeType(),
                'is_valid' => $imageFile->isValid(),
            ]);
        } else {
            \Illuminate\Support\Facades\Log::info('CreateCheatAction: No image file provided');
        }

        // Обработка изображения
        if ($imageFile && $imageFile->isValid()) {
            $data['image'] = $this->handleImageUpload($imageFile, $data['slug']);
            \Illuminate\Support\Facades\Log::info('CreateCheatAction: Image uploaded', [
                'path' => $data['image']
            ]);
        }

        // Генерация мета-данных если они не заданы
        $data = $this->generateMetaData($data);

        // Установка значений по умолчанию
        $data = array_merge([
            'love' => 0,
            'downloads' => 0,
            'cheat_status_id' => 1, // Default active status
        ], $data);

        // Debug: Log final data
        \Illuminate\Support\Facades\Log::info('CreateCheatAction: Creating cheat with data', [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'game_id' => $data['game_id'],
            'has_image' => isset($data['image']),
            'image_path' => $data['image'] ?? 'null',
        ]);

        // Создание чита
        $cheat = Cheat::create($data);

        return $cheat;
    }

    /**
     * Обработка загрузки изображения
     */
    private function handleImageUpload(UploadedFile $file, string $slug): string
    {
        try {
            // Проверяем валидность файла
            if (!$file->isValid()) {
                throw new \Exception('Загруженный файл недействителен');
            }

            // Генерируем уникальное имя файла
            $extension = $file->getClientOriginalExtension();
            $filename = $slug . '-' . time() . '.' . $extension;

            // Определяем путь для сохранения
            $directory = 'cheats/images';

            // Создаем директорию если её нет
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            // Сохраняем файл в storage/app/public/cheats/images/
            $path = $file->storeAs($directory, $filename, 'public');

            if (!$path) {
                throw new \Exception('Не удалось сохранить файл');
            }

            // Возвращаем публичный путь
            $publicPath = Storage::url($path);

            \Illuminate\Support\Facades\Log::info('Image uploaded successfully', [
                'original_name' => $file->getClientOriginalName(),
                'stored_path' => $path,
                'public_url' => $publicPath,
                'file_exists' => Storage::disk('public')->exists($path),
            ]);

            return $publicPath;

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Image upload failed', [
                'error' => $e->getMessage(),
                'file_name' => $file->getClientOriginalName(),
                'slug' => $slug,
            ]);

            throw new \Exception('Ошибка при загрузке изображения: ' . $e->getMessage());
        }
    }

    /**
     * Генерация мета-данных для SEO
     */
    private function generateMetaData(array $data): array
    {
        $cheatName = $data['name'];
        $gameName = isset($data['game_id'])
            ? \App\Models\Game::find($data['game_id'])?->name ?? 'игры'
            : 'игры';

        // Генерируем META Title если не задан
        if (empty($data['meta_title'])) {
            $data['meta_title'] = "{$cheatName} для {$gameName} - скачать бесплатно | HvHCheats";
        }

        // Генерируем META Description если не задано
        if (empty($data['meta_description'])) {
            $description = !empty($data['description'])
                ? Str::limit($data['description'], 120)
                : "Скачать {$cheatName} для {$gameName}. Безопасный, проверенный и постоянно обновляемый чит с гарантией качества.";

            $data['meta_description'] = $description;
        }

        // Генерируем META Keywords если не заданы
        if (empty($data['meta_keywords'])) {
            $keywords = [
                'чит',
                'hack',
                'читы',
                strtolower($cheatName),
                strtolower($gameName),
                'скачать',
                'бесплатно',
                'hvhcheats'
            ];

            $data['meta_keywords'] = implode(', ', array_unique($keywords));
        }

        return $data;
    }
}