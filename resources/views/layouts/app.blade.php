<!DOCTYPE html>

<html class="scroll-smooth" lang="en">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <link rel="icon" type="image/png" href="{{ asset('images/icons') }}/favicon-96x96.png" sizes="96x96" />
        <link rel="icon" type="image/svg+xml" href="{{ asset('images/icons') }}/favicon.svg" />
        <link rel="shortcut icon" href="{{ asset('images/icons') }}/favicon.ico" />
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/icons') }}/apple-touch-icon.png" />
        <link rel="manifest" href="{{ asset('images/icons') }}/site.webmanifest" />

        <meta charset="UTF-8">
        <meta name="apple-mobile-web-app-title" content="CSUAn Ako" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Primary Meta Tags (Google SEO) -->
        <meta name="title" content="{{ $webTitle ?? 'My Site' }}">
        <meta name="description" content="{{ $webDesc ?? 'Default description' }}">
        <meta name="keywords" content="{{ $webKeywords ?? '' }}">
        <link rel="canonical" href="{{ $canonical ?? url()->current() }}">

        <!-- Open Graph (Facebook, LinkedIn, Slack) -->
        <meta property="og:type" content="{{ $ogType ?? 'website' }}">
        <meta property="og:title" content="{{ $webTitle ?? 'My Site' }}">
        <meta property="og:description" content="{{ $webDesc ?? 'Default description' }}">
        <meta property="og:url" content="{{ $canonical ?? url()->current() }}">
        <meta property="og:image" content="{{ $webImg ?? asset('default.jpg') }}">
        <meta property="og:site_name" content="CSUAn Ako: An Online Alumni Repository">

        <!-- X / Twitter Cards -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="{{ $webTitle ?? 'My Site' }}">
        <meta name="twitter:description" content="{{ $webDesc ?? 'Default description' }}">
        <meta name="twitter:image" content="{{ $webImg ?? asset('default.jpg') }}">

        @vite([
            'resources/css/app.css',
            'resources/js/app.js'
        ])

        <title>{{ env('APP_NAME') }}</title>
    </head>

    <body class="font-nunito">
        @yield('content')
        @include('cookie-consent::index')

        <div id="fb-root"></div>
        
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v24.0&appId=1140187344090566"></script>
        <script src="https://kit.fontawesome.com/9fa37eff98.js" crossorigin="anonymous"></script>
    </body>
</html>