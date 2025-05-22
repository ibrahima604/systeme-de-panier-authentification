<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Accueil Laravel</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


</head>

<body class="bg-gray-900 text-white font-sans">
    <!-- Navbar -->
    <nav class="bg-gray-900 shadow">
        <div class="container mx-auto flex flex-wrap items-center justify-between p-4">
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8" />
                <span class="text-xl font-semibold">Accueil</span>
            </a>

            <!-- Mobile menu button -->
            <button id="menu-btn" class="block lg:hidden focus:outline-none">
                <svg
                    class="w-6 h-6"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
            <form action="{{ route('articles.search') }}" method="GET" class="flex items-center">
                <input
                    type="text"
                    name="query"
                    placeholder="Rechercher un article..."
                    class="px-3 py-1 border rounded-l"
                    value="{{ request('query') }}">
                <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-r hover:bg-blue-600">
                    Rechercher
                </button>
            </form>


            <div
                id="menu"
                class="hidden w-full lg:flex lg:w-auto lg:items-center lg:justify-end gap-6">
                <ul class="flex flex-col lg:flex-row lg:items-center gap-4 text-lg">
                    @auth
                    <li>
                        <a href="{{ url('/dashboard') }}" class="hover:underline flex items-center gap-1">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    @else
                    <li>
                        <a href="{{ route('login') }}" class="hover:underline flex items-center gap-1">
                            <i class="bi bi-box-arrow-in-right"></i> Connexion
                        </a>
                    </li>
                    @if (Route::has('register'))
                    <li>
                        <a href="{{ route('register') }}" class="hover:underline flex items-center gap-1">
                            <i class="bi bi-person-plus"></i> Inscription
                        </a>
                    </li>
                    @endif
                    <li class="relative">
                        <a href="{{ route('panier.index') }}" class="hover:underline flex items-center gap-1">
                            <i class="bi bi-cart-fill"></i> Panier
                            <span
                                class="absolute -top-2 -right-4 bg-red-600 text-white rounded-full px-2 text-xs">
                                {{ session('cart_count', 0) }}
                            </span>
                        </a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu de la page -->
    <main class="container mx-auto my-10 px-4 text-center">
        @yield('content')
    </main>
    {{-- Inclusion des articles --}}
    @isset($articles)
    @include('components.articles')
    @endisset



    <script>
        // Toggle mobile menu
        const btn = document.getElementById('menu-btn');
        const menu = document.getElementById('menu');

        btn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>

</html>