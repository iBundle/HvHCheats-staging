@extends('layouts.app')

@section('title', 'Служба поддержки - HvHCheats')
@section('meta_description', 'Свяжитесь с нашей службой поддержки HvHCheats. Получите помощь по установке читов, оплате, техническим вопросам. Быстрая и качественная поддержка 24/7.')
@section('meta_keywords', 'поддержка, служба поддержки, помощь, техподдержка, hvhcheats, контакты, связаться')

@push('head')
    @vite('resources/sass/pages/contact.scss')
@endpush

@section('content')
    <!-- Flash Messages -->
    <x-flash-messages />

    <section class="container contact__wrapper">


        <!-- Hero Section -->
        <div class="contact__hero">
            <h1 class="contact__title">Служба поддержки</h1>
            <p class="contact__subtitle">
                Мы здесь, чтобы помочь! Свяжитесь с нами по любым вопросам, связанным с читами,
                установкой, оплатой или техническими проблемами. Наша команда отвечает быстро и качественно.
            </p>
        </div>

        <!-- Main Content Grid -->
        <div class="contact__grid">
            <!-- Contact Information -->
            <div class="contact__info">
                <div class="info__item">
                    <div class="info__icon">
                        <i class="fa-brands fa-telegram"></i>
                    </div>
                    <div class="info__content">
                        <h3>Telegram поддержка</h3>
                        <p>Самый быстрый способ получить помощь</p>
                        <a href="https://t.me/hvhcheats_support" target="_blank">@hvhcheats_support</a>
                    </div>
                </div>

                <div class="info__item">
                    <div class="info__icon">
                        <i class="fa-brands fa-discord"></i>
                    </div>
                    <div class="info__content">
                        <h3>Discord сервер</h3>
                        <p>Общайтесь с сообществом и получайте поддержку</p>
                        <a href="https://discord.gg/hvhcheats" target="_blank">discord.gg/hvhcheats</a>
                    </div>
                </div>

                <div class="info__item">
                    <div class="info__icon">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="info__content">
                        <h3>Email поддержка</h3>
                        <p>Для детальных вопросов и официальных обращений</p>
                        <a href="mailto:support@hvhcheats.com">support@hvhcheats.com</a>
                    </div>
                </div>

                <div class="info__item">
                    <div class="info__icon">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                    <div class="info__content">
                        <h3>Время работы</h3>
                        <p>Telegram и Discord: 24/7<br>
                            Email: Пн-Пт 10:00-22:00 МСК</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact__form">
                <h2 class="form__title">Отправить обращение</h2>
                <form action="{{ route('contact.send') ?? '#' }}" method="POST">
                    @csrf

                    <div class="form__group">
                        <label for="name">Ваше имя *</label>
                        <input type="text" id="name" name="name" required
                               placeholder="Введите ваше имя" value="{{ old('name') }}">
                        @error('name')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email" required
                               placeholder="your@email.com" value="{{ old('email') }}">
                        @error('email')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="category">Категория вопроса *</label>
                        <select id="category" name="category" required>
                            <option value="">Выберите категорию</option>
                            <option value="technical" {{ old('category') == 'technical' ? 'selected' : '' }}>
                                Технические проблемы
                            </option>
                            <option value="payment" {{ old('category') == 'payment' ? 'selected' : '' }}>
                                Вопросы оплаты
                            </option>
                            <option value="installation" {{ old('category') == 'installation' ? 'selected' : '' }}>
                                Помощь с установкой
                            </option>
                            <option value="account" {{ old('category') == 'account' ? 'selected' : '' }}>
                                Проблемы с аккаунтом
                            </option>
                            <option value="cheats" {{ old('category') == 'cheats' ? 'selected' : '' }}>
                                Вопросы о читах
                            </option>
                            <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>
                                Другое
                            </option>
                        </select>
                        @error('category')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="subject">Тема сообщения *</label>
                        <input type="text" id="subject" name="subject" required
                               placeholder="Кратко опишите проблему" value="{{ old('subject') }}">
                        @error('subject')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form__group">
                        <label for="message">Сообщение *</label>
                        <textarea id="message" name="message" required
                                  placeholder="Подробно опишите вашу проблему или вопрос...">{{ old('message') }}</textarea>
                        @error('message')
                        <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="form__submit">
                        <i class="fa-solid fa-paper-plane"></i>
                        Отправить обращение
                    </button>
                </form>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="faq__section p-10">
            <h2 class="faq__title">Часто задаваемые вопросы</h2>

            <div class="faq__item">
                <button class="faq__question">
                    Как установить чит?
                    <i class="fa-solid fa-chevron-down faq__icon"></i>
                </button>
                <div class="faq__answer">
                    <p>1. Скачайте чит с нашего сайта<br>
                        2. Отключите антивирус временно<br>
                        3. Запустите инсталлятор от имени администратора<br>
                        4. Следуйте инструкциям в установщике<br>
                        5. Включите антивирус обратно и добавьте чит в исключения</p>
                </div>
            </div>

            <div class="faq__item">
                <button class="faq__question">
                    Чит не запускается, что делать?
                    <i class="fa-solid fa-chevron-down faq__icon"></i>
                </button>
                <div class="faq__answer">
                    <p>Проверьте:<br>
                        • Запущена ли игра<br>
                        • Добавлен ли чит в исключения антивируса<br>
                        • Установлены ли необходимые компоненты (Visual C++, .NET Framework)<br>
                        • Запускаете ли вы чит от имени администратора</p>
                </div>
            </div>

            <div class="faq__item">
                <button class="faq__question">
                    Как оплатить читы?
                    <i class="fa-solid fa-chevron-down faq__icon"></i>
                </button>
                <div class="faq__answer">
                    <p>Мы принимаем оплату:<br>
                        • Банковские карты (Visa, MasterCard)<br>
                        • СБП (Система быстрых платежей)<br>
                        • Электронные кошельки<br>
                        • Криптовалюты (Bitcoin, Ethereum)<br>
                        • Мобильные платежи</p>
                </div>
            </div>

            <div class="faq__item">
                <button class="faq__question">
                    Безопасно ли использовать читы?
                    <i class="fa-solid fa-chevron-down faq__icon"></i>
                </button>
                <div class="faq__answer">
                    <p>Наши читы разрабатываются с учетом современных методов защиты от античитов.
                        Однако помните, что использование читов всегда несет риск блокировки аккаунта.
                        Мы рекомендуем использовать читы осторожно и не злоупотреблять ими.</p>
                </div>
            </div>

            <div class="faq__item">
                <button class="faq__question">
                    Есть ли гарантия на читы?
                    <i class="fa-solid fa-chevron-down faq__icon"></i>
                </button>
                <div class="faq__answer">
                    <p>Да, мы предоставляем гарантию:<br>
                        • Возврат средств в течение 24 часов при технических проблемах<br>
                        • Бесплатные обновления в течение периода подписки<br>
                        • Техническая поддержка для всех пользователей<br>
                        • Замена ключа при блокировке (в зависимости от условий)</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const faqQuestions = document.querySelectorAll('.faq__question');

            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const answer = this.nextElementSibling;
                    const isActive = this.classList.contains('active');

                    // Close all other FAQ items
                    faqQuestions.forEach(q => {
                        q.classList.remove('active');
                        q.nextElementSibling.classList.remove('active');
                    });

                    // Toggle current item
                    if (!isActive) {
                        this.classList.add('active');
                        answer.classList.add('active');
                    }
                });
            });
        });
    </script>
@endsection