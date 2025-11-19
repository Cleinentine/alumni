<!DOCTYPE html>

<html class="scroll-smooth" lang="en">
    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        @vite([
            'resources/css/app.css',
            'resources/js/app.js'
        ])

        <title>{{ env('APP_NAME') }}</title>
    </head>

    <body class="font-nunito">
        @yield('content')

        <div id="fb-root"></div>
        
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v24.0&appId=1140187344090566"></script>
        <script src="https://kit.fontawesome.com/9fa37eff98.js" crossorigin="anonymous"></script>
    </body>
</html>