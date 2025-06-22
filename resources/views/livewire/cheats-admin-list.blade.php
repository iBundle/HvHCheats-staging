<?php

use App\Models\Cheat;
use function Livewire\Volt\{state, with};

// Component state
state([
    'search' => '',
    'gameFilter' => '',
]);

// Method to get cheats
$getCheats = function () {
    $query = Cheat::query()
        ->select('id', 'name', 'slug', 'image', 'downloads', 'love', 'created_at', 'game_id')
        ->with(['game:id,name,slug', 'creator:id,name']);

    // Search functionality
    if (!empty($this->search)) {
        $query->where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%');
        });
    }

    // Game filter
    if (!empty($this->gameFilter)) {
        $query->where('game_id', $this->gameFilter);
    }

    // Order by creation date
    $query->orderByDesc('created_at');

    return $query->paginate(12);
};

// Method to get games for filter
$getGames = function () {
    return \App\Models\Game::select('id', 'name')
        ->orderBy('name')
        ->get();
};

// Pass data to view
with(function () {
    return [
        'cheats' => $this->getCheats(),
        'games' => $this->getGames(),
    ];
});

?>

<div class="space-y-6">
    {{-- Header Section --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Читы ({{ $cheats->total() }})
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                Список всех игровых читов
            </p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('cheats.create') }}"
               class="inline-flex items-center px-4 py-2 bg-violet-600 text-white rounded-lg hover:bg-violet-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                Добавить чит
            </a>
        </div>
    </div>

    {{-- Filters --}}
    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 p-4">
        <div class="flex flex-col gap-4 md:flex-row md:items-center">
            {{-- Search --}}
            <div class="flex-1">
                <input type="text"
                       wire:model.live.debounce.300ms="search"
                       placeholder="Поиск читов..."
                       class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-violet-500 focus:border-transparent">
            </div>

            {{-- Game Filter --}}
            <div class="w-full md:w-64">
                <select wire:model.live="gameFilter"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white focus:ring-2 focus:ring-violet-500 focus:border-transparent">
                    <option value="">Все игры</option>
                    @foreach($games as $game)
                        <option value="{{ $game->id }}">{{ $game->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Clear Filters --}}
            @if(!empty($search) || !empty($gameFilter))
                <button wire:click="$set('search', ''); $set('gameFilter', '')"
                        class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white border border-gray-300 dark:border-zinc-600 rounded-lg hover:bg-gray-50 dark:hover:bg-zinc-800 transition-colors">
                    Очистить
                </button>
            @endif
        </div>
    </div>

    {{-- Cheats Grid --}}
    @if($cheats->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($cheats as $cheat)
                <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden hover:shadow-lg transition-shadow duration-200">
                    {{-- Image --}}
                    <div class="aspect-square bg-zinc-100 dark:bg-zinc-800 relative overflow-hidden">
                        @if($cheat->image)
                            <img
                                    src="{{ $cheat->image }}"
                                    alt="{{ $cheat->name }}"
                                    class="w-full h-full object-cover"
                                    loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-zinc-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        @endif

                        {{-- Stats Badges --}}
                        <div class="absolute top-3 left-3 space-y-1">
                            {{-- Downloads --}}
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                                {{ number_format($cheat->downloads) }}
                            </span>

                            {{-- Likes --}}
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                </svg>
                                {{ number_format($cheat->love) }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-4">
                        <div class="flex items-start justify-between gap-2 mb-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white text-lg leading-tight flex-1">
                                {{ $cheat->name }}
                            </h3>
                            {{-- Game Badge - moved here --}}
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-violet-100 text-violet-800 dark:bg-violet-900 dark:text-violet-200 flex-shrink-0">
                                {{ $cheat->game->name }}
                            </span>
                        </div>

                        <p class="text-sm text-zinc-500 dark:text-zinc-400 font-mono mt-1">
                            /{{ $cheat->slug }}
                        </p>

                        {{-- Creator --}}
                        @if($cheat->creator)
                            <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-2">
                                Автор: {{ $cheat->creator->name }}
                            </p>
                        @endif

                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-1">
                            Создано: {{ $cheat->created_at->format('d.m.Y') }}
                        </p>

                        {{-- Actions --}}
                        <div class="flex items-center justify-between mt-4 pt-3 border-t border-zinc-200 dark:border-zinc-700">
                            <a href="{{ route('cheat.show', $cheat->slug) }}"
                               target="_blank"
                               class="text-violet-600 hover:text-violet-700 dark:text-violet-400 dark:hover:text-violet-300 text-sm font-medium">
                                Просмотр
                            </a>

                            <div class="flex items-center gap-2">
                                <button class="text-zinc-500 hover:text-zinc-700 dark:text-zinc-400 dark:hover:text-zinc-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                                    </svg>
                                </button>
                                <button class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($cheats->hasPages())
            <div class="flex justify-center">
                {{ $cheats->links() }}
            </div>
        @endif

    @else
        {{-- Empty State --}}
        <div class="text-center py-12">
            <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 p-8 max-w-md mx-auto">
                <svg class="w-16 h-16 text-zinc-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>

                @if(!empty($search) || !empty($gameFilter))
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        Читы не найдены
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        По заданным фильтрам ничего не найдено.
                    </p>
                    <button
                            wire:click="$set('search', ''); $set('gameFilter', '')"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-800">
                        Очистить фильтры
                    </button>
                @else
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        Читы отсутствуют
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Пока что не создано ни одного чита.
                    </p>
                    <a href="{{ route('cheats.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-violet-600 text-white rounded-lg hover:bg-violet-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        Создать чит
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>