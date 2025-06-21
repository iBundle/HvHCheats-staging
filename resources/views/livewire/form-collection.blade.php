<?php

use function Livewire\Volt\{state, computed, updated, uses};
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

// Add file upload trait
uses([WithFileUploads::class]);

// Form state management
state([
    'currentStep' => 1,
    'totalSteps' => 3,

    // Step 1: Basic Information
    'name' => '',
    'slug' => '',

    // Step 2: Media
    'image' => null,
    'imagePreview' => null,

    // Step 3: Additional Information
    'description' => '',
    'metaTitle' => '',
    'metaDescription' => '',
    'metaKeywords' => '',
]);

// Auto-generate slug when name changes
updated(['name' => function ($value) {
    if (!empty($value) && empty($this->slug)) {
        $this->slug = Str::slug($value);
    }
}]);

// Progress calculation
$progressPercentage = computed(function () {
    return ($this->currentStep / $this->totalSteps) * 100;
});

// Step validation and navigation
$canProceedToNextStep = computed(function () {
    switch ($this->currentStep) {
        case 1:
            return !empty($this->name) && !empty($this->slug);
        case 2:
            return !empty($this->imagePreview);
        case 3:
            return true;
        default:
            return false;
    }
});

// Navigation methods
$nextStep = function () {
    if ($this->canProceedToNextStep && $this->currentStep < $this->totalSteps) {
        $this->currentStep++;
    }
};

$previousStep = function () {
    if ($this->currentStep > 1) {
        $this->currentStep--;
    }
};

// File upload handling
$updatedImage = function () {
    if ($this->image) {
        $this->imagePreview = $this->image->temporaryUrl();
    }
};

// Form submission (placeholder for now)
$submitForm = function () {
    session()->flash('success', 'Коллекция успешно создана!');
    $this->reset();
    $this->currentStep = 1;
};

?>

<div class="min-h-screen"
     x-data="{ currentStep: @entangle('currentStep') }">

    <div class="container mx-auto px-4 max-w-4xl py-8">

        {{-- Header Section --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">
                Создание новой коллекции
            </h1>
            <p class="text-gray-400">
                Добавьте новую игру в каталог читов
            </p>
        </div>

        {{-- Progress Bar --}}
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                @for($i = 1; $i <= $totalSteps; $i++)
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full transition-all duration-300"
                             :class="{
                                 'bg-violet-600 text-white shadow-lg shadow-violet-500/25': currentStep >= {{ $i }},
                                 'bg-gray-700 text-gray-400 border border-gray-600': currentStep < {{ $i }}
                             }">
                            @if($i <= 1)
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z"/>
                                </svg>
                            @else
                                <span class="text-sm font-semibold">{{ $i }}</span>
                            @endif
                        </div>
                        @if($i < $totalSteps)
                            <div class="h-1 w-20 mx-4 transition-all duration-300 rounded-full"
                                 :class="{
                                     'bg-violet-600': currentStep > {{ $i }},
                                     'bg-gray-700': currentStep <= {{ $i }}
                                 }">
                            </div>
                        @endif
                    </div>
                @endfor
            </div>

            {{-- Progress Labels --}}
            <div class="flex justify-between text-sm">
                <span :class="{ 'text-violet-400 font-semibold': currentStep >= 1, 'text-gray-500': currentStep < 1 }">
                    Название коллекции
                </span>
                <span :class="{ 'text-violet-400 font-semibold': currentStep >= 2, 'text-gray-500': currentStep < 2 }">
                    Подробности
                </span>
                <span :class="{ 'text-violet-400 font-semibold': currentStep >= 3, 'text-gray-500': currentStep < 3 }">
                    Подтверждение
                </span>
            </div>
        </div>

        {{-- Main Form Card --}}
        <div class="rounded-2xl shadow-2xl border overflow-hidden">

            {{-- Form Content --}}
            <div class="p-8">
                <form wire:submit="submitForm">

                    {{-- Step 1: Basic Information --}}
                    <div x-show="currentStep === 1"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-x-6"
                         x-transition:enter-end="opacity-100 transform translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform translate-x-0"
                         x-transition:leave-end="opacity-0 transform -translate-x-6">

                        <div class="max-w-md mx-auto space-y-6">
                            <div class="text-center mb-8">
                                <div class="w-16 h-16 bg-violet-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-violet-500/25">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold text-white mb-2">
                                    Название коллекции
                                </h2>
                                <p class="text-gray-400">
                                    Введите основную информацию о коллекции
                                </p>
                            </div>

                            {{-- Game Name Field --}}
                            <div class="space-y-3">
                                <label for="name" class="block text-sm font-medium text-gray-300">
                                    Название коллекции
                                </label>
                                <flux:input type="text"
                                       id="name"
                                       wire:model.live="name"
                                       placeholder="Например: Counter-Strike 2"/>
                                @error('name')
                                <p class="text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Slug Field --}}
                            <div class="space-y-3">
                                <label for="slug" class="block text-sm font-medium text-gray-300">
                                    SLUG коллекции
                                </label>
                                <div class="relative">
                                    <flux:input type="text"
                                           id="slug"
                                           wire:model.live="slug"
                                           placeholder="counter-strike-2"/>
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                        @if(!empty($slug))
                                            <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                        @endif
                                    </div>
                                </div>
                                @error('slug')
                                <p class="text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                                <p class="text-gray-500 text-sm">
                                    Автоматически создается из названия
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Step 2: Details --}}
                    <div x-show="currentStep === 2"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-x-6"
                         x-transition:enter-end="opacity-100 transform translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform translate-x-0"
                         x-transition:leave-end="opacity-0 transform -translate-x-6">

                        <div class="max-w-md mx-auto space-y-6">
                            <div class="text-center mb-8">
                                <div class="w-16 h-16 bg-violet-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-violet-500/25">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold text-white mb-2">
                                    Подробности
                                </h2>
                                <p class="text-gray-400">
                                    Добавьте описание и изображение
                                </p>
                            </div>

                            {{-- Description --}}
                            <div class="space-y-3">
                                <label for="description" class="block text-sm font-medium text-gray-300">
                                    Описание коллекции
                                </label>
                                <flux:textarea id="description"
                                          wire:model="description"
                                          rows="4"
                                          placeholder="Краткое описание коллекции..."></flux:textarea>
                            </div>

                            {{-- Image Upload Area --}}
                            <div class="space-y-3">
                                <label class="block text-sm font-medium text-gray-300">
                                    Изображение коллекции (1:1)
                                </label>

                                <div class="relative">
                                    @if($imagePreview)
                                        {{-- Image Preview --}}
                                        <div class="relative mx-auto w-48 h-48 rounded-xl overflow-hidden shadow-lg border border-gray-600">
                                            <img src="{{ $imagePreview }}"
                                                 alt="Предпросмотр изображения"
                                                 class="w-full h-full object-cover">
                                            <div class="absolute top-2 right-2">
                                                <button type="button"
                                                        wire:click="$set('imagePreview', null)"
                                                        class="bg-red-500 text-white rounded-full w-8 h-8 flex items-center justify-center hover:bg-red-600 transition-colors shadow-lg">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @else
                                        {{-- Upload Dropzone --}}
                                        <div class="border-2 border-dashed border-gray-600 rounded-xl p-6 text-center hover:border-violet-500 transition-colors">
                                            <div class="mx-auto w-12 h-12 text-gray-400 mb-3">
                                                <svg fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <h3 class="text-lg font-medium text-white mb-2">
                                                Загрузите изображение
                                            </h3>
                                            <p class="text-gray-400 mb-4 text-sm">
                                                PNG, JPG, WEBP до 2MB
                                            </p>
                                            <label class="inline-flex items-center px-4 py-2 bg-violet-600 text-white rounded-lg hover:bg-violet-700 cursor-pointer transition-colors shadow-lg shadow-violet-500/25">
                                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.413V13H5.5z"/>
                                                </svg>
                                                Выбрать файл
                                                <input type="file"
                                                       wire:model="image"
                                                       accept="image/*"
                                                       class="hidden">
                                            </label>
                                        </div>
                                    @endif
                                </div>

                                @error('image')
                                <p class="text-red-400 text-sm">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Step 3: Confirmation --}}
                    <div x-show="currentStep === 3"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform translate-x-6"
                         x-transition:enter-end="opacity-100 transform translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 transform translate-x-0"
                         x-transition:leave-end="opacity-0 transform -translate-x-6">

                        <div class="max-w-md mx-auto space-y-6">
                            <div class="text-center mb-8">
                                <div class="w-16 h-16 bg-violet-600 rounded-full flex items-center justify-center mx-auto mb-4 shadow-lg shadow-violet-500/25">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <h2 class="text-2xl font-bold text-white mb-2">
                                    Подтверждение
                                </h2>
                                <p class="text-gray-400">
                                    Проверьте введенные данные
                                </p>
                            </div>

                            {{-- SEO Meta Fields --}}
                            <div class="rounded-xl p-6 space-y-4 border border-gray-600">
                                <h3 class="text-lg font-semibold text-white mb-4">
                                    SEO настройки (опционально)
                                </h3>

                                {{-- Meta Title --}}
                                <div class="space-y-2">
                                    <label for="metaTitle" class="block text-sm font-medium text-gray-300">
                                        META Title
                                    </label>
                                    <flux:input type="text"
                                           id="metaTitle"
                                           wire:model="metaTitle"
                                           x-bind:placeholder="'Читы для ' + ($wire.name || 'игры') + ' - скачать бесплатно'"/>
                                </div>

                                {{-- Meta Description --}}
                                <div class="space-y-2">
                                    <label for="metaDescription" class="block text-sm font-medium text-gray-300">
                                        META Description
                                    </label>
                                    <flux:textarea id="metaDescription"
                                              wire:model="metaDescription"
                                              rows="3"
                                              x-bind:placeholder="'Лучшие читы для ' + ($wire.name || 'игры') + '. Безопасные, проверенные и постоянно обновляемые читы с гарантией качества.'"></flux:textarea>
                                </div>

                                {{-- Meta Keywords --}}
                                <div class="space-y-2">
                                    <label for="metaKeywords" class="block text-sm font-medium text-gray-300">
                                        META Keywords
                                    </label>
                                    <flux:input type="text"
                                           id="metaKeywords"
                                           wire:model="metaKeywords"
                                           x-bind:placeholder="'читы, ' + ($wire.name || 'игра') + ', скачать, бесплатно'"/>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>

            {{-- Navigation Footer --}}
            <div class="bg-gray-700/50 px-8 py-6 border-t border-gray-600">
                <div class="flex items-center justify-between max-w-md mx-auto">

                    {{-- Previous Button --}}
                    <button type="button"
                            wire:click="previousStep"
                            x-show="currentStep > 1"
                            class="inline-flex items-center px-6 py-3 border border-gray-600 text-gray-300 rounded-lg hover:bg-gray-600 hover:text-white transition-all duration-200">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/>
                        </svg>
                        Назад
                    </button>

                    <div x-show="currentStep === 1"></div>

                    {{-- Navigation Buttons --}}
                    <div class="flex items-center space-x-4">
                        {{-- Next Button --}}
                        <button type="button"
                                wire:click="nextStep"
                                x-show="currentStep < 3"
                                x-bind:disabled="!canProceed"
                                x-data="{
                                    get canProceed() {
                                        if (currentStep === 1) return $wire.name && $wire.slug;
                                        if (currentStep === 2) return true;
                                        return true;
                                    }
                                }"
                                x-bind:class="{
                                    'bg-violet-600 text-white hover:bg-violet-700 shadow-lg shadow-violet-500/25': canProceed,
                                    'bg-gray-600 text-gray-400 cursor-not-allowed': !canProceed
                                }"
                                class="inline-flex items-center px-6 py-3 rounded-lg transition-all duration-200">
                            Продолжить
                            <svg class="w-4 h-4 ml-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </button>

                        {{-- Submit Button --}}
                        <button type="button"
                                wire:click="submitForm"
                                x-show="currentStep === 3"
                                class="inline-flex items-center px-8 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200 shadow-lg shadow-green-500/25">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            Создать коллекцию
                        </button>
                    </div>
                </div>
            </div>

        </div>

        {{-- Success Message --}}
        @if(session()->has('success'))
            <div class="mt-6 bg-green-900/50 border border-green-700 rounded-lg p-4">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-green-400 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-green-300 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        @endif

    </div>

    {{-- Loading States --}}
    <div wire:loading.flex class="fixed inset-0 bg-black bg-opacity-75 items-center justify-center z-50">
        <div class="bg-gray-800 rounded-lg p-6 flex items-center space-x-4 border border-gray-700">
            <svg class="animate-spin h-6 w-6 text-violet-500" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-gray-200">Обработка...</span>
        </div>
    </div>

</div>
