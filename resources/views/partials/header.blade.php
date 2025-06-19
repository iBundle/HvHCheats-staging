<header id="header" class="header">
    <div class="container header__wrapper">
        <!-- Logo -->
        <div class="header__title flex p-4">
            <div class="flex items-center gap-3 mb-4 p-4">
                <img
                        src="{{ asset('img/logo-white.svg') }}"
                        alt="HvHCheats logo"
                        class="footer__logo h-32 w-auto"
                />
                <span class="text-5xl font-bold text-white">HvHCheats</span>
            </div>
        </div>

        <!-- Navigation Menu -->
        <div id="menu" class="header__menu">
            <div id="menu-back-btn" class="menu__back-btn">
                <i class="fa-solid fa-arrow-right"></i>
            </div>

            <div class="menu--left">
                <!-- Главная страница -->
                <div class="menu__item">
                    <div class="menu__item-btn">
                        <p class="menu__label">Главная страница</p>
                    </div>
                </div>

                <!-- Коллекции читов -->
                <div class="menu__item">
                    <div class="menu__item-btn">
                        <p class="menu__label">Коллекции читов</p>
                        <i class="fa-solid fa-chevron-down menu__icon"></i>
                    </div>
                    <ul class="menu__submenu">
                        <li class="menu__item submenu__item">Коллекция Valorant</li>
                        <li class="menu__item submenu__item">Коллекция CS 2</li>
                        <li class="menu__item submenu__item">Коллекция CS 1.6</li>
                        <li class="menu__item submenu__item">Коллекция Warface</li>
                        <li class="menu__item submenu__item">Коллекция Roblox</li>
                    </ul>
                </div>

                <!-- Список читов -->
                <div class="menu__item">
                    <div class="menu__item-btn">
                        <p class="menu__label">Список читов</p>
                        <i class="fa-solid fa-chevron-down menu__icon"></i>
                    </div>
                    <ul class="menu__submenu">
                        <li class="menu__item submenu__item">Valorant</li>
                        <li class="menu__item submenu__item">Roblox</li>
                        <li class="menu__item submenu__item">Warface</li>
                        <li class="menu__item submenu__item">CS 2</li>
                        <li class="menu__item submenu__item">CS 1.6</li>
                        <li class="menu__item submenu__item">CS Source</li>
                    </ul>
                </div>

                <!-- Служба поддержки -->
                <div class="menu__item">
                    <div class="menu__item-btn">
                        <p class="menu__label">Служба поддержки</p>
                        <i class="fa-solid fa-chevron-down menu__icon"></i>
                    </div>
                    <ul class="menu__submenu">
                        <li class="menu__item submenu__item">Техническая поддержка</li>
                        <li class="menu__item submenu__item">Партнёрам</li>
                    </ul>
                </div>
            </div>

            <!-- Right Menu -->
            <div class="menu--right">
                <!-- Auth Button -->
                <div class="header__wallet btn btn--primary">
                    <i class="fa-solid fa-wallet"></i>
                    <p>Войти в систему</p>
                </div>

                <!-- Theme Switcher -->
                <div class="theme">
                    <div id="light-theme-btn" class="theme__btn theme__btn--light">
                        <ion-icon name="sunny-outline"></ion-icon>
                    </div>
                    <div id="dark-theme-btn" class="theme__btn theme__btn--dark">
                        <ion-icon name="moon-outline"></ion-icon>
                    </div>
                </div>
            </div>
        </div>

        <!-- Login Button -->
        <div class="login">
            <a href="#" class="login__btn">
                <i class="fa-regular fa-user"></i>
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <div id="menu-btn" class="header__menu-btn">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>
</header>