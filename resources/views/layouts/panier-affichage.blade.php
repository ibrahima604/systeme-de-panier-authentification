<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panier Laravel</title>

    <!-- Bootstrap CSS -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <!-- CSS/JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    

<body class="antialiased text-gray-700 bg-gray-50 font-sans">
    <!-- Contenu de la page -->
    <main class="">

        @yield('content')

    </main>


   
</body>

</html>