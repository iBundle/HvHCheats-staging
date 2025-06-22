<?php

use App\Actions\Cheats\CreateCheatAction;
use App\Models\Game;
use Livewire\WithFileUploads;
use function Livewire\Volt\{state, rules, mount, with, uses};

// Add the WithFileUploads trait
uses([WithFileUploads::class]);

// Component state
state([
    'name' => '',
    'slug' => '',
    'description' => '',
    'gameId' => '',
    'image' => null,
    'metaTitle' => '',
    'metaDescription' => '',
    'metaKeywords' => '',
    'currentStep' => 1,
    'isSubmitting' => false,
]);

// Auto-generate slug from name when name changes
$updated = function ($property, $value) {
    if ($property === 'name') {
        $this->slug = \Illuminate\Support\Str::slug($value);
    }
};

// Handle step navigation with validation
$nextStep = function () {
    // Validate Step 1 fields before proceeding
    $this->validate([
        'name' => 'required|string|min:3|max:255',
        'slug' => 'required|string|min:3|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:cheats,slug',
        'gameId' => 'required|exists:games,id',
        'description' => 'nullable|string|max:2000',
        'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
    ], [
        'name.required' => 'Название чита обязательно для заполнения.',
        'name.min' => 'Название должно содержать минимум 3 символа.',
        'name.max' => 'Название не может превышать 255 символов.',
        'slug.required' => 'SLUG обязателен для заполнения.',
        'slug.min' => 'SLUG должен содержать минимум 3 символа.',
        'slug.max' => 'SLUG не может превышать 255 символов.',
        'slug.regex' => 'SLUG может содержать только строчные буквы, цифры и дефисы.',
        'slug.unique' => 'SLUG уже используется. Выберите другой.',
        'gameId.required' => 'Выберите игру для чита.',
        'gameId.exists' => 'Выбранная игра не существует.',
        'description.max' => 'Описание не может превышать 2000 символов.',
        'image.image' => 'Файл должен быть изображением.',
        'image.mimes' => 'Поддерживаются только форматы: JPEG, JPG, PNG, WebP.',
        'image.max' => 'Размер изображения не должен превышать 2MB.',
    ]);

    $this->currentStep = 2;
};
$getGames = function () {
    return Game::select('id', 'name')
        ->where('is_active', true)
        ->orderBy('name')
        ->get();
};

// Handle form submission
$save = function () {
    $this->isSubmitting = true;

    try {
        // Validate the form with custom messages
        $validatedData = $this->validate([
            'name' => 'required|string|min:3|max:255',
            'slug' => 'required|string|min:3|max:255|regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/|unique:cheats,slug',
            'description' => 'nullable|string|max:2000',
            'gameId' => 'required|exists:games,id',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:2048',
            'metaTitle' => 'nullable|string|max:60',
            'metaDescription' => 'nullable|string|max:160',
            'metaKeywords' => 'nullable|string|max:255',
        ], [
            'name.required' => 'Название чита обязательно для заполнения.',
            'name.min' => 'Название должно содержать минимум 3 символа.',
            'name.max' => 'Название не может превышать 255 символов.',
            'slug.required' => 'SLUG обязателен для заполнения.',
            'slug.min' => 'SLUG должен содержать минимум 3 символа.',
            'slug.max' => 'SLUG не может превышать 255 символов.',
            'slug.regex' => 'SLUG может содержать только строчные буквы, цифры и дефисы.',
            'slug.unique' => 'SLUG уже используется. Выберите другой.',
            'description.max' => 'Описание не может превышать 2000 символов.',
            'gameId.required' => 'Выберите игру для чита.',
            'gameId.exists' => 'Выбранная игра не существует.',
            'image.image' => 'Файл должен быть изображением.',
            'image.mimes' => 'Поддерживаются только форматы: JPEG, JPG, PNG, WebP.',
            'image.max' => 'Размер изображения не должен превышать 2MB.',
            'metaTitle.max' => 'META Title не должен превышать 60 символов.',
            'metaDescription.max' => 'META Description не должно превышать 160 символов.',
            'metaKeywords.max' => 'META Keywords не должны превышать 255 символов.',
        ]);

        // Prepare data for Action class
        $cheatData = [
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'description' => $validatedData['description'],
            'game_id' => $validatedData['gameId'],
            'meta_title' => $validatedData['metaTitle'],
            'meta_description' => $validatedData['metaDescription'],
            'meta_keywords' => $validatedData['metaKeywords'],
            'created_by' => auth()->id(),
        ];

        // Debug: Log form data and image
        \Illuminate\Support\Facades\Log::info('Form submission data', [
            'cheat_data' => $cheatData,
            'has_image' => !is_null($this->image),
            'image_type' => $this->image ? get_class($this->image) : 'null',
            'image_valid' => $this->image ? $this->image->isValid() : 'no image',
        ]);

        // Create cheat using Action
        $action = new CreateCheatAction();
        $cheat = $action->execute($cheatData, $this->image);

        // Success
        session()->flash('success', 'Чит "' . $cheat->name . '" успешно создан!');

        // Reset form
        $this->reset();
        $this->currentStep = 1;

        // Redirect to cheats list
        return redirect()->route('cheats');

    } catch (\Illuminate\Validation\ValidationException $e) {
        $this->isSubmitting = false;
        // Validation errors will be automatically shown by Livewire

    } catch (\Exception $e) {
        $this->isSubmitting = false;
        session()->flash('error', 'Произошла ошибка при создании чита. Попробуйте еще раз.');

        // Log the error for debugging
        \Illuminate\Support\Facades\Log::error('Cheat creation error: ' . $e->getMessage());
    }
};

// Pass data to view
with(function () {
    return [
        'games' => $this->getGames(),
    ];
});

?>

<div class="max-w-4xl mx-auto">
    {{-- Progress Steps --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center {{ $currentStep >= 1 ? 'text-violet-600' : 'text-gray-400' }}">
                <div class="flex items-center justify-center w-8 h-8 rounded-full {{ $currentStep >= 1 ? 'bg-violet-600 text-white' : 'bg-gray-200 text-gray-400' }}">
                    1
                </div>
                <span class="ml-2 text-sm font-medium">Основная информация</span>
            </div>
            <div class="flex-1 h-1 mx-4 {{ $currentStep >= 2 ? 'bg-violet-600' : 'bg-gray-200' }}"></div>
            <div class="flex items-center {{ $currentStep >= 2 ? 'text-violet-600' : 'text-gray-400' }}">
                <div class="flex items-center justify-center w-8 h-8 rounded-full {{ $currentStep >= 2 ? 'bg-violet-600 text-white' : 'bg-gray-200 text-gray-400' }}">
                    2
                </div>
                <span class="ml-2 text-sm font-medium">SEO и мета-данные</span>
            </div>
        </div>
    </div>

    {{-- Form Container --}}
    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden">
        <form wire:submit="save">
            @if($currentStep === 1)
                {{-- Step 1: Basic Information --}}
                <div class="p-6 space-y-6">
                    <div class="flex items-center justify-between border-b border-zinc-200 dark:border-zinc-700 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            Основная информация
                        </h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Name --}}
                        <div class="md:col-span-2">
                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Название чита <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   wire:model.live="name"
                                   id="name"
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-violet-500 focus:border-transparent @error('name') border-red-500 focus:ring-red-500 @enderror"
                                   placeholder="Например: AimBot Pro v2.1">
                            @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Slug --}}
                        <div class="md:col-span-2">
                            <label for="slug" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                SLUG (URL) <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   wire:model.blur="slug"
                                   id="slug"
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-violet-500 focus:border-transparent @error('slug') border-red-500 focus:ring-red-500 @enderror"
                                   placeholder="aimbot-pro-v2-1">
                            @error('slug')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Автоматически генерируется из названия
                            </p>
                        </div>

                        {{-- Game Selection --}}
                        <div class="md:col-span-1">
                            <label for="gameId" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Игра <span class="text-red-500">*</span>
                            </label>
                            <select wire:model.live="gameId"
                                    id="gameId"
                                    required
                                    class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-violet-500 focus:border-transparent @error('gameId') border-red-500 focus:ring-red-500 @enderror">
                                <option value="">Выберите игру</option>
                                @foreach($games as $game)
                                    <option value="{{ $game->id }}">{{ $game->name }}</option>
                                @endforeach
                            </select>
                            @error('gameId')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Image Upload --}}
                        <div class="md:col-span-1">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Изображение чита
                            </label>
                            <input type="file"
                                   wire:model="image"
                                   id="image"
                                   accept="image/*"
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-violet-500 focus:border-transparent @error('image') border-red-500 focus:ring-red-500 @enderror">

                            {{-- Upload Progress --}}
                            <div wire:loading wire:target="image" class="mt-2">
                                <div class="flex items-center text-sm text-gray-600 dark:text-gray-400">
                                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Загрузка изображения...
                                </div>
                            </div>

                            {{-- Image Preview --}}
                            @if ($image)
                                <div class="mt-2">
                                    <div class="flex items-center text-sm text-green-600 dark:text-green-400">
                                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                        </svg>
                                        Изображение загружено: {{ $image->getClientOriginalName() }}
                                    </div>
                                    <div class="mt-2">
                                        <img src="{{ $image->temporaryUrl() }}"
                                             alt="Preview"
                                             class="h-20 w-20 object-cover rounded-lg border border-gray-300 dark:border-zinc-600">
                                        <p class="text-xs text-gray-500 mt-1">
                                            Размер: {{ number_format($image->getSize() / 1024, 1) }} KB
                                        </p>
                                    </div>
                                </div>
                            @endif

                            @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                JPG, PNG, WebP. Максимум 2MB
                            </p>
                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Описание чита
                            </label>
                            <textarea wire:model.blur="description"
                                      id="description"
                                      rows="6"
                                      class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-violet-500 focus:border-transparent @error('description') border-red-500 focus:ring-red-500 @enderror"
                                      placeholder="Подробное описание функций и возможностей чита..."></textarea>
                            @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Максимум 2000 символов ({{ strlen($description ?? '') }}/2000)
                            </p>
                        </div>
                    </div>

                    {{-- Step 1 Actions --}}
                    <div class="flex justify-end pt-4 border-t border-zinc-200 dark:border-zinc-700">
                        <button type="button"
                                wire:click="nextStep"
                                wire:loading.attr="disabled"
                                wire:target="nextStep"
                                class="px-6 py-2 bg-violet-600 text-white rounded-lg hover:bg-violet-700 transition-colors disabled:opacity-50">
                            <span wire:loading.remove wire:target="nextStep">
                                Далее: SEO настройки
                            </span>
                            <span wire:loading wire:target="nextStep" class="flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Проверка...
                            </span>
                        </button>
                    </div>
                </div>

            @elseif($currentStep === 2)
                {{-- Step 2: SEO and Meta Data --}}
                <div class="p-6 space-y-6">
                    <div class="flex items-center justify-between border-b border-zinc-200 dark:border-zinc-700 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                            SEO и мета-данные
                        </h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            Необязательно - будет сгенерировано автоматически
                        </p>
                    </div>

                    <div class="space-y-6">
                        {{-- Meta Title --}}
                        <div>
                            <label for="metaTitle" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                META Title
                            </label>
                            <input type="text"
                                   wire:model="metaTitle"
                                   id="metaTitle"
                                   maxlength="60"
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                   placeholder="Автоматически сгенерируется из названия">
                            @error('metaTitle')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Максимум 60 символов. Символов: {{ strlen($metaTitle) }}
                            </p>
                        </div>

                        {{-- Meta Description --}}
                        <div>
                            <label for="metaDescription" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                META Description
                            </label>
                            <textarea wire:model="metaDescription"
                                      id="metaDescription"
                                      rows="3"
                                      maxlength="160"
                                      class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                      placeholder="Автоматически сгенерируется из описания"></textarea>
                            @error('metaDescription')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Максимум 160 символов. Символов: {{ strlen($metaDescription) }}
                            </p>
                        </div>

                        {{-- Meta Keywords --}}
                        <div>
                            <label for="metaKeywords" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                META Keywords
                            </label>
                            <input type="text"
                                   wire:model="metaKeywords"
                                   id="metaKeywords"
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-violet-500 focus:border-transparent"
                                   placeholder="чит, hack, aimbot, cs2, скачать">
                            @error('metaKeywords')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                Ключевые слова через запятую
                            </p>
                        </div>
                    </div>

                    {{-- Step 2 Actions --}}
                    <div class="flex justify-between pt-4 border-t border-zinc-200 dark:border-zinc-700">
                        <button type="button"
                                wire:click="$set('currentStep', 1)"
                                class="px-6 py-2 border border-gray-300 dark:border-zinc-600 text-gray-700 dark:text-gray-300 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors">
                            Назад
                        </button>

                        <button type="submit"
                                wire:loading.attr="disabled"
                                wire:target="save"
                                class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors disabled:opacity-50">
                            <span wire:loading.remove wire:target="save">
                                Создать чит
                            </span>
                            <span wire:loading wire:target="save">
                                Создание...
                            </span>
                        </button>
                    </div>
                </div>
            @endif
        </form>
    </div>

    {{-- Success/Error Messages --}}
    @if(session()->has('success'))
        <div class="mt-4 p-4 bg-green-100 text-green-800 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    @if(session()->has('error'))
        <div class="mt-4 p-4 bg-red-100 text-red-800 rounded-lg border border-red-200">
            {{ session('error') }}
        </div>
    @endif
</div>