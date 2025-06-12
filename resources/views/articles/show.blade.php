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

<body class="font-sans bg-gray-50">
    <!-- Navbar -->
    @guest
    <nav class="bg-gray-900 text-white shadow fixed top-0 left-0 w-full z-50" x-data="{ mobileMenuOpen: false, accountOpen: false }">
        <!-- Votre code de navigation existant -->
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
                selectedSizeId: null,
                stockQuantity: {{ $article->quantite }},
                stockMessage: '{{ $article->quantite > 5 ? 'En stock' : ($article->quantite > 0 ? 'Stock limité' : 'Rupture de stock') }}',
                stockColor: '{{ $article->quantite > 5 ? 'green' : ($article->quantite > 0 ? 'yellow' : 'red') }}'
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
                        <button @click="
                                selectedImage = '{{ asset('storage/' . $article->image) }}';
                                stockQuantity = {{ $article->quantite }};
                                stockMessage = '{{ $article->quantite > 5 ? 'En stock' : ($article->quantite > 0 ? 'Stock limité' : 'Rupture de stock') }}';
                                stockColor = '{{ $article->quantite > 5 ? 'green' : ($article->quantite > 0 ? 'yellow' : 'red') }}';
                            "
                                :class="{'border-indigo-500': selectedImage === '{{ asset('storage/' . $article->image) }}'}"
                                class="thumbnail rounded focus:outline-none">
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Default" class="w-full h-full">
                        </button>
                        
                        @foreach($article->couleurImages as $image)
                        @php
                            // Trouver la variante correspondante à cette couleur
                            $variante = $article->variantes->where('couleur_id', $image->couleur->id)->first();
                            $quantite = $variante ? $variante->quantite : $article->quantite;
                            $message = $quantite > 5 ? 'En stock' : ($quantite > 0 ? 'Stock limité' : 'Rupture de stock');
                            $couleur = $quantite > 5 ? 'green' : ($quantite > 0 ? 'yellow' : 'red');
                        @endphp
                        <button @click="
                                selectedImage = '{{ asset('storage/' . $image->image) }}';
                                selectedColor = '{{ $image->couleur->nom }}';
                                selectedColorId = '{{ $image->couleur->id }}';
                                stockQuantity = {{ $quantite }};
                                stockMessage = '{{ $message }}';
                                stockColor = '{{ $couleur }}';
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
                    
                    <!-- Affichage du stock -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Disponibilité :</span>
                            <span class="font-medium stock-indicator"
                                  :class="{
                                      'text-green-600': stockColor === 'green',
                                      'text-yellow-600 stock-low': stockColor === 'yellow',
                                      'text-red-600': stockColor === 'red'
                                  }">
                                <template x-if="stockColor === 'green'">
                                    <i class="bi bi-check-circle-fill stock-icon"></i>
                                </template>
                                <template x-if="stockColor === 'yellow'">
                                    <i class="bi bi-exclamation-triangle-fill stock-icon"></i>
                                </template>
                                <template x-if="stockColor === 'red'">
                                    <i class="bi bi-x-circle-fill stock-icon"></i>
                                </template>
                                <span x-text="stockMessage + ' (' + stockQuantity + ' disponible(s))'"></span>
                            </span>
                        </div>
                        <!-- Barre de progression du stock -->
                        <div class="w-full bg-gray-200 rounded-full h-2 mt-1">
                            <div class="h-2 rounded-full stock-bar" 
                                 :class="{
                                     'bg-green-500': stockColor === 'green',
                                     'bg-yellow-500 stock-low': stockColor === 'yellow',
                                     'bg-red-500': stockColor === 'red'
                                 }"
                                 :style="'width: ' + Math.min(100, stockQuantity / (stockQuantity + 10) * 100) + '%'"></div>
                        </div>
                        <template x-if="stockColor === 'yellow'">
                            <p class="text-xs text-yellow-600 mt-1">Plus que <span x-text="stockQuantity"></span> disponible(s) - Commandez vite !</p>
                        </template>
                        <template x-if="stockColor === 'red'">
                            <p class="text-xs text-red-600 mt-1">Rupture de stock - Réapprovisionnement en cours</p>
                        </template>
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
                            @php
                                $quantite = $variante->quantite;
                                $couleur = $quantite > 5 ? 'green' : ($quantite > 0 ? 'yellow' : 'red');
                            @endphp
                            <button @click="
                                    selectedColor = '{{ $variante->couleur->nom }}';
                                    selectedColorId = '{{ $variante->couleur->id }}';
                                    stockQuantity = {{ $quantite }};
                                    stockMessage = '{{ $quantite > 5 ? 'En stock' : ($quantite > 0 ? 'Stock limité' : 'Rupture de stock') }}';
                                    stockColor = '{{ $couleur }}';
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
                                    <input type="number" name="quantite" value="1" min="1" max="{{ $article->quantite }}" class="w-12 text-center border-0 focus:ring-0">
                                    <button type="button" class="px-3 py-1 text-lg" onclick="if(parseInt(this.previousElementSibling.value) < {{ $article->quantite }}) this.previousElementSibling.value++;">+</button>
                                </div>
                                
                                <button type="submit"
                                        class="flex-1 px-6 py-3 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition font-semibold"
                                        :disabled="{{ $article->variantes->whereNotNull('taille_id')->count() > 0 ? '!selectedSizeId' : 'false' }} || stockQuantity <= 0"
                                        :class="{
                                            'opacity-50 cursor-not-allowed': {{ $article->variantes->whereNotNull('taille_id')->count() > 0 ? '!selectedSizeId' : 'false' }} || stockQuantity <= 0,
                                            'bg-gray-500': stockQuantity <= 0
                                        }">
                                    <span x-text="stockQuantity <= 0 ? 'Rupture de stock' : 'Ajouter au panier'"></span>
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
</body>
</html>