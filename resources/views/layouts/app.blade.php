<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <!-- SEO Meta Tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HvHCheats - лучшие в своем деле')</title>
    <meta name="description" content="@yield('meta_description', 'Лучшие читы СНГ и всего мира с регулярными обновлениями')">
    <meta name="keywords" content="@yield('meta_keywords', 'читы, cheats, cs2, valorant, warface, roblox')">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('Assets/Images/01_header/favicon.ico') }}" type="image/x-icon"/>

    <!-- FontAwesome -->
    <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
    />

    <!-- Assets Directory Configuration -->
    <script>
        let AssetsDirectory = "/Assets";
    </script>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/sass/main.scss'])

    <!-- Additional Head Content -->
    @stack('head')
</head>

<body class="theme--dark">
<!-- Loading Page -->
<div class="loading__page">
    <div class="loading__spinner">
        <div class="spinner__planet spinner__sun"></div>
        <div class="spinner__planet spinner__moon">
            <div class="moon__freckle moon__freckle--lg"></div>
            <div class="moon__freckle moon__freckle--s"></div>
            <div class="moon__freckle moon__freckle--xs"></div>
        </div>
    </div>
</div>

<div class="body__wrapper">
    <!-- Background -->
    <div id="background" class="background--light"></div>

    <!-- Header -->
    @include('partials.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('partials.footer')

    <!-- Scroll to Top Button -->
    <div id="scroll-up-btn" class="scroll__btn">
        <i class="fa-solid fa-angle-up"></i>
    </div>
</div>

<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- Core Scripts -->
<script src="{{ asset('Assets/Data/itemsData.js') }}"></script>
<script src="{{ asset('Assets/Data/CollectionsData.js') }}"></script>
<script src="{{ asset('Assets/Data/SellersData.js') }}"></script>
<script src="{{ asset('Javascript/index.js') }}"></script>
<script src="{{ asset('Javascript/theme.js') }}"></script>
<script src="{{ asset('Javascript/header.js') }}"></script>
<script src="{{ asset('Javascript/hero.js') }}"></script>
<script src="{{ asset('Javascript/collections.js') }}"></script>
<script src="{{ asset('Javascript/sellers.js') }}"></script>
<script src="{{ asset('Javascript/socials.js') }}"></script>

<!-- Additional Scripts -->
@stack('scripts')
</body>
</html>