
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
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .thumbnail:hover, .thumbnail.active {
            border-color: #4f46e5;
            transform: scale(1.1);
        }
        .product-card {
            transition: all 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .size-btn {
            transition: all 0.2s ease;
        }
        .size-btn.active {
            background-color: #4f46e5;
            color: white;
        }
        .color-btn {
            width: 20px;
            height: 20px;
            border-radius: 50%;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        .color-btn.active {
            border-color: #4f46e5;
            transform: scale(1.2);
        }
        [x-cloak] { display: none !important; }
        .dropdown-enter-active, .dropdown-leave-active {
            transition: opacity 0.2s, transform 0.2s;
        }
        .dropdown-enter-from, .dropdown-leave-to {
            opacity: 0;
            transform: translateY(-10px);
        }
        /* Styles améliorés pour le menu burger */
        .mobile-menu {
            transition: all 0.3s ease-in-out;
            transform-origin: top right;
        }
        .mobile-menu-item {
            transition: all 0.2s ease;
        }
        .mobile-menu-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        .burger-line {
            transition: all 0.3s ease;
        }
        .burger-open .burger-line:nth-child(1) {
            transform: translateY(8px) rotate(45deg);
        }
        .burger-open .burger-line:nth-child(2) {
            opacity: 0;
        }
        .burger-open .burger-line:nth-child(3) {
            transform: translateY(-8px) rotate(-45deg);
        }
        /* Styles pour le stock */
        .stock-bar {
            transition: all 0.3s ease;
        }
        .stock-low {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { opacity: 1; }
            50% { opacity: 0.7; }
            100% { opacity: 1; }
        }
        .stock-indicator {
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .stock-icon {
            font-size: 0.9rem;
        }
    </style>
</head>

<body class="font-sans bg-gray-400" x-data="appData()">
    <!-- Navbar pour les visiteurs (non connectés) -->
    @guest
    <nav class="bg-gray-900 text-white shadow fixed top-0 left-0 w-full z-50" x-data="{ mobileMenuOpen: false, accountOpen: false }">
        <div class="container mx-auto flex items-center justify-between p-4">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-6 h-6" />
                <span class="text-xl font-semibold">Accueil</span>
            </a>

            <!-- Burger Button amélioré -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="block lg:hidden focus:outline-none p-2"
                    :class="{ 'burger-open': mobileMenuOpen }">
                <div class="w-6 space-y-1.5">
                    <span class="burger-line block h-0.5 w-6 bg-current"></span>
                    <span class="burger-line block h-0.5 w-6 bg-current"></span>
                    <span class="burger-line block h-0.5 w-6 bg-current"></span>
                </div>
            </button>

            <!-- Menu desktop -->
            <div class="hidden lg:flex lg:w-auto lg:items-center lg:justify-end gap-6">
                <ul class="flex flex-col lg:flex-row lg:items-center gap-6 text-lg">
                    <!-- À propos -->
                    <li>
                        <a href="{{route('about')}}" class="hover:underline flex items-center gap-1">
                            <i class="bi bi-info-circle"></i>
                            <span>À propos</span>
                        </a>
                    </li>

                    <!-- Compte -->
                    <li class="relative" x-data="{ accountOpen: false }">
                        <button @click="accountOpen = !accountOpen" class="hover:underline flex items-center gap-1 focus:outline-none">
                            <i class="bi bi-person-circle"></i>
                            <span>Compte</span>
                        </button>
                        <div x-show="accountOpen" @click.away="accountOpen = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 text-gray-800">
                            <a href="{{ route('login') }}" class="block px-4 py-2 hover:bg-gray-100">
                                <i class="bi bi-box-arrow-in-right mr-2"></i>Connexion
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="block px-4 py-2 hover:bg-gray-100">
                                    <i class="bi bi-person-plus mr-2"></i>Inscription
                                </a>
                            @endif
                        </div>
                    </li>

                    <!-- Panier -->
                    <li class="relative">
                        <a href="{{ route('panier.index') }}" class="hover:underline flex items-center gap-1">
                            <i class="bi bi-cart-fill"></i>
                            <span>Panier</span>
                            <span class="absolute -top-2 -right-4 bg-red-600 text-white rounded-full px-2 text-xs">
                                {{ session('cart_count', 0) }}
                            </span>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Menu mobile amélioré -->
            <div x-show="mobileMenuOpen"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="mobile-menu lg:hidden absolute top-full left-0 right-0 bg-gray-900 shadow-lg rounded-b-lg overflow-hidden"
                 @click.away="mobileMenuOpen = false"
                 x-cloak>
                <ul class="py-2 px-4 space-y-2">
                    <!-- À propos -->
                    <li>
                        <a href="#about" class="mobile-menu-item block px-4 py-3 rounded-lg flex items-center gap-3" @click="mobileMenuOpen = false">
                            <i class="bi bi-info-circle text-lg"></i>
                            <span>À propos</span>
                        </a>
                    </li>

                    <!-- Compte -->
                    <li class="border-t border-gray-700 pt-2 mt-2">
                        <div x-data="{ mobileAccountOpen: false }" class="relative">
                            <button @click="mobileAccountOpen = !mobileAccountOpen"
                                    class="mobile-menu-item w-full px-4 py-3 rounded-lg flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <i class="bi bi-person-circle text-lg"></i>
                                    <span>Compte</span>
                                </div>
                                <i class="bi bi-chevron-down transition-transform duration-200"
                                   :class="{ 'rotate-180': mobileAccountOpen }"></i>
                            </button>
                            <div x-show="mobileAccountOpen"
                                 x-transition
                                 class="ml-8 mt-1 space-y-1">
                                <a href="{{ route('login') }}" class="mobile-menu-item block px-4 py-2 rounded-lg flex items-center gap-3" @click="mobileMenuOpen = false">
                                    <i class="bi bi-box-arrow-in-right"></i>
                                    <span>Connexion</span>
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="mobile-menu-item block px-4 py-2 rounded-lg flex items-center gap-3" @click="mobileMenuOpen = false">
                                        <i class="bi bi-person-plus"></i>
                                        <span>Inscription</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </li>

                    <!-- Panier -->
                    <li class="border-t border-gray-700 pt-2 mt-2">
                        <a href="{{ route('panier.index') }}"
                           class="mobile-menu-item block px-4 py-3 rounded-lg flex items-center gap-3"
                           @click="mobileMenuOpen = false">
                            <i class="bi bi-cart-fill text-lg"></i>
                            <span>Panier</span>
                            <span class="ml-auto bg-red-600 text-white rounded-full px-2 text-xs">
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

    <main class="container mx-auto px-4 py-6 mt-12" x-data="searchComponent()">
        <section x-data="{ current: 0, images: ['{{ asset('images/hero1.jpeg') }}', '{{ asset('images/hero2.jpeg') }}', '{{ asset('images/hero3.png') }}'] }" 
         x-init="setInterval(() => { current = (current + 1) % images.length }, 5000)" 
         class="relative h-[90vh] overflow-hidden bg-gray-400">

    {{-- Images --}}
    <template x-for="(image, index) in images" :key="index">
        <div x-show="current === index" 
             x-transition:enter="transition-opacity ease-out duration-1000"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in duration-500"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0">
            <img :src="image" alt="Hero Image" class="w-full h-full object-cover">
        </div>
    </template>

    {{-- Overlay & Text --}}
    <div class="absolute inset-0 bg-black bg-opacity-60 flex flex-col justify-center items-center text-center text-white px-4">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Bienvenue sur notre plateforme</h1>
        <p class="text-lg md:text-xl mb-6">Explorez nos produits et profitez des meilleures offres !</p>
        <a href="#articles" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg transition">
            En savoir plus
        </a>
    </div>

    {{-- Pagination dots --}}
    <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 flex gap-2">
        <template x-for="(image, index) in images" :key="index">
            <button @click="current = index" 
                    class="w-3 h-3 rounded-full" 
                    :class="current === index ? 'bg-white' : 'bg-white/40'"></button>
        </template>
    </div>
</section>

        <div class="mb-10 text-center mt-5">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Découvrez nos articles disponibles</h1>
            <p class="text-lg text-gray-600">Les meilleures offres du moment</p>
        </div>

        <!-- Barre de recherche améliorée -->
        <div class="relative max-w-2xl mx-auto mb-5">
            <div class="relative">
                <input type="text" placeholder="Rechercher un article..."
                    class="w-full pl-12 pr-4 py-3 border rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm"
                    x-model.debounce.300ms="query"
                    @keyup="fetchResults()"
                    @focus="query && fetchResults()"
                >
                <i class="bi bi-search absolute left-4 top-3.5 text-gray-400 text-xl"></i>
                <button @click="fetchResults()" class="absolute right-2 top-1.5 bg-indigo-600 text-white p-1.5 rounded-full hover:bg-indigo-700">
                    <i class="bi bi-arrow-right"></i>
                </button>
            </div>

            <!-- Résultats de recherche -->
            <div class="absolute bg-white w-full mt-2 rounded-lg shadow-xl z-10 border border-gray-200 overflow-hidden"
                 x-show="results.length > 0 || (query.length > 0 && !isSearching && results.length === 0)"
                 x-transition
                 x-cloak>
                <template x-for="result in results" :key="result.id">
                    <a :href="`/articles/${result.id}`"
                       class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-100 flex items-center">
                        <img :src="`/storage/${result.image}`"
                             :alt="result.libelle"
                             class="w-10 h-10 object-cover rounded mr-3">
                        <div>
                            <div x-text="result.libelle" class="font-medium"></div>
                            <div class="text-sm text-gray-600" x-text="`${result.prix.toFixed(2)} MAD`"></div>
                        </div>
                    </a>
                </template>
                <div class="px-4 py-3 text-gray-500 text-center"
                     x-show="query.length > 0 && results.length === 0 && !isSearching">
                    Aucun résultat trouvé pour "<span x-text="query" class="font-medium"></span>"
                </div>
                <div class="px-4 py-3 text-gray-500 text-center" x-show="isSearching">
                    <i class="bi bi-arrow-repeat animate-spin mr-2"></i> Recherche en cours...
                </div>
            </div>
        </div>

        <!-- Affichage des articles -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="articles">
            @foreach ($articles as $article)
            <div class="bg-white rounded-lg shadow-md overflow-hidden flex flex-col product-card h-full"
                 x-data="{
                    selectedImage: '{{ asset('storage/' . $article->image) }}',
                    selectedSize: null,
                    selectedSizeId: null,
                    selectedColor: null,
                    selectedColorId: null,
                    showDetails: false
                 }">
                <!-- Image principale avec overlay -->
                <div class="relative overflow-hidden group">
                    <img :src="selectedImage" alt="{{ $article->libelle }}"
                        class="w-full h-60 object-cover transition duration-300 group-hover:scale-105">

                    <!-- Overlay avec bouton "Voir détails" -->
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition duration-300 flex items-center justify-center opacity-0 group-hover:opacity-100">
                        <button @click="showDetails = true" class="bg-white text-gray-800 px-4 py-2 rounded-full shadow hover:bg-gray-100 transition">
                            <a href="{{route('articles.show',$article->id)}}">
                                Voir les détails
                            </a>
                        </button>
                    </div>

                    <!-- Badges -->
                    @if($article->is_new)
                    <span class="absolute top-2 left-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                        Nouveau
                    </span>
                    @endif
                    @if($article->reduction > 0)
                    <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                        -{{ $article->reduction }}%
                    </span>
                    @endif
                </div>

                <!-- Miniatures des variantes -->
                <div class="px-4 pt-3 flex gap-2 overflow-x-auto pb-2">
                    <!-- Image principale -->
                    <button type="button" @click="selectedImage = '{{ asset('storage/' . $article->image) }}'"
                            :class="{'border-indigo-500': selectedImage === '{{ asset('storage/' . $article->image) }}'}"
                            class="thumbnail rounded focus:outline-none">
                        <img src="{{ asset('storage/' . $article->image) }}" alt="Default" class="w-full h-full">
                    </button>

                    <!-- Images des variantes couleur -->
                    @foreach($article->couleurImages as $image)
                    <button type="button" @click="
                            selectedImage = '{{ asset('storage/' . $image->image) }}';
                            selectedColor = '{{ $image->couleur->nom }}';
                            selectedColorId = '{{ $image->couleur->id }}';
                        "
                            :class="{'border-indigo-500': selectedImage === '{{ asset('storage/' . $image->image) }}'}"
                            class="thumbnail rounded focus:outline-none">
                        <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->couleur->nom }}" class="w-full h-full">
                    </button>
                    @endforeach
                </div>

                <!-- Sélection des couleurs -->
                @if($article->variantes->whereNotNull('couleur_id')->count() > 0)
                <div class="px-4 flex gap-2 flex-wrap">
                    @foreach($article->variantes->whereNotNull('couleur_id')->unique('couleur_id') as $variante)
                    <button type="button"
                            @click="
                                selectedColor = '{{ $variante->couleur->nom }}';
                                selectedColorId = '{{ $variante->couleur->id }}';
                            "
                            :class="{'active': selectedColorId === '{{ $variante->couleur->id }}'}"
                            class="color-btn focus:outline-none"
                            style="background-color: {{ $variante->couleur->nom === 'Blanc' ? '#ffffff' : ($variante->couleur->nom === 'Noir' ? '#000000' : '#cccccc') }}; border: 1px solid #ccc;"
                            title="{{ $variante->couleur->nom }}">
                    </button>
                    @endforeach
                </div>
                @endif

                <!-- Sélection des tailles -->
                @if($article->variantes->whereNotNull('taille_id')->count() > 0)
                <div class="px-4 flex gap-2 flex-wrap">
                    @foreach ($article->variantes->whereNotNull('taille_id')->unique('taille_id') as $variante)
                    <button type="button"
                            @click="
                                selectedSize = '{{ $variante->taille->nom }}';
                                selectedSizeId = '{{ $variante->taille->id }}';
                            "
                            :class="{'active': selectedSizeId === '{{ $variante->taille->id }}'}"
                            class="size-btn px-3 py-1 text-xs font-medium bg-gray-100 border border-gray-300 rounded-full hover:bg-gray-200 focus:outline-none">
                        {{ $variante->taille->nom }}
                    </button>
                    @endforeach
                </div>
                @endif

                <!-- Détails du produit -->
                <div class="p-4 flex flex-col flex-grow">
                    <a href="{{ route('articles.show', $article->id) }}" class="hover:underline">
                        <h2 class="text-lg font-semibold text-gray-900 mb-1">{{ $article->libelle }}</h2>
                    </a>
                    <p class="text-sm text-gray-500 mb-3">{{ Str::limit($article->description, 70) }}</p>

                    <!-- Affichage du stock -->
                    <div class="mb-3">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-gray-600">Stock disponible:</span>
                            <span class="font-medium stock-indicator"
                                  :class="{
                                      'text-green-600': {{ $article->quantite }} > 5,
                                      'text-yellow-600 stock-low': {{ $article->quantite }} > 0 && {{ $article->quantite }} <= 5,
                                      'text-red-600': {{ $article->quantite }} == 0
                                  }">
                                @if($article->quantite > 5)
                                <i class="bi bi-check-circle-fill stock-icon"></i>
                                @elseif($article->quantite > 0)
                                <i class="bi bi-exclamation-triangle-fill stock-icon"></i>
                                @else
                                <i class="bi bi-x-circle-fill stock-icon"></i>
                                @endif
                                {{ $article->quantite }} pièce(s)
                            </span>
                        </div>
                        <!-- Barre de progression du stock -->
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                            <div class="h-2 rounded-full stock-bar" 
                                 :class="{
                                     'bg-green-500': {{ $article->quantite }} > 5,
                                     'bg-yellow-500 stock-low': {{ $article->quantite }} > 0 && {{ $article->quantite }} <= 5,
                                     'bg-red-500': {{ $article->quantite }} == 0
                                 }"
                                 style="width: {{ min(100, $article->quantite / ($article->quantite + 10) * 100) }}%"></div>
                        </div>
                        @if($article->quantite > 0 && $article->quantite <= 5)
                        <p class="text-xs text-yellow-600 mt-1">Plus que {{ $article->quantite }} disponible(s) - Commandez vite !</p>
                        @elseif($article->quantite == 0)
                        <p class="text-xs text-red-600 mt-1">Rupture de stock - Réapprovisionnement en cours</p>
                        @endif
                    </div>

                    <div class="mt-auto">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-lg font-bold text-indigo-600">
                                {{ number_format($article->prix, 2) }} MAD
                            </span>
                            @if($article->reduction > 0)
                            <span class="text-sm text-gray-400 line-through">
                                {{ number_format($article->prix_avant_reduction, 2) }} MAD
                            </span>
                            @endif
                        </div>

                        <form method="POST" action="{{ route('articles.ajouter-au-panier', $article->id) }}" class="w-full">
                            @csrf
                            <input type="hidden" name="taille_id" x-model="selectedSizeId">
                            <input type="hidden" name="couleur_id" x-model="selectedColorId">

                            <button type="submit"
                                    class="w-full text-center bg-indigo-600 text-white py-2 rounded hover:bg-indigo-700 transition"
                                    :disabled="(!selectedSizeId && {{ $article->variantes->whereNotNull('taille_id')->count() > 0 ? 'true' : 'false' }}) || {{ $article->quantite == 0 ? 'true' : 'false' }}"
                                    :class="{
                                        'opacity-50 cursor-not-allowed': (!selectedSizeId && {{ $article->variantes->whereNotNull('taille_id')->count() > 0 ? 'true' : 'false' }}) || {{ $article->quantite == 0 ? 'true' : 'false' }},
                                        'bg-gray-500': {{ $article->quantite == 0 ? 'true' : 'false' }}
                                    }">
                                {{ $article->quantite == 0 ? 'En rupture de stock' : 'Ajouter au panier' }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $articles->links() }}
        </div>
    </main>
    <canvas id="topProductsChart" width="600" height="400" ></canvas>
      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        function appData() {
            return {
                mobileMenuOpen: false
            };
        }

        function searchComponent() {
            return {
                query: '',
                results: [],
                isSearching: false,
                async fetchResults() {
                    if (this.query.length < 2) {
                        this.results = [];
                        this.isSearching = false;
                        return;
                    }

                    this.isSearching = true;

                    try {
                        const response = await fetch(`/recherche-ajax?query=${encodeURIComponent(this.query)}`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        });

                        if (!response.ok) {
                            throw new Error('Erreur réseau');
                        }

                        const data = await response.json();
                        this.results = data;
                    } catch (error) {
                        console.error('Erreur de recherche:', error);
                        this.results = [];
                    } finally {
                        this.isSearching = false;
                    }
                }
            };
        }


        //pour le graphe 
       const labels = @json($labels);
        const data = @json($data);

        const ctx = document.getElementById('topProductsChart').getContext('2d');

        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Quantité vendue',
                    data: data,
                    backgroundColor: 'rgba(99, 102, 241, 0.7)', // Indigo 500 (plus pro)
                    borderColor: 'rgba(79, 70, 229, 1)', // Indigo 600
                    borderWidth: 1,
                    barThickness: 25, // Minceur des barres
                    maxBarThickness: 30, // Limite max
                    borderRadius: 6 // Coins arrondis
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: '#4f46e5',
                        titleColor: '#fff',
                        bodyColor: '#fff'
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 12
                            }
                        },
                        barPercentage: 0.6, // Largeur relative des barres (0.0 - 1.0)
                        categoryPercentage: 0.1 // Espace occupé par groupe (0.0 - 1.0)
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: {
                                size: 12
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>