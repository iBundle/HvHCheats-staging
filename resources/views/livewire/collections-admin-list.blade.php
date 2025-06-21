<?php

use App\Models\Game;
use function Livewire\Volt\{state, with};

// Component state
state([
    'search' => '',
]);

// Method to get collections
$getCollections = function () {
    $query = Game::query()
        ->select('id', 'name', 'slug', 'image', 'created_at')
        ->withCount('cheats');

    // Search functionality
    if (!empty($this->search)) {
        $query->where(function ($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        });
    }

    // Order by name
    $query->orderByDesc('created_at');

    return $query->paginate(12);
};

// Pass data to view
with(function () {
    return [
        'collections' => $this->getCollections(),
    ];
});

?>

<div class="space-y-6">
    {{-- Header Section --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                Коллекции ({{ $collections->total() }})
            </h2>
            <p class="text-gray-600 dark:text-gray-400">
                Список всех игровых коллекций
            </p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('collections.create') }}"
               class="inline-flex items-center px-4 py-2 bg-violet-600 text-white rounded-lg hover:bg-violet-700 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                Добавить коллекцию
            </a>
        </div>
    </div>

    {{-- Search --}}
    <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 p-4">
        <div class="max-w-md">
            <input type="text"
                   wire:model.live.debounce.300ms="search"
                   placeholder="Поиск коллекций..."
                   class="w-full px-4 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg bg-white dark:bg-zinc-800 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-violet-500 focus:border-transparent">
        </div>
    </div>

    {{-- Collections Grid --}}
    @if($collections->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($collections as $collection)
                <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 overflow-hidden hover:shadow-lg transition-shadow duration-200">
                    {{-- Image --}}
                    <div class="aspect-square bg-zinc-100 dark:bg-zinc-800 relative overflow-hidden">
                        @if($collection->image)
                            <img
                                    src="{{ $collection->image }}"
                                    alt="{{ $collection->name }}"
                                    class="w-full h-full object-cover"
                                    loading="lazy">
                        @else
                            <div class="w-full h-full flex items-center justify-center">
                                <svg class="w-12 h-12 text-zinc-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        @endif

                        {{-- Cheats Count Badge --}}
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-violet-100 text-violet-800 dark:bg-violet-900 dark:text-violet-200">
                                {{ $collection->cheats_count }}
                                @if($collection->cheats_count == 1)
                                    чит
                                @elseif($collection->cheats_count >= 2 && $collection->cheats_count <= 4)
                                    чита
                                @else
                                    читов
                                @endif
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-4">
                        <h3 class="font-semibold text-gray-900 dark:text-white text-lg leading-tight">
                            {{ $collection->name }}
                        </h3>
                        <p class="text-sm text-zinc-500 dark:text-zinc-400 font-mono mt-1">
                            /{{ $collection->slug }}
                        </p>
                        <p class="text-xs text-zinc-500 dark:text-zinc-400 mt-2">
                            Создано: {{ $collection->created_at->format('d.m.Y') }}
                        </p>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($collections->hasPages())
            <div class="flex justify-center">
                {{ $collections->links() }}
            </div>
        @endif

    @else
        {{-- Empty State --}}
        <div class="text-center py-12">
            <div class="bg-white dark:bg-zinc-900 rounded-xl border border-zinc-200 dark:border-zinc-700 p-8 max-w-md mx-auto">
                <svg class="w-16 h-16 text-zinc-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"/>
                </svg>

                @if(!empty($search))
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        Коллекции не найдены
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        По запросу "{{ $search }}" ничего не найдено.
                    </p>
                    <button
                            wire:click="$set('search', '')"
                            class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-zinc-600 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-zinc-800">
                        Очистить поиск
                    </button>
                @else
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">
                        Коллекции отсутствуют
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-4">
                        Пока что не создано ни одной коллекции.
                    </p>
                    <a href="{{ route('collections.create') }}"
                       class="inline-flex items-center px-4 py-2 bg-violet-600 text-white rounded-lg hover:bg-violet-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                        </svg>
                        Создать коллекцию
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>