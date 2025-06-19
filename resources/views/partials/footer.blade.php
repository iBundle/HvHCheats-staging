<footer id="footer">
    <div class="container footer__wrapper">
        <!-- Brand Section -->
        <div class="footer__item">
            <div class="flex items-center gap-3 mb-4">
                <img
                        src="{{ asset('img/logo-white.svg') }}"
                        alt="HvHCheats logo"
                        class="footer__logo h-32 w-auto"
                />
                <span class="text-5xl font-bold text-white">HvHCheats</span>
            </div>
            <p class="footer__description">
                Платформа для игры с игровыми читами и модификациями.
                Официально легитно.
            </p>
        </div>

        <!-- Popular Games -->
        <div class="footer__item">
            <h3 class="footer__title">Популярные игры</h3>
            <div class="footer__links">
                <a href="#" class="footer__link">Counter-Strike 2</a>
                <a href="#" class="footer__link">Valorant</a>
                <a href="#" class="footer__link">Warface</a>
                <a href="#" class="footer__link">Roblox</a>
                <a href="#" class="footer__link">CS:GO</a>
            </div>
        </div>

        <!-- Resources -->
        <div class="footer__item">
            <h3 class="footer__title">Ресурсы</h3>
            <div class="footer__links">
                <a href="#" class="footer__link">Инструкции</a>
                <a href="#" class="footer__link">FAQ</a>
                <a href="#" class="footer__link">Безопасность</a>
                <a href="#" class="footer__link">Статусы читов</a>
                <a href="#" class="footer__link">Новости</a>
            </div>
        </div>

        <!-- Community -->
        <div class="footer__item">
            <h3 class="footer__title">Сообщество</h3>
            <div class="footer__links">
                <a href="#" class="footer__link">Telegram канал</a>
                <a href="#" class="footer__link">Обратная связь</a>
                <a href="#" class="footer__link">Правила</a>
                <a href="#" class="footer__link">Политика конфиденциальности</a>
            </div>
        </div>

        <!-- Newsletter Subscription -->
        <div class="footer__item">
            <h3 class="footer__title">Подписаться на обновления</h3>
            <form class="footer__form">
                @csrf
                <input
                        type="email"
                        class="footer__input"
                        placeholder="your@email.com"
                        name="email"
                        required
                />
                <button type="submit" class="footer__submit-btn">
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>

            <!-- Social Links -->
            <div class="footer__socials">
                <div class="footer__social-btn">
                    <i class="fa-brands fa-telegram"></i>
                </div>
                <div class="footer__social-btn">
                    <i class="fa-brands fa-discord"></i>
                </div>
                <div class="footer__social-btn">
                    <i class="fa-brands fa-youtube"></i>
                </div>
                <div class="footer__social-btn">
                    <i class="fa-brands fa-github"></i>
                </div>
                <div class="footer__social-btn">
                    <i class="fa-brands fa-reddit"></i>
                </div>
            </div>
        </div>
    </div>
</footer>