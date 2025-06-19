<!-- Hero Section -->
<section id="hero">
    <div id="stars"></div>
    <div id="stars2"></div>
    <div id="stars3"></div>
    <div class="container hero__wrapper">
        <div class="hero--left">
            <h1 id="title" class="hero__title">
                Играй в любимую<br/>
                игру с<br/>
                <span class="hero__span">
                    <span class="hero__span hero__character">
                        Б
                        <div class="character__body">
                            <div class="face__wrapper">
                                <div class="horn horn--left">
                                    <div class="horn__tip"></div>
                                </div>
                                <div class="horn horn--right">
                                    <div class="horn__tip"></div>
                                </div>
                                <div class="eyes__wrapper">
                                    <div class="eye eye--left">
                                        <div class="eyelid eyelid--left"></div>
                                        <div class="pupil">
                                            <div class="pupil__center"></div>
                                            <div class="sparkles"></div>
                                        </div>
                                    </div>
                                    <div class="eye eye--right">
                                        <div class="eyelid eyelid--right"></div>
                                        <div class="pupil">
                                            <div class="pupil__center"></div>
                                            <div class="sparkles"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mouth"></div>
                            </div>
                            <div class="hand hand--left"></div>
                            <div class="hand hand--right"></div>
                        </div>
                    </span>
                    ЕСПЛАТНЫМИ
                </span>
                читами
            </h1>
            <p class="hero__description">
                {{ $heroDescription ?? 'Лучшие читы СНГ и всего мира с регулярными обновлениями' }}
            </p>
            <div class="hero__btns">
                <a href="{{ $heroButtonUrl ?? '#' }}" class="btn btn--primary hero__btn">
                    <i class="fa-solid fa-rocket"></i> {{ $heroButtonText ?? 'Перейти к читам' }}
                </a>
            </div>
        </div>

        <div class="hero--right">
            <!-- SVG Blob Animations -->
            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="hero__blob hero__blob--first hero__blob--animated">
                <filter id="gaussian-blur">
                    <feGaussianBlur stdDeviation="5" result="offset-blur"/>
                </filter>
                <g filter="url(#gaussian-blur)">
                    <path d="M19.1,-29.3C25.2,-29.6,30.7,-25.3,31.6,-19.6C32.4,-14,28.5,-7,31.8,1.9C35.2,10.9,45.8,21.7,47.4,31.6C49.1,41.5,41.7,50.4,32.2,61.1C22.8,71.9,11.4,84.4,4.8,76C-1.8,67.7,-3.6,38.5,-11.3,26.8C-19.1,15.1,-32.8,21,-39.8,19.4C-46.7,17.9,-46.9,9,-53.2,-3.6C-59.4,-16.2,-71.8,-32.4,-68.7,-40.6C-65.6,-48.9,-47.1,-49.1,-33,-44.2C-19,-39.2,-9.5,-29.1,-1.5,-26.5C6.5,-23.9,13.1,-28.9,19.1,-29.3Z" transform="translate(100 100)"/>
                </g>
            </svg>

            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="hero__blob hero__blob--second">
                <filter id="gaussian-blur">
                    <feGaussianBlur stdDeviation="5" result="offset-blur"/>
                </filter>
                <g filter="url(#gaussian-blur)">
                    <path d="M17.5,-28.8C28.7,-23.8,48.1,-31.4,59.4,-28.7C70.6,-26,73.6,-13,67.3,-3.6C61,5.7,45.4,11.5,38.2,21.1C30.9,30.7,32.1,44.1,27.1,44.5C22.2,44.9,11.1,32.1,-1.5,34.8C-14.1,37.4,-28.3,55.4,-42.7,60.5C-57.1,65.6,-71.8,57.7,-68.3,45.5C-64.8,33.3,-43.2,16.6,-35.9,4.2C-28.5,-8.2,-35.5,-16.4,-39.7,-29.8C-43.8,-43.2,-45.2,-61.8,-38.1,-69.3C-31,-76.7,-15.5,-72.8,-6.2,-62.1C3.1,-51.4,6.2,-33.8,17.5,-28.8Z" transform="translate(100 100)"/>
                </g>
            </svg>

            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="hero__blob hero__blob--third">
                <filter id="gaussian-blur">
                    <feGaussianBlur stdDeviation="5" result="offset-blur"/>
                </filter>
                <g filter="url(#gaussian-blur)">
                    <path d="M29.6,-55.2C40,-45.2,51.2,-40.6,57.5,-32.3C63.8,-24,65.2,-12,59.1,-3.5C53,5,39.5,10,31.8,15.9C24.1,21.7,22.2,28.5,17.9,34.7C13.5,40.9,6.8,46.5,-0.4,47.2C-7.5,47.9,-15.1,43.5,-25.2,40.7C-35.3,37.8,-48.1,36.5,-59.4,29.9C-70.7,23.4,-80.6,11.7,-77.3,1.9C-73.9,-7.8,-57.2,-15.6,-48.1,-25.9C-38.9,-36.1,-37.2,-48.8,-30.5,-60.9C-23.7,-73,-11.8,-84.5,-1.1,-82.5C9.6,-80.6,19.1,-65.1,29.6,-55.2Z" transform="translate(100 100)"/>
                </g>
            </svg>

            <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="hero__blob hero__blob--forth">
                <filter id="gaussian-blur">
                    <feGaussianBlur stdDeviation="5" result="offset-blur"/>
                </filter>
                <g filter="url(#gaussian-blur)">
                    <path d="M42.1,27.3C32.2,41.3,-13.4,37.7,-26.3,21.8C-39.3,6,-19.6,-22.1,3.1,-20.3C25.9,-18.4,51.9,13.3,42.1,27.3Z" transform="translate(100 100)"/>
                </g>
            </svg>

            <div class="hero__img-wrapper">
                <img
                        src="{{ $heroImage ?? asset('img/imgslider-3.png') }}"
                        alt="{{ $heroImageAlt ?? 'HvHCheats Hero Image' }}"
                        role="presentation"
                        class="hero__img"
                />
            </div>
        </div>
    </div>
</section>