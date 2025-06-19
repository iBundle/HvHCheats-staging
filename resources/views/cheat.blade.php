@extends('layouts.app')

@section('title', $cheat->meta_title)
@section('meta_description', $cheat->meta_description)
@section('meta_keywords', $cheat->meta_keywords)

@section('content')
    <section class="container cheat__wrapper" style="margin-top: 100px!important;">
        <!-- Breadcrumb -->
        <nav class="cheat__breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb__item">
                    <a href="{{ route('home') }}" class="breadcrumb__link">
                        <i class="fa-solid fa-house"></i>
                        Главная
                    </a>
                </li>
                <li class="breadcrumb__item">
                    <a href="{{ route('home') }}#picks" class="breadcrumb__link">Читы</a>
                </li>
                <li class="breadcrumb__item">
                    <a href="#" class="breadcrumb__link">{{ $cheat->game->name }}</a>
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" aria-current="page">
                    {{ $cheat->name }}
                </li>
            </ol>
        </nav>

        <!-- Main Cheat Info -->
        <div class="cheat__details">
            <div class="details--left">
                <div class="cheat__image-container">
                    <img src="{{ $cheat->image }}"
                         alt="{{ $cheat->name }}"
                         class="details__img">
                </div>
            </div>

            <div class="details--right">
                <!-- Title and Basic Info -->
                <div class="cheat__title-section">
                    <h1 class="cheat__title text-5xl">{{ $cheat->name }}</h1>
                    <div class="cheat__game-badge">
                        <img src="{{ $cheat->game->image }}"
                             alt="{{ $cheat->game->name }}"
                             class="game__icon">
                        <span class="game__name">{{ $cheat->game->name }}</span>
                    </div>
                </div>

                <!-- Stats -->
                <div class="cheat__stats">
                    <div class="stat__item">
                        <div class="stat__icon stat__icon--love">
                            <i class="fa-solid fa-heart"></i>
                        </div>
                        <div class="stat__info">
                            <span class="stat__label">Лайки</span>
                            <span class="stat__value">{{ number_format($cheat->love) }}</span>
                        </div>
                    </div>

                    <div class="stat__item">
                        <div class="stat__icon stat__icon--downloads">
                            <i class="fa-solid fa-download"></i>
                        </div>
                        <div class="stat__info">
                            <span class="stat__label">Скачивания</span>
                            <span class="stat__value">{{ number_format($cheat->downloads ?? 0) }}</span>
                        </div>
                    </div>

                    <div class="stat__item">
                        <div class="stat__icon stat__icon--date">
                            <i class="fa-solid fa-calendar"></i>
                        </div>
                        <div class="stat__info">
                            <span class="stat__label">Дата добавления</span>
                            <span class="stat__value">{{ $cheat->created_at->format('d.m.Y') }}</span>
                        </div>
                    </div>
                </div>


                <!-- Action Buttons -->
                <div class="cheat__actions">
                    <button class="btn btn--primary cheat__download-btn">
                        <i class="fa-solid fa-download"></i>
                        Скачать чит
                    </button>

                    <button class="btn btn--secondary cheat__like-btn" data-cheat-id="{{ $cheat->id }}">
                        <i class="fa-solid fa-heart"></i>
                        <span class="like-count">{{ $cheat->love }}</span>
                    </button>
                </div>

                <!-- Warning Notice -->
                <div class="cheat__warning">
                    <div class="warning__icon">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>
                    <div class="warning__content">
                        <strong>Внимание!</strong> Использование читов может привести к блокировке аккаунта.
                        Администрация не несет ответственности за последствия использования.
                    </div>
                </div>
            </div>
        </div>

        <!-- Description Section -->
        <div class="cheat__description-section">
            <h2 class="section__title">Описание</h2>
            <div class="cheat__description">
                {!! nl2br(e($cheat->description)) !!}
            </div>
        </div>

        <!-- Additional Info Tabs -->
        <div class="cheat__tabs">
            <nav class="tabs__nav">
                <button class="tab__btn tab__btn--active" data-tab="features">
                    <i class="fa-solid fa-star"></i>
                    Особенности
                </button>
                <button class="tab__btn" data-tab="installation">
                    <i class="fa-solid fa-cog"></i>
                    Установка
                </button>
                <button class="tab__btn" data-tab="support">
                    <i class="fa-solid fa-headset"></i>
                    Поддержка
                </button>
            </nav>

            <div class="tabs__content">
                <div class="tab__panel tab__panel--active" id="features">
                    <div class="features__grid">
                        <div class="feature__item">
                            <div class="feature__icon">
                                <i class="fa-solid fa-shield-halved"></i>
                            </div>
                            <h4 class="feature__title">Безопасность</h4>
                            <p class="feature__description">Проверено антивирусами</p>
                        </div>

                        <div class="feature__item">
                            <div class="feature__icon">
                                <i class="fa-solid fa-sync"></i>
                            </div>
                            <h4 class="feature__title">Обновления</h4>
                            <p class="feature__description">Регулярные обновления</p>
                        </div>

                        <div class="feature__item">
                            <div class="feature__icon">
                                <i class="fa-solid fa-users"></i>
                            </div>
                            <h4 class="feature__title">Сообщество</h4>
                            <p class="feature__description">Активное сообщество</p>
                        </div>
                    </div>
                </div>

                <div class="tab__panel" id="installation">
                    <div class="installation__steps">
                        <div class="step">
                            <div class="step__number">1</div>
                            <div class="step__content">
                                <h4>Скачивание</h4>
                                <p>Нажмите кнопку "Скачать чит" выше</p>
                            </div>
                        </div>

                        <div class="step">
                            <div class="step__number">2</div>
                            <div class="step__content">
                                <h4>Извлечение</h4>
                                <p>Распакуйте архив в удобную папку</p>
                            </div>
                        </div>

                        <div class="step">
                            <div class="step__number">3</div>
                            <div class="step__content">
                                <h4>Запуск</h4>
                                <p>Запустите исполняемый файл от имени администратора</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab__panel" id="support">
                    <div class="support__content">
                        <div class="support__item">
                            <h4>Нужна помощь?</h4>
                            <p>Если у вас возникли проблемы с установкой или использованием чита, обратитесь к нашему сообществу или в поддержку.</p>
                        </div>

                        <div class="support__links">
                            <a href="#" class="support__link">
                                <i class="fa-brands fa-telegram"></i>
                                Telegram чат
                            </a>
                            <a href="#" class="support__link">
                                <i class="fa-brands fa-discord"></i>
                                Discord сервер
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Cheats -->
    <section class="container related-cheats">
        <div class="section__header">
            <h2 class="section__title">Похожие читы</h2>
            <a href="{{ route('home') }}#picks" class="section__explore-btn">Все читы</a>
        </div>

        <div class="picks__cards picks__cards--small">
            @foreach($relatedCheats as $relatedCheat)
                <article class="article picks__card">
                    <div class="card__img-container">
                        <img src="{{ $relatedCheat->image }}"
                             alt="{{ $relatedCheat->name }}"
                             class="card__img"
                             loading="lazy">
                    </div>

                    <div class="card__info">
                        <h3 class="card__title">
                            <a href="{{ route('cheat.show', $relatedCheat->slug) }}">{{ $relatedCheat->name }}</a>
                        </h3>
                        <div class="card__creator">
                            <a href="#">
                                <img src="{{ $relatedCheat->game->image }}"
                                     alt="{{ $relatedCheat->game->name }}"
                                     class="creator__img">
                            </a>
                            <div class="creator__info">
                                <p class="creator__label">Игра</p>
                                <a href="#" class="creator__name">{{ $relatedCheat->game->name }}</a>
                            </div>
                        </div>
                    </div>

                    <div class="card__current-bid">
                        <div class="card__bid-info">
                            <p class="card__bid-label">Статистика</p>
                            <p class="card__bid-number">
                                <span class="inline-flex items-center gap-1">
                                    <i class="fa-solid fa-heart text-red-500"></i> {{ $relatedCheat->love }}
                                </span>
                            </p>
                        </div>
                        <div class="card__bid-history bg-violet-800 hover:bg-violet-900 text-white rounded-lg transition-colors cursor-pointer"
                             style="padding: 5px 10px">
                            <i class="fa-solid fa-download"></i> Скачать
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    @push('head')
        <style>
            /* Cheat Page Specific Styles */
            .cheat__wrapper {
                padding-top: 2rem;
                padding-bottom: 4rem;
            }

            .cheat__breadcrumb {
                margin-bottom: 2rem;
            }

            .breadcrumb {
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 0.5rem;
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .breadcrumb__item:not(:last-child)::after {
                content: '>';
                margin-left: 0.5rem;
                color: rgba(var(--primary-rgb), 0.6);
            }

            .breadcrumb__link {
                color: rgba(var(--text-rgb), 0.7);
                text-decoration: none;
                transition: color 0.3s ease;
            }

            .breadcrumb__link:hover {
                color: var(--primary-color);
            }

            .breadcrumb__item--active {
                color: var(--text-color);
                font-weight: 500;
            }

            .cheat__details {
                display: grid;
                grid-template-columns: 1fr;
                gap: 2rem;
                margin-bottom: 3rem;
            }

            @media (min-width: 768px) {
                .cheat__details {
                    grid-template-columns: 1fr 1fr;
                    gap: 3rem;
                }
            }

            .cheat__image-container {
                position: relative;
                border-radius: 1rem;
                overflow: hidden;
                background: rgba(var(--primary-rgb), 0.1);
            }

            .details__img {
                width: 100%;
                height: auto;
                aspect-ratio: 16/10;
                object-fit: cover;
            }

            .image__actions {
                position: absolute;
                top: 1rem;
                right: 1rem;
                display: flex;
                gap: 0.5rem;
            }

            .action__btn {
                width: 2.5rem;
                height: 2.5rem;
                border-radius: 50%;
                background: rgba(0, 0, 0, 0.7);
                color: white;
                border: none;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: background-color 0.3s ease;
            }

            .action__btn:hover {
                background: rgba(0, 0, 0, 0.9);
            }

            .cheat__title-section {
                margin-bottom: 1.5rem;
            }

            .cheat__title {
                font-size: 3rem;
                font-weight: 700;
                margin-bottom: 0.5rem;
                color: var(--text-color);
            }

            .cheat__game-badge {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.5rem 1rem;
                background: rgba(var(--primary-rgb), 0.1);
                border-radius: 2rem;
                width: fit-content;
            }

            .game__icon {
                width: 5rem;
                height: 5rem;
                border-radius: 50%;
            }

            .game__name {
                font-weight: 500;
                color: var(--primary-color);
            }

            .cheat__stats {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                gap: 1rem;
                margin-bottom: 2rem;
            }

            .stat__item {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 1rem;
                background: rgba(var(--card-bg-rgb), 0.5);
                border-radius: 0.75rem;
            }

            .stat__icon {
                width: 2.5rem;
                height: 2.5rem;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.875rem;
            }

            .stat__icon--love {
                background: rgba(239, 68, 68, 0.1);
                color: #ef4444;
            }

            .stat__icon--downloads {
                background: rgba(34, 197, 94, 0.1);
                color: #22c55e;
            }

            .stat__icon--date {
                background: rgba(59, 130, 246, 0.1);
                color: #3b82f6;
            }

            .stat__info {
                display: flex;
                flex-direction: column;
            }

            .stat__label {
                font-size: 1.25rem;
                color: rgba(var(--text-rgb), 0.6);
                margin-bottom: 0.125rem;
            }

            .stat__value {
                font-size: 2rem;
                font-weight: 600;
                color: var(--text-color);
            }

            .cheat__creator {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                padding: 1rem;
                background: rgba(var(--card-bg-rgb), 0.3);
                border-radius: 0.75rem;
                margin-bottom: 2rem;
            }

            .creator__avatar {
                width: 2.5rem;
                height: 2.5rem;
                border-radius: 50%;
                object-fit: cover;
            }

            .creator__label {
                font-size: 0.75rem;
                color: rgba(var(--text-rgb), 0.6);
                margin-bottom: 0.125rem;
            }

            .creator__name {
                font-weight: 600;
                color: var(--primary-color);
                text-decoration: none;
            }

            .cheat__actions {
                display: flex;
                gap: 1rem;
                margin-bottom: 2rem;
            }

            .btn--primary {
                background: var(--primary-color);
                color: white;
                flex: 1;
                justify-content: center;
            }

            .btn--primary:hover {
                background: var(--primary-color-dark);
            }

            .btn--secondary {
                background: rgba(var(--text-rgb), 0.1);
                color: var(--text-color);
                border: 1px solid rgba(var(--text-rgb), 0.2);
            }

            .btn--secondary:hover {
                background: rgba(var(--text-rgb), 0.2);
            }

            .cheat__warning {
                display: flex;
                gap: 0.75rem;
                padding: 1rem;
                background: rgba(245, 158, 11, 0.1);
                border: 1px solid rgba(245, 158, 11, 0.2);
                border-radius: 0.75rem;
                font-size: 1.25rem;
            }

            .warning__icon {
                color: #f59e0b;
                font-size: 1rem;
                margin-top: 0.125rem;
            }

            .warning__content {
                color: rgba(var(--text-rgb), 0.8);
                line-height: 1.5;
            }

            .cheat__description-section {
                margin-bottom: 3rem;
            }

            .cheat__description {
                background: rgba(var(--card-bg-rgb), 0.3);
                padding: 2rem;
                border-radius: 1rem;
                line-height: 1.7;
                color: rgba(var(--text-rgb), 0.8);
                margin-top: 1rem;
            }

            .cheat__tabs {
                margin-bottom: 3rem;
            }

            .tabs__nav {
                display: flex;
                gap: 0.5rem;
                margin-bottom: 1.5rem;
                border-bottom: 1px solid rgba(var(--text-rgb), 0.1);
            }

            .tab__btn {
                padding: 0.75rem 1.5rem;
                background: none;
                border: none;
                color: rgba(var(--text-rgb), 0.6);
                cursor: pointer;
                border-radius: 0.5rem 0.5rem 0 0;
                transition: all 0.3s ease;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-weight: 500;
            }

            .tab__btn--active {
                color: var(--primary-color);
                background: rgba(var(--primary-rgb), 0.1);
            }

            .tab__panel {
                display: none;
                padding: 1.5rem;
                background: rgba(var(--card-bg-rgb), 0.3);
                border-radius: 0.75rem;
            }

            .tab__panel--active {
                display: block;
            }

            .features__grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
                gap: 1.5rem;
            }

            .feature__item {
                text-align: center;
                padding: 1.5rem;
                background: rgba(var(--card-bg-rgb), 0.5);
                border-radius: 0.75rem;
            }

            .feature__icon {
                width: 3rem;
                height: 3rem;
                margin: 0 auto 1rem;
                border-radius: 50%;
                background: rgba(var(--primary-rgb), 0.1);
                color: var(--primary-color);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 1.25rem;
            }

            .feature__title {
                font-size: 2.0rem;
                font-weight: 600;
                margin-bottom: 0.5rem;
                color: var(--text-color);
            }

            .feature__description {
                color: rgba(var(--text-rgb), 0.6);
                font-size: 1.5rem;
            }

            .installation__steps {
                display: flex;
                flex-direction: column;
                gap: 1.5rem;
            }

            .step {
                display: flex;
                gap: 1rem;
                align-items: flex-start;
            }

            .step__number {
                width: 2rem;
                height: 2rem;
                border-radius: 50%;
                background: var(--primary-color);
                color: white;
                display: flex;
                align-items: center;
                justify-content: center;
                font-weight: 600;
                font-size: 1.55rem;
                flex-shrink: 0;
            }

            .step__content h4 {
                font-weight: 600;
                margin-bottom: 0.25rem;
                color: var(--text-color);
            }

            .step__content p {
                color: rgba(var(--text-rgb), 0.6);
                font-size: 1.25rem;
            }

            .support__content {
                text-align: center;
            }

            .support__item {
                margin-bottom: 2rem;
            }

            .support__item h4 {
                font-weight: 600;
                margin-bottom: 0.5rem;
                color: var(--text-color);
            }

            .support__item p {
                color: rgba(var(--text-rgb), 0.6);
                line-height: 1.6;
            }

            .support__links {
                display: flex;
                gap: 1rem;
                justify-content: center;
            }

            .support__link {
                padding: 0.75rem 1.5rem;
                background: rgba(var(--primary-rgb), 0.1);
                color: var(--primary-color);
                text-decoration: none;
                border-radius: 0.5rem;
                display: flex;
                align-items: center;
                gap: 0.5rem;
                font-weight: 500;
                transition: background-color 0.3s ease;
            }

            .support__link:hover {
                background: rgba(var(--primary-rgb), 0.2);
            }

            .related-cheats {
                padding-top: 2rem;
                border-top: 1px solid rgba(var(--text-rgb), 0.1);
            }

            .picks__cards--small .picks__card {
                max-width: 280px;
            }

            /* Theme CSS Variables */
            :root {
                --primary-color: #6366f1;
                --primary-rgb: 99, 102, 241;
                --primary-color-dark: #4f46e5;
                --text-color: #1f2937;
                --text-rgb: 31, 41, 55;
                --card-bg-rgb: 255, 255, 255;
            }

            .theme--dark {
                --text-color: #f9fafb;
                --text-rgb: 249, 250, 251;
                --card-bg-rgb: 31, 41, 55;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            // Tab functionality
            document.addEventListener('DOMContentLoaded', function() {
                const tabBtns = document.querySelectorAll('.tab__btn');
                const tabPanels = document.querySelectorAll('.tab__panel');

                tabBtns.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const targetTab = btn.dataset.tab;

                        // Remove active classes
                        tabBtns.forEach(b => b.classList.remove('tab__btn--active'));
                        tabPanels.forEach(p => p.classList.remove('tab__panel--active'));

                        // Add active classes
                        btn.classList.add('tab__btn--active');
                        document.getElementById(targetTab).classList.add('tab__panel--active');
                    });
                });

                // Like functionality
                const likeBtn = document.querySelector('.cheat__like-btn');
                if (likeBtn) {
                    likeBtn.addEventListener('click', function() {
                        const cheatId = this.dataset.cheatId;
                        const likeCount = this.querySelector('.like-count');

                        // Here you would typically make an AJAX request to like/unlike
                        // For now, just toggle the visual state
                        this.classList.toggle('liked');

                        if (this.classList.contains('liked')) {
                            likeCount.textContent = parseInt(likeCount.textContent) + 1;
                            this.querySelector('i').style.color = '#ef4444';
                        } else {
                            likeCount.textContent = parseInt(likeCount.textContent) - 1;
                            this.querySelector('i').style.color = '';
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection