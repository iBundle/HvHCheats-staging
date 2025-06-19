<?php

use App\Models\Cheat;
use function Livewire\Volt\{state, computed};

// Reactive state
state(['limit' => 12]);

// Computed property for cheats
$cheats = computed(function () {
    return Cheat::with('game')
        ->latest()
        ->limit($this->limit)
        ->get();
});

?>

<section id="picks">
    <div class="container picks__wrapper">
        <div class="section__header">
            <h2 class="section__title">Список читов</h2>
        </div>

        <div id="picks-cards" class="picks__cards">
            @forelse($this->cheats as $cheat)
                <article class="article picks__card">
                    <div class="card__img-container">
                        <a href="{{ route('cheat.show', $cheat->slug) }}">
                            <img src="{{ $cheat->image }}"
                                 alt="{{ $cheat->name }}"
                                 class="card__img"
                                 loading="lazy">
                        </a>
                    </div>

                    <div class="card__info">
                        <h3 class="card__title">
                            <a href="{{ route('cheat.show', $cheat->slug) }}">{{ $cheat->name }}</a>
                        </h3>
                        <div class="card__creator">
                            <a href="#">
                                <img src="{{ $cheat->game->image }}"
                                     alt="{{ $cheat->game->name }}"
                                     class="creator__img">
                            </a>
                            <div class="creator__info">
                                <p class="creator__label">Игра</p>
                                <a href="#"
                                   class="creator__name">{{ $cheat->game->name }}</a>
                            </div>
                            {{--                            <div class="creator__bsc bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium">--}}
                            {{--                                {{ $cheat->type }}--}}
                            {{--                            </div>--}}
                        </div>
                    </div>

                    <div class="card__current-bid">
                        <div class="card__bid-info">
                            <p class="card__bid-label">Статистика</p>
                            <p class="card__bid-number">
                                <span class="inline-flex items-center gap-1">
                                    <i class="fa-solid fa-heart text-red-500"></i> {{ $cheat->love }}
                                </span>
                                <span class="inline-flex items-center gap-1 ml-3">
                                    <i class="fa-solid fa-download text-gray-500"></i> {{ number_format($cheat->downloads ?? 0) }}
                                </span>
                            </p>
                        </div>
                        <a href="{{ route('cheat.show', $cheat->slug) }}"
                           class="card__bid-history bg-violet-800 hover:bg-violet-900 text-white rounded-lg transition-colors"
                           style="padding: 5px 10px; text-decoration: none; display: inline-flex; align-items: center; gap: 5px;">
                            <i class="fa-solid fa-eye"></i> Подробнее
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-8">
                    <p class="text-gray-500 text-lg">Читы не найдены</p>
                    <p class="text-gray-400 text-sm mt-2">Попробуйте изменить фильтры поиска</p>
                </div>
            @endforelse
        </div>

        <button id="picks-load" class="btn picks__load-btn">
            Load More
        </button>
    </div>
</section>