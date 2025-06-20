@extends('layouts.app')

@section('title', 'Партнёрская программа - HvHCheats')
@section('meta_description', 'Присоединяйтесь к партнёрской программе HvHCheats. Высокие комиссии, эксклюзивные предложения для стримеров, блогеров и игровых сообществ. Начните зарабатывать уже сегодня!')
@section('meta_keywords', 'партнёрская программа, реферальная программа, заработок, комиссии, стримеры, блогеры, hvhcheats')

@push('head')
    @vite('resources/sass/pages/partners.scss')
@endpush

@section('content')
    <!-- Flash Messages -->
    <x-flash-messages />

    <section class="container partners__wrapper">
        <!-- Breadcrumb -->
        <nav class="partners__breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb__item">
                    <a href="{{ route('home') }}" class="breadcrumb__link">
                        <i class="fa-solid fa-house"></i>
                        Главная
                    </a>
                </li>
                <li class="breadcrumb__item breadcrumb__item--active" aria-current="page">
                    Партнёрам
                </li>
            </ol>
        </nav>

        <!-- Hero Section -->
        <div class="partners__hero">
            <h1 class="partners__title">Партнёрская программа</h1>
            <p class="partners__subtitle">
                Присоединяйтесь к нашей партнёрской программе и зарабатывайте на продвижении
                лучших игровых читов. Высокие комиссии, прозрачная статистика,
                еженедельные выплаты и персональная поддержка.
            </p>
        </div>

        <!-- Benefits Section -->
        <div class="benefits__section">
            <h2 class="benefits__title">Преимущества партнёрства</h2>
            <div class="benefits__grid">
                <div class="benefit__card">
                    <div class="benefit__icon">
                        <i class="fa-solid fa-percentage"></i>
                    </div>
                    <h3 class="benefit__title">До 50% комиссии</h3>
                    <p class="benefit__description">
                        Получайте высокие комиссионные с каждой продажи.
                        Процент зависит от вашего статуса и объёма продаж.
                    </p>
                </div>

                <div class="benefit__card">
                    <div class="benefit__icon">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <h3 class="benefit__title">Детальная аналитика</h3>
                    <p class="benefit__description">
                        Отслеживайте переходы, конверсии и доходы в режиме реального времени
                        через личный кабинет партнёра.
                    </p>
                </div>

                <div class="benefit__card">
                    <div class="benefit__icon">
                        <i class="fa-solid fa-calendar-week"></i>
                    </div>
                    <h3 class="benefit__title">Еженедельные выплаты</h3>
                    <p class="benefit__description">
                        Получайте свои заработанные средства каждую неделю
                        на удобный для вас способ оплаты.
                    </p>
                </div>

                <div class="benefit__card">
                    <div class="benefit__icon">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <h3 class="benefit__title">Персональная поддержка</h3>
                    <p class="benefit__description">
                        Каждый партнёр получает персонального менеджера
                        для максимизации доходов и решения вопросов.
                    </p>
                </div>

                <div class="benefit__card">
                    <div class="benefit__icon">
                        <i class="fa-solid fa-gift"></i>
                    </div>
                    <h3 class="benefit__title">Бонусы и подарки</h3>
                    <p class="benefit__description">
                        Эксклюзивные промокоды для ваших подписчиков,
                        конкурсы и специальные предложения.
                    </p>
                </div>

                <div class="benefit__card">
                    <div class="benefit__icon">
                        <i class="fa-solid fa-tools"></i>
                    </div>
                    <h3 class="benefit__title">Маркетинговые материалы</h3>
                    <p class="benefit__description">
                        Готовые баннеры, видео-материалы,
                        обзоры и контент для продвижения читов.
                    </p>
                </div>
            </div>
        </div>

        <!-- Partnership Types -->
        <div class="partnership__types">
            <h2 class="types__title">Типы партнёрства</h2>
            <div class="types__grid">
                <div class="type__card">
                    <div class="type__header">
                        <div class="type__icon">
                            <i class="fa-solid fa-video"></i>
                        </div>
                        <h3 class="type__title">Контент-криейторы</h3>
                    </div>
                    <p class="type__description">
                        Для стримеров, YouTubers и TikTokers. Создавайте обзоры,
                        стримьте с читами и получайте доход с каждого зрителя.
                    </p>
                    <ul class="type__features">
                        <li>Эксклюзивные промокоды</li>
                        <li>Ранний доступ к новым читам</li>
                        <li>Персональная реферальная ссылка</li>
                        <li>Готовые сценарии для обзоров</li>
                        <li>Поддержка в создании контента</li>
                    </ul>
                </div>

                <div class="type__card">
                    <div class="type__header">
                        <div class="type__icon">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <h3 class="type__title">Сообщества</h3>
                    </div>
                    <p class="type__description">
                        Для администраторов Discord-серверов, Telegram-каналов
                        и игровых сообществ.
                    </p>
                    <ul class="type__features">
                        <li>Групповые скидки для участников</li>
                        <li>Специальные условия для админов</li>
                        <li>Интеграция с ботами</li>
                        <li>Конкурсы и розыгрыши</li>
                        <li>VIP-поддержка сообщества</li>
                    </ul>
                </div>

                <div class="type__card">
                    <div class="type__header">
                        <div class="type__icon">
                            <i class="fa-solid fa-store"></i>
                        </div>
                        <h3 class="type__title">Реселлеры</h3>
                    </div>
                    <p class="type__description">
                        Для тех, кто хочет продавать читы через свои каналы
                        с максимальными комиссиями.
                    </p>
                    <ul class="type__features">
                        <li>Оптовые цены</li>
                        <li>Белый лейбл решения</li>
                        <li>API для интеграции</li>
                        <li>Приоритетная поддержка</li>
                        <li>Индивидуальные условия</li>
                    </ul>
                </div>

                <div class="type__card">
                    <div class="type__header">
                        <div class="type__icon">
                            <i class="fa-solid fa-link"></i>
                        </div>
                        <h3 class="type__title">Обычное партнёрство</h3>
                    </div>
                    <p class="type__description">
                        Стандартная реферальная программа для всех желающих.
                        Просто делитесь ссылкой и зарабатывайте.
                    </p>
                    <ul class="type__features">
                        <li>Комиссия с первой продажи</li>
                        <li>Простая регистрация</li>
                        <li>Готовые материалы</li>
                        <li>Техническая поддержка</li>
                        <li>Прозрачная статистика</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="stats__section">
            <div class="stats__grid">
                <div class="stat__item">
                    <span class="stat__number">1,500+</span>
                    <span class="stat__label">Активных партнёров</span>
                </div>
                <div class="stat__item">
                    <span class="stat__number">₽2.5М</span>
                    <span class="stat__label">Выплачено за месяц</span>
                </div>
                <div class="stat__item">
                    <span class="stat__number">50%</span>
                    <span class="stat__label">Максимальная комиссия</span>
                </div>
                <div class="stat__item">
                    <span class="stat__number">24/7</span>
                    <span class="stat__label">Поддержка партнёров</span>
                </div>
            </div>
        </div>

        <!-- Application Form -->
        <div class="application__section">
            <h2 class="application__title">Подать заявку на партнёрство</h2>
            <form class="application__form" action="{{ route('partners.apply') ?? '#' }}" method="POST">
                @csrf

                <div class="form__row">
                    <div class="form__group">
                        <label for="first_name">Имя *</label>
                        <input type="text" id="first_name" name="first_name" required
                               placeholder="Ваше имя" value="{{ old('first_name') }}">
                        @error('first_name')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="last_name">Фамилия *</label>
                        <input type="text" id="last_name" name="last_name" required
                               placeholder="Ваша фамилия" value="{{ old('last_name') }}">
                        @error('last_name')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required
                               placeholder="your@email.com" value="{{ old('email') }}">
                        @error('email')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="telegram">Telegram *</label>
                        <input type="text" id="telegram" name="telegram" required
                               placeholder="@username" value="{{ old('telegram') }}">
                        @error('telegram')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form__group">
                    <label for="partnership_type">Тип партнёрства *</label>
                    <select id="partnership_type" name="partnership_type" required>
                        <option value="">Выберите тип партнёрства</option>
                        <option value="content_creator" {{ old('partnership_type') == 'content_creator' ? 'selected' : '' }}>
                            Контент-криейтор
                        </option>
                        <option value="community" {{ old('partnership_type') == 'community' ? 'selected' : '' }}>
                            Сообщество
                        </option>
                        <option value="reseller" {{ old('partnership_type') == 'reseller' ? 'selected' : '' }}>
                            Реселлер
                        </option>
                        <option value="regular" {{ old('partnership_type') == 'regular' ? 'selected' : '' }}>
                            Обычное партнёрство
                        </option>
                    </select>
                    @error('partnership_type')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form__group">
                    <label for="platform">Основная платформа *</label>
                    <select id="platform" name="platform" required>
                        <option value="">Выберите платформу</option>
                        <option value="youtube" {{ old('platform') == 'youtube' ? 'selected' : '' }}>YouTube</option>
                        <option value="twitch" {{ old('platform') == 'twitch' ? 'selected' : '' }}>Twitch</option>
                        <option value="telegram" {{ old('platform') == 'telegram' ? 'selected' : '' }}>Telegram</option>
                        <option value="discord" {{ old('platform') == 'discord' ? 'selected' : '' }}>Discord</option>
                        <option value="tiktok" {{ old('platform') == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                        <option value="vk" {{ old('platform') == 'vk' ? 'selected' : '' }}>ВКонтакте</option>
                        <option value="website" {{ old('platform') == 'website' ? 'selected' : '' }}>Собственный сайт</option>
                        <option value="other" {{ old('platform') == 'other' ? 'selected' : '' }}>Другое</option>
                    </select>
                    @error('platform')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form__row">
                    <div class="form__group">
                        <label for="audience_size">Размер аудитории</label>
                        <input type="text" id="audience_size" name="audience_size"
                               placeholder="Например: 10,000 подписчиков" value="{{ old('audience_size') }}">
                        @error('audience_size')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="experience">Опыт работы</label>
                        <select id="experience" name="experience">
                            <option value="">Выберите опыт</option>
                            <option value="beginner" {{ old('experience') == 'beginner' ? 'selected' : '' }}>
                                Новичок (менее 6 месяцев)
                            </option>
                            <option value="intermediate" {{ old('experience') == 'intermediate' ? 'selected' : '' }}>
                                Средний (6 месяцев - 2 года)
                            </option>
                            <option value="experienced" {{ old('experience') == 'experienced' ? 'selected' : '' }}>
                                Опытный (2-5 лет)
                            </option>
                            <option value="expert" {{ old('experience') == 'expert' ? 'selected' : '' }}>
                                Эксперт (более 5 лет)
                            </option>
                        </select>
                        @error('experience')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="form__group">
                    <label for="portfolio_links">Ссылки на ваши каналы/работы</label>
                    <textarea id="portfolio_links" name="portfolio_links"
                              placeholder="Укажите ссылки на ваши каналы, примеры работ или описание опыта...">{{ old('portfolio_links') }}</textarea>
                    @error('portfolio_links')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form__group">
                    <label for="motivation">Почему хотите стать партнёром? *</label>
                    <textarea id="motivation" name="motivation" required
                              placeholder="Расскажите о ваших целях, планах продвижения и ожиданиях от партнёрства...">{{ old('motivation') }}</textarea>
                    @error('motivation')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="form__submit">
                    <i class="fa-solid fa-rocket"></i>
                    Подать заявку на партнёрство
                </button>
            </form>
        </div>

        <!-- Additional Info -->
        <div class="additional__info" style="margin-top: 3rem; text-align: center;">
            <p style="color: rgba(255, 255, 255, 0.7); font-size: 1rem; line-height: 1.6;">
                После подачи заявки наш менеджер свяжется с вами в течение 24 часов для обсуждения условий партнёрства.<br>
                По вопросам партнёрской программы обращайтесь:
                <a href="mailto:partners@hvhcheats.com" style="color: #8b5cf6; text-decoration: none;">partners@hvhcheats.com</a>
            </p>
        </div>
    </section>
@endsection