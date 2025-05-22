<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Accueil Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="font-sans">

    <!-- Navbar pour les visiteurs (non connectés) -->
    @guest
    <nav class="bg-gray-900 text-white shadow fixed top-0 left-0 w-full mb-20 rounded-md border-b-2 border-white z-50 ">
        <div class="container mx-auto flex flex-wrap items-center justify-between p-4">
            <a href="{{ url('/') }}" class="flex items-center gap-2 mr-5 mb-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-6 h-6" />
                <span class="text-xl font-semibold">Accueil</span>
            </a>

            <!-- Mobile menu button -->
            <button id="menu-btn" class="block lg:hidden focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>



            <div id="menu" class="hidden w-full lg:flex lg:w-auto lg:items-center lg:justify-end gap-6">
                <form action="{{ url('/') }}">
                    @csrf
                    @method('GET')
                    <input
                        type="text"
                        name="query"
                        placeholder="Rechercher un article..."
                        class="px-3 py-1 border rounded-l text-black"
                        value="{{ request('query') }}">
                    <button type="submit" class="bg-blue-500 text-white px-3 py-1 rounded-r hover:bg-blue-600">
                        Rechercher
                    </button>
                </form>

                <ul class="flex flex-col lg:flex-row lg:items-center gap-4 text-lg">
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
                    <li>
                        <a href="#about">
                            <i class="bi bi-info-circle"></i>
                            <span>À propos</span>
                        </a>
                    </li>
                    <li class="relative">
                        <a href="{{ route('panier.index') }}" class="hover:underline flex items-center gap-1">
                            <i class="bi bi-cart-fill"></i> Panier
                            <span class="absolute -top-2 -right-4 bg-red-600 text-white rounded-full px-2 text-xs">
                                {{ session('cart_count', 0) }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    @endguest

    <!-- Navbar pour les utilisateurs connectés -->
    @auth
    @include('layouts.navigation')
    @endauth

    <!-- Contenu articles -->
    <main class="container mx-auto px-4 py-6 mt-14">
        @guest
        <section
        x-data="{
        images: [
            '{{ asset('images/hero1.jpeg') }}',
            '{{ asset('images/hero2.jpeg') }}',
            '{{ asset('images/hero3.png') }}'
        ],
        index: 0,
        init() {
            setInterval(() => {
                this.index = (this.index + 1) % this.images.length;
            }, 2000); // Changement toutes les 2 secondes
        }
    }"
            class="relative h-[80vh] w-full overflow-hidden rounded-md shadow-lg">
            <!-- Image slider -->
            <template x-for="(image, i) in images" :key="i">
                <div
                    x-show="index === i"
                    class="absolute inset-0 bg-cover bg-center transition-opacity duration-1000"
                    :style="`background-image: url(${image});`"
                    x-transition:enter="transition-opacity duration-1000"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition-opacity duration-1000"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"></div>
            </template>

            <!-- Overlay -->
            <div class="absolute inset-0 bg-black bg-opacity-50"></div>

            <!-- Contenu du Hero -->
            <div class="relative z-10 flex flex-col justify-center items-start h-full max-w-7xl mx-auto px-4 text-white">
                <h1 class="text-4xl sm:text-5xl font-bold mb-4">Trouvez les meilleurs articles au meilleur prix</h1>
                <p class="text-lg sm:text-xl mb-6">Livraison rapide, produits frais, satisfaction garantie !</p>
                <a href="" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow transition">
                    Commander maintenant
                </a>
            </div>
        </section>

        @endguest
        <div class="mb-10 text-center mt-12">
            <p class="text-lg text-gray-600">Découvrez nos articles disponibles</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($articles as $article)
            <div class="bg-white shadow-md rounded-lg overflow-hidden flex flex-col">
                <img src="{{ asset('storage/'.$article->image) }}" alt="{{ $article->libelle }}" class="w-full h-48 object-cover">

                <div class="p-4 flex flex-col flex-grow">
                    <h2 class="text-xl font-semibold mb-2 text-gray-800">{{ $article->libelle }}</h2>
                    <p class="text-gray-600 mb-2 truncate">{{ Str::limit($article->description, 80) }}</p>
                    <p class="text-lg font-bold text-indigo-600 mb-4">{{ number_format($article->prix, 2) }} MAD</p>

                    <a href="{{ route('panier.ajouter', $article->id) }}"
                        class="w-full inline-block text-center bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                        Ajouter au panier
                    </a>


                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8 flex justify-center">
            {{ $articles->withQueryString()->links() }}
        </div>
        @include('profile.partials.about');
    </main>


    <!-- Script du menu mobile -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const btn = document.getElementById('menu-btn');
            const menu = document.getElementById('menu');

            if (btn) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>

</html>