<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Détails de l'article - {{ $article->libelle }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .thumbnail:hover, .thumbnail.active {
            border-color: #4f46e5;
            transform: scale(1.1);
        }
        .color-btn {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            transition: all 0.2s ease;
            border: 2px solid transparent;
        }
        .color-btn.active {
            border-color: #4f46e5;
            transform: scale(1.2);
        }
        .size-btn {
            transition: all 0.2s ease;
        }
        .size-btn.active {
            background-color: #4f46e5;
            color: white;
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
    </style>
</head>

<body class="font-sans bg-gray-50">
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
                        <a href="#about" class="hover:underline flex items-center gap-1">
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

    <main class="container mx-auto px-4 py-6 mt-20">
        <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md overflow-hidden">
            <div class="md:flex" x-data="{
                selectedImage: '{{ asset('storage/' . $article->image) }}',
                selectedColor: null,
                selectedColorId: null,
                selectedSize: null,
                selectedSizeId: null
            }">
                <!-- Images -->
                <div class="md:w-1/2 p-6">
                    <div class="relative h-96 flex items-center justify-center bg-gray-50 rounded-lg">
                        <img :src="selectedImage" alt="{{ $article->libelle }}" 
                             class="max-h-full max-w-full object-contain">
                        
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
                    
                    <!-- Miniatures -->
                    <div class="flex gap-3 mt-4 overflow-x-auto py-2">
                        <button @click="selectedImage = '{{ asset('storage/' . $article->image) }}'"
                                :class="{'border-indigo-500': selectedImage === '{{ asset('storage/' . $article->image) }}'}"
                                class="thumbnail rounded focus:outline-none">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Default" class="w-full h-full">
                        </button>
                        
                        @foreach($article->couleurImages as $image)
                        <button @click="
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
                </div>
                
                <!-- Détails -->
                <div class="md:w-1/2 p-6">
                    <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $article->libelle }}</h1>
                    <div class="flex items-center mb-4">
                        <div class="flex items-center text-yellow-400 mr-2">
                            <!-- Étoiles de notation (à remplacer par votre système de notation si disponible) -->
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </div>
                        <span class="text-gray-500 text-sm">(4.5)</span>
                    </div>
                    
                    <div class="mb-6">
                        <p class="text-2xl font-semibold">
                            <span x-text="'{{ number_format($article->prix, 2) }}'"></span> MAD
                        </p>
                        @if($article->reduction > 0)
                        <p class="text-gray-500 line-through">
                            {{ number_format($article->prix_avant_reduction, 2) }} MAD
                        </p>
                        <p class="text-green-600 font-medium">
                            Économisez {{ number_format($article->prix_avant_reduction - $article->prix, 2) }} MAD ({{ $article->reduction }}%)
                        </p>
                        @endif
                    </div>
                    
                    <p class="text-gray-700 mb-6">{{ $article->description }}</p>
                    
                    <!-- Sélection des couleurs -->
                    @if($article->variantes->whereNotNull('couleur_id')->count() > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-3">Couleur : <span x-text="selectedColor || 'Non sélectionné'"></span></h3>
                        <div class="flex gap-3">
                            @foreach($article->variantes->whereNotNull('couleur_id')->unique('couleur_id') as $variante)
                            <button @click="
                                    selectedColor = '{{ $variante->couleur->nom }}';
                                    selectedColorId = '{{ $variante->couleur->id }}';
                                    // Trouver l'image correspondante à cette couleur
                                    const colorImage = {{ Js::from($article->couleurImages->where('couleur_id', $variante->couleur->id)->first()) }};
                                    if (colorImage) {
                                        selectedImage = '/storage/' + colorImage.image;
                                    }
                                "
                                :class="{'active': selectedColorId === '{{ $variante->couleur->id }}'}"
                                class="color-btn focus:outline-none"
                                style="background-color: {{ $variante->couleur->nom === 'Blanc' ? '#ffffff' : ($variante->couleur->nom === 'Noir' ? '#000000' : '#cccccc') }}; border: 1px solid #ccc;"
                                title="{{ $variante->couleur->nom }}">
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Sélection des tailles -->
                    @if($article->variantes->whereNotNull('taille_id')->count() > 0)
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-3">Taille : <span x-text="selectedSize || 'Non sélectionné'"></span></h3>
                        <div class="flex gap-2 flex-wrap">
                            @foreach($article->variantes->whereNotNull('taille_id')->unique('taille_id') as $variante)
                            <button @click="
                                    selectedSize = '{{ $variante->taille->nom }}';
                                    selectedSizeId = '{{ $variante->taille->id }}';
                                "
                                :class="{'active': selectedSizeId === '{{ $variante->taille->id }}'}"
                                class="size-btn px-4 py-2 border rounded hover:bg-indigo-500 hover:text-white transition">
                                {{ $variante->taille->nom }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Quantité et boutons -->
                    <div class="mt-8">
                        <form method="POST" action="{{ route('articles.ajouter-au-panier', $article->id) }}" class="space-y-4">
                            @csrf
                            <input type="hidden" name="couleur_id" x-model="selectedColorId">
                            <input type="hidden" name="taille_id" x-model="selectedSizeId">
                            
                            <div class="flex items-center gap-4">
                                <div class="flex items-center border rounded">
                                    <button type="button" class="px-3 py-1 text-lg" onclick="if(parseInt(this.nextElementSibling.value) > 1) this.nextElementSibling.value--;">-</button>
                                    <input type="number" name="quantite" value="1" min="1" class="w-12 text-center border-0 focus:ring-0">
                                    <button type="button" class="px-3 py-1 text-lg" onclick="this.previousElementSibling.value++;">+</button>
                                </div>
                                
                                <button type="submit"
                                        class="flex-1 px-6 py-3 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition font-semibold"
                                        :disabled="{{ $article->variantes->whereNotNull('taille_id')->count() > 0 ? '!selectedSizeId' : 'false' }}"
                                        :class="{'opacity-50 cursor-not-allowed': {{ $article->variantes->whereNotNull('taille_id')->count() > 0 ? '!selectedSizeId' : 'false' }}}">
                                    Ajouter au panier
                                </button>
                            </div>
                            
                            <div class="flex gap-4">
                                <a href="{{ url()->previous() }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition text-center font-semibold">
                                    Retour
                                </a>
                            </div>
                        </form>
                    </div>
                    
                    <!-- Informations supplémentaires -->
                    <div class="mt-8 pt-6 border-t border-gray-200">
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="bi bi-truck text-xl mr-3 text-indigo-600"></i>
                                <div>
                                    <h4 class="font-semibold">Livraison rapide</h4>
                                    <p class="text-sm text-gray-600">Livraison sous 2-3 jours ouvrables</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="bi bi-arrow-left-right text-xl mr-3 text-indigo-600"></i>
                                <div>
                                    <h4 class="font-semibold">Retours faciles</h4>
                                    <p class="text-sm text-gray-600">30 jours pour changer d'avis</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <x-footer></x-footer>

    <script>
        // Fonction pour gérer la sélection des variantes
        function selectVariant(type, id, value, image = null) {
            if (type === 'color') {
                document.getElementById('selected-couleur-id').value = id;
                if (image) {
                    document.getElementById('main-image').src = image;
                }
            } else if (type === 'size') {
                document.getElementById('selected-taille-id').value = id;
                if (value) {
                    document.getElementById('prix').textContent = parseFloat(value).toFixed(2).replace('.', ',');
                }
            }
        }
    </script>
</body>
</html>