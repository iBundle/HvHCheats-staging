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

    <!-- Collections Section -->
    <section id="collections">
        <div class="container collections__wrapper">
            <div class="section__header">
                <h2 class="section__title">Популярные коллекции</h2>
                <a href="#" class="section__explore-btn">Explore More</a>
            </div>

            <div id="collections-page" class="collections__page"></div>
        </div>
    </section>

    <!-- Sellers Section -->
    <section id="sellers">
        <div class="container sellers__wrapper">
            <div class="section__header">
                <h2 class="section__title">Лучшие читеры</h2>
            </div>
            <div id="seller-cards" class="seller__cards"></div>
        </div>
    </section>

    <!-- Picks Section (Cheats List) -->
    @livewire('cheats-list')
@endsection