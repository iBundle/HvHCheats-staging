<?php

use App\Models\Game;
use function Livewire\Volt\{state, computed};

// Reactive state
state(['limit' => 6]);

// Computed property for games with cheats (collections)
$collections = computed(function () {
    return Game::with(['cheats' => function ($query) {
        $query->limit(5)->select('id', 'name', 'image', 'slug', 'game_id', 'love');
    }])
        ->active()
        ->whereHas('cheats') // Только игры у которых есть читы
        ->withCount('cheats')
        ->ordered()
        ->limit($this->limit)
        ->get()
        ->map(function ($game) {
            // Получаем массив читов
            $cheats = $game->cheats->toArray();

            // Если читов меньше 5, показываем только 2
            if (count($cheats) < 5) {
                $game->cheat_images = array_slice($cheats, 0, 2);
                $game->display_mode = 'limited'; // Режим ограниченного отображения
            } else {
                // Если читов 5 или больше, показываем все 5
                $game->cheat_images = array_slice($cheats, 0, 5);
                $game->display_mode = 'full'; // Полный режим отображения
            }

            return $game;
        });
});



?>

<section id="collections">
    <div class="container collections__wrapper">
        <div class="section__header">
            <h2 class="section__title">Популярные коллекции</h2>
        </div>

        <div id="collections-page" class="collections__page">
            @forelse($this->collections as $collection)
                <article id="collection_{{ $collection->id }}" class="article collection__card">
                    <div class="collection__img-container">
                        @if($collection->display_mode === 'limited')
                            {{-- Режим ограниченного отображения: только 2 изображения --}}
                            @foreach($collection->cheat_images as $index => $cheat)
                                @php
                                    $limitedClasses = [
                                        0 => 'collection__img--first',
                                        1 => 'collection__img--second'
                                    ];
                                @endphp
                                <img src="{{ $cheat['image'] ?? '/Assets/Images/06_Popular_Collection/placeholder.jpg' }}"
                                     alt="{{ $collection->name }} cheat {{ $index + 1 }}"
                                     class="collection__img {{ $limitedClasses[$index] ?? '' }}"
                                     loading="lazy">
                            @endforeach
                        @else
                            {{-- Полный режим отображения: все 5 изображений --}}
                            @foreach($collection->cheat_images as $index => $cheat)
                                @php
                                    $positionClasses = [
                                        0 => 'collection__img--first',
                                        1 => 'collection__img--second',
                                        2 => 'collection__img--third',
                                        3 => 'collection__img--forth',
                                        4 => 'collection__img--fifth'
                                    ];
                                @endphp
                                <img src="{{ $cheat['image'] ?? '/Assets/Images/06_Popular_Collection/placeholder.jpg' }}"
                                     alt="{{ $collection->name }} cheat {{ $index + 1 }}"
                                     class="collection__img {{ $positionClasses[$index] ?? '' }}"
                                     loading="lazy">
                            @endforeach
                        @endif
                    </div>

                    <div class="collection__creator-info">
                        <a href="#" class="collection__creator-link">
                            <div class="collection__creator-img">
                                <img src="{{ $collection->image ?? '/Assets/Images/default-game.jpg' }}"
                                     alt="{{ $collection->name }} logo">
                                <i class="fa-solid fa-check"></i>
                            </div>
                        </a>

                        <div class="collection__info">
                            <h3 class="collection__name">
                                <a href="#" class="collection__link">{{ $collection->name }}</a>
                            </h3>
                            <p class="collection__creator">
                                Читов в коллекции: <span class="font-semibold">{{ $collection->cheats_count }}</span>
                            </p>
                        </div>

                        <div class="article__likes collection__likes">
                            <div class="like__btn"></div>
                            <p class="article__likes-count collection__likes-count">
                                {{ $collection->cheats->sum('love') }}
                            </p>
                        </div>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500 text-lg">Коллекции не найдены</p>
                    <p class="text-gray-400 text-sm mt-2">Добавьте игры и читы для отображения коллекций</p>
                </div>
            @endforelse
        </div>

        <button wire:click="$set('limit', {{ $this->limit + 6 }})"
                class="btn collections__load-btn"
                @if($this->collections->count() < $this->limit) style="display: none;" @endif>
            Загрузить еще
        </button>
    </div>
</section>