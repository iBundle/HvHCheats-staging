@extends('layouts.app')

@section('title', 'HvHCheats - лучшие в своем деле')
@section('meta_description', 'Лучшие читы СНГ и всего мира с регулярными обновлениями. CS2, Valorant, Warface, Roblox и другие популярные игры.')
@section('meta_keywords', 'читы, cheats, cs2, valorant, warface, roblox, cs go, aimbot, wallhack')

@section('content')
    <!-- Social Menu -->
    <section id="socials" class="socials__menu socials__menu--close">
        <button class="socials__placeholder">
            <i class="fa-solid fa-hashtag"></i>
        </button>

        <ul class="socials__links">
            <li>
                <a href="#" class="socials__link">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
            </li>
            <li class="socials__item>">
                <a href="#" class="socials__link">
                    <i class="fa-brands fa-twitter"></i>
                </a>
            </li>
            <li class="socials__item>">
                <a href="#" class="socials__link">
                    <i class="fa-brands fa-github"></i>
                </a>
            </li>
            <li class="socials__item>">
                <a href="#" class="socials__link">
                    <i class="fa-brands fa-telegram"></i>
                </a>
            </li>
            <li class="socials__item>">
                <a href="#" class="socials__link">
                    <i class="fa-brands fa-instagram"></i>
                </a>
            </li>
            <li class="socials__item>">
                <a href="#" class="socials__link">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
            </li>
        </ul>
    </section>

    <!-- Hero Section -->
    @include('partials.hero', [
        'heroDescription' => 'Лучшие читы СНГ и всего мира с регулярными обновлениями',
        'heroButtonText' => 'Перейти к читам',
        'heroButtonUrl' => route('cheats.index'),
        'heroImage' => asset('img/imgslider-3.png'),
        'heroImageAlt' => 'HvHCheats Gaming Platform'
    ])

    <!-- Features Section -->
    <section id="features">
        <div class="container features__wrapper">
            <div class="features__item">
                <div class="features__icon features__icon--wallet">
                    <i class="fa-solid fa-gamepad"></i>
                </div>
                <h3 class="features__title">Выберите Игру</h3>
                <p class="features__description">
                    Выберите нужную игру из нашего каталога: CS2, Valorant,
                    Warface, Roblox и другие популярные проекты с актуальными читами.
                </p>
            </div>

            <div class="features__item">
                <div class="features__icon features__icon--collection">
                    <i class="fa-solid fa-shield-virus"></i>
                </div>
                <h3 class="features__title">Проверенная Безопасность</h3>
                <p class="features__description">
                    Все файлы проходят автоматическую проверку через VirusTotal
                    и дополнительную ручную верификацию нашими экспертами.
                </p>
            </div>

            <div class="features__item">
                <div class="features__icon features__icon--nft">
                    <i class="fa-solid fa-download"></i>
                </div>
                <h3 class="features__title">Быстрая Загрузка</h3>
                <p class="features__description">
                    Получите доступ к актуальным версиям читов с подробными
                    инструкциями по установке и настройке для вашей игры.
                </p>
            </div>

            <div class="features__item">
                <div class="features__icon features__icon--list">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                </div>
                <h3 class="features__title">Актуальные Обновления</h3>
                <p class="features__description">
                    Подписывайтесь на уведомления о новых версиях и статусах
                    работоспособности читов после обновлений игр.
                </p>
            </div>
        </div>
    </section>

    <section id="collections">
        <div class="container collections__wrapper">
            <div class="section__header">
                <h2 class="section__title">Популярные коллекции</h2>
            </div>

            <div id="collections-page" class="collections__page"><article id="collection_1" class="article collection__card ">
                    <div class="collection__img-container">
                        <img src="/Assets/Images/06_Popular_Collection/box1/collection-item-2.jpg" alt="popular collection" class="collection__img collection__img--first" loading="lazy">
                        <img src="/Assets/Images/06_Popular_Collection/box1/collection-item-bottom-4.jpg" alt="popular collection" class="collection__img collection__img--second" loading="lazy">
                        <img src="/Assets/Images/06_Popular_Collection/box1/collection-item-top-1.jpg" alt="popular collection" class="collection__img collection__img--third" loading="lazy">
                        <img src="/Assets/Images/06_Popular_Collection/box1/collection-item-top-2.jpg" alt="popular collection" class="collection__img collection__img--forth" loading="lazy">
                        <img src="/Assets/Images/06_Popular_Collection/box2/img-collection24.jpg" alt="popular collection" class="collection__img collection__img--fifth" loading="lazy">
                    </div>
                    <div class="collection__creator-info">
                        <a href="#" class="collection__creator-link">
                            <div class="collection__creator-img">
                                <img src="/Assets/Images/04_Top_Seller/avt-1.jpg" alt="collection creator">
                                <i class="fa-solid fa-check"></i>
                            </div>
                        </a>
                        <div class="collection__info">
                            <h3 class="collection__name"><a href="#" class="collection__link">Creative Art Collection</a></h3>
                            <p class="collection__creator">
                                Created by <a href="#" class="collection__creator-link">Ralph Garraway</a>
                            </p>
                        </div>
                        <div class="article__likes collection__likes">
                            <div class="like__btn"></div>
                            <p class="article__likes-count collection__likes-count">748</p>
                        </div>
                    </div></article><article id="collection_2" class="article collection__card ">
                    <div class="collection__img-container">
                        <img src="/Assets/Images/06_Popular_Collection/box2/img-collection10.jpg" alt="popular collection" class="collection__img collection__img--first" loading="lazy">
                        <img src="/Assets/Images/06_Popular_Collection/box2/img-collection11.jpg" alt="popular collection" class="collection__img collection__img--second" loading="lazy">
                        <img src="/Assets/Images/06_Popular_Collection/box2/img-collection23.jpg" alt="popular collection" class="collection__img collection__img--third" loading="lazy">
                        <img src="/Assets/Images/06_Popular_Collection/box3/img-collection12.jpg" alt="popular collection" class="collection__img collection__img--forth" loading="lazy">
                        <img src="/Assets/Images/06_Popular_Collection/box2/img-collection24.jpg" alt="popular collection" class="collection__img collection__img--fifth" loading="lazy">
                    </div>
                    <div class="collection__creator-info">
                        <a href="#" class="collection__creator-link">
                            <div class="collection__creator-img">
                                <img src="/Assets/Images/04_Top_Seller/avt-7.jpg" alt="collection creator">
                                <i class="fa-solid fa-check"></i>
                            </div>
                        </a>
                        <div class="collection__info">
                            <h3 class="collection__name"><a href="#" class="collection__link">Colorful Abstract</a></h3>
                            <p class="collection__creator">
                                Created by <a href="#" class="collection__creator-link">Ralph Garraway</a>
                            </p>
                        </div>
                        <div class="article__likes collection__likes">
                            <div class="like__btn"></div>
                            <p class="article__likes-count collection__likes-count">149</p>
                        </div>
                    </div></article><article id="collection_3" class="article collection__card ">
                    <div class="collection__img-container">
                        <img src="/Assets/Images/06_Popular_Collection/box3/img-collection12.jpg" alt="popular collection" class="collection__img collection__img--first" loading="lazy">
                        <img src="/Assets/Images/06_Popular_Collection/box3/img-collection17.jpg" alt="popular collection" class="collection__img collection__img--second" loading="lazy">
                        <img src="/Assets/Images/06_Popular_Collection/box3/img-collection18.jpg" alt="popular collection" class="collection__img collection__img--third" loading="lazy">
                        <img src="/Assets/Images/06_Popular_Collection/box3/img-collection25.jpg" alt="popular collection" class="collection__img collection__img--forth" loading="lazy">
                        <img src="/Assets/Images/06_Popular_Collection/box1/collection-item-top-1.jpg" alt="popular collection" class="collection__img collection__img--fifth" loading="lazy">
                    </div>
                    <div class="collection__creator-info">
                        <a href="#" class="collection__creator-link">
                            <div class="collection__creator-img">
                                <img src="/Assets/Images/04_Top_Seller/avt-8.jpg" alt="collection creator">
                                <i class="fa-solid fa-check"></i>
                            </div>
                        </a>
                        <div class="collection__info">
                            <h3 class="collection__name"><a href="#" class="collection__link">Modern Art Collection</a></h3>
                            <p class="collection__creator">
                                Created by <a href="#" class="collection__creator-link">Ralph Garraway</a>
                            </p>
                        </div>
                        <div class="article__likes collection__likes">
                            <div class="like__btn"></div>
                            <p class="article__likes-count collection__likes-count">312</p>
                        </div>
                    </div></article></div>
        </div>
    </section>

    <!-- Sellers Section -->
{{--    <section id="sellers">--}}
{{--        <div class="container sellers__wrapper">--}}
{{--            <div class="section__header">--}}
{{--                <h2 class="section__title">Лучшие читеры</h2>--}}
{{--            </div>--}}
{{--            <div id="seller-cards" class="seller__cards"></div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <!-- Picks Section (Cheats List) -->
    @livewire('cheats-list')
@endsection