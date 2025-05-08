<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Deal buy</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css"
        rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->

    <!--Fuentes Google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee+Spice&family=Press+Start+2P&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    @vite('resources/css/styles.css')
    @vite('resources/css/chatbotStyle.css')
    @vite('resources/css/preloaderStyle.css')
</head>

<body>
    <!-- Navbar -->
     @include('includes.navbar')
    <!-- End Navbar -->

    <!-- Main content -->
     @yield('content')
    <!-- End Main content -->

    <!-- Footer -->
    @include('includes.footer')
    <!-- End Footer -->

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->

    <!-- Scripts -->
    @stack('scripts')
    
    @vite('resources/js/app.js')
    @vite('resources/js/chatbot.js')
    @vite('resources/js/loaderScript.js')
</body>

</html>