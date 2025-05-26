<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Accueil Laravel</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .thumbnail {
            width: 30px;
            height: 30px;
            object-fit: cover;
            transition: border-color 0.3s ease;
        }
    </style>
</head>

<body class="font-sans">

    <!-- Navbar pour les visiteurs (non connectés) -->
    @guest
    <nav class="bg-gray-900 text-white shadow fixed top-0 left-0 w-full mb-20 rounded-md border-b-2 border-white z-50">
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
                <form action="{{ url('/') }}" class="flex">
                    @csrf
                    @method('GET')
                    <input type="text" name="query" placeholder="Rechercher un article..."
                        class="px-3 py-1 border rounded-l text-black w-full max-w-xs" value="{{ request('query') }}">
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
                        <a href="#about" class="flex items-center gap-1">
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

    @auth
    @include('layouts.navigation')
    @endauth

    <main class="container mx-auto px-4 py-6 mt-20">
        <div class="mb-10 text-center mt-12">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Découvrez nos articles disponibles</h1>
            <p class="text-lg text-gray-600">Les meilleures offres du moment</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($articles as $article)
            <div
                class="bg-white shadow-sm border rounded-lg overflow-hidden flex flex-col hover:shadow-lg transition duration-300 group h-full">

                <div class="relative overflow-hidden">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->libelle }}"
                        class="w-full h-52 object-cover transition duration-300 group-hover:scale-105">
                    <div
                        class="absolute inset-0 bg-black bg-opacity-20 transition duration-300 group-hover:bg-opacity-30">
                    </div>
                    <div
                        class="absolute inset-0 flex items-center justify-center opacity-0 transition duration-300 group-hover:opacity-100">
                        <a href="{{ route('articles.show', $article->id) }}"
                            class="bg-white text-gray-800 px-4 py-2 rounded-full shadow hover:bg-gray-200 transition">
                            Voir les détails
                        </a>
                    </div>
                    <!-- Boutons des images (couleurs) -->
                    <div class="flex mt-4 gap-2 overflow-x-auto pb-2">
                        <!-- Image principale -->
                        <button type="button" class="focus:outline-none">
                            <img src="{{ asset('storage/' . $article->image) }}"
                                alt="Default"
                                class="thumbnail rounded cursor-pointer border-2 border-transparent hover:border-indigo-500 focus:border-indigo-500">
                        </button>

                        <!-- Images des variantes couleur -->
                        @foreach($article->couleurImages as $image)
                        <button type="button" class="focus:outline-none">
                            <img src="{{ asset('storage/' . $image->image) }}"
                                alt="{{ $image->couleur->nom }}"
                                class="thumbnail rounded cursor-pointer border-2 border-transparent hover:border-indigo-500 focus:border-indigo-500">
                        </button>
                        @endforeach
        
                    </div>

                    <!-- Boutons de sélection des tailles -->
                    <div class="flex mt-2 gap-2 flex-wrap">
                        @foreach ($article->variantes->whereNotNull('taille_id')->unique('taille_id') as $variante)
                        <button type="button"
                            class="px-2 py-1 text-xs font-medium bg-gray-100 border border-gray-300 rounded hover:bg-gray-200 focus:bg-indigo-500 focus:text-white focus:outline-none">
                            {{ $variante->taille->nom }}
                        </button>
                        @endforeach
                    </div>

                    @if($article->is_new)
                    <span
                        class="absolute top-2 left-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">Nouveau</span>
                    @endif

                    @if($article->reduction > 0)
                    <span
                        class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">-{{ $article->reduction }}%</span>
                    @endif
                </div>

                <div class="p-4 flex flex-col flex-grow">
                    <a href="#" class="hover:underline">
                        <h2 class="text-base font-semibold text-gray-900 mb-1">{{ $article->libelle }}</h2>
                    </a>
                    <p class="text-sm text-gray-500 mb-2">{{ Str::limit($article->description, 70) }}</p>

                    <div class="mt-auto">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-lg font-bold text-indigo-600">
                                {{ number_format($article->prix, 2) }}
                            </span>{{ config('app.currency', 'MAD') }}
                            @if($article->reduction > 0)
                            <span class="text-sm text-gray-400 line-through">
                                {{ number_format($article->prix_avant_reduction, 2) }} {{ config('app.currency') }}
                            </span>
                            @endif
                        </div>

                        <a href="{{ route('panier.ajouter', $article->id) }}"
                            class="inline-block w-full text-center bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition">
                            Ajouter au panier
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </main>

    <script>
        // Gestion du menu mobile
        document.getElementById('menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        });

        // Fermer le menu quand on clique à l'extérieur
        document.addEventListener('click', function(event) {
            const menuBtn = document.getElementById('menu-btn');
            const menu = document.getElementById('menu');

            if (menu && menuBtn && !menu.contains(event.target) && !menuBtn.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>
</body>

</html>