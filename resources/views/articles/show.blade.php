<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'article - {{ $article->libelle }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <style>
        .thumbnail {
            width: 60px;
            height: 60px;
            object-fit: cover;
        }
    </style>
</head>

<body class="bg-gray-100 text-gray-900">
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

    <div class="container mx-auto p-4 max-w-3xl bg-white rounded-lg shadow-md mt-20">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Image de l'article -->
            <div class="w-full md:w-1/2">
                <div class="relative">
                    <img id="main-image" src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->libelle }}" class="w-full h-auto max-h-96 object-contain rounded-md">
                    @if($article->is_new)
                    <span class="absolute top-2 left-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">Nouveau</span>
                    @endif
                    @if($article->reduction > 0)
                    <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">-{{ $article->reduction }}%</span>
                    @endif
                </div>
                <div class="flex mt-4 gap-2 overflow-x-auto pb-2">
                    <img src="{{ asset('storage/' . $article->image) }}" alt="Default" class="thumbnail rounded cursor-pointer border-2 border-transparent hover:border-indigo-500" onclick="changeImage('{{ asset('storage/' . $article->image) }}')">
                    @foreach($article->couleurImages as $image)
                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->couleur->nom }}" class="thumbnail rounded cursor-pointer border-2 border-transparent hover:border-indigo-500" onclick="changeImage('{{ asset('storage/' . $image->image) }}')">
                    @endforeach
                </div>
            </div>

            <!-- Détails de l'article -->
            <div class="w-full md:w-1/2">
                <h1 class="text-3xl font-bold mb-4">{{ $article->libelle }}</h1>
                <p class="mb-6 text-gray-700">{{ $article->description }}</p>

                <div class="mb-6">
                    <p class="text-2xl font-semibold mb-2">
                        Prix : <span id="prix">{{ number_format($article->prix, 2, ',', ' ') }}</span> {{ config('app.currency', 'MAD') }}
                    </p>
                    @if($article->reduction > 0)
                    <p class="text-red-600 font-semibold">
                        Réduction : {{ $article->reduction }}%
                    </p>
                    <p class="text-gray-500 line-through">
                        Ancien prix : {{ number_format($article->prix_avant_reduction, 2, ',', ' ') }} {{ config('app.currency', 'MAD') }}
                    </p>
                    @endif
                </div>

                <!-- Variantes de couleur -->
                @if($article->variantes->whereNotNull('couleur_id')->count() > 0)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Couleurs disponibles :</h3>
                    <div class="flex gap-2">
                        @foreach($article->variantes->whereNotNull('couleur_id')->unique('couleur_id') as $variante)
                        @php
                        $couleur = $variante->couleur;
                        $image = $article->couleurImages->where('couleur_id', $couleur->id)->first();
                        @endphp
                        <button class="w-8 h-8 rounded-full border-2 border-gray-300 hover:border-indigo-500"

                            onclick="changeColor('{{ $couleur->id }}','{{ $image ? asset('storage/' . $image->image) : asset('storage/' . $article->image) }}')"
                            title="{{ $couleur->nom }}">
                            @if($couleur->nom === 'Blanc')
                            <span class="block w-full h-full bg-white rounded-full "></span>
                            @elseif($couleur->nom === 'Noir')
                            <span class="block w-full h-full bg-black rounded-full"></span>
                            @endif

                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Variantes de taille -->
                @if($article->variantes->whereNotNull('taille_id')->count() > 0)
                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">Tailles disponibles :</h3>
                    <div class="flex gap-2 flex-wrap">
                        @foreach($article->variantes->whereNotNull('taille_id')->unique('taille_id') as $variante)
                        <button class="px-4 py-2 border rounded hover:bg-indigo-500 hover:text-white transition"
                            onclick="changeSize('{{ $variante->taille->id }}', '{{ $variante->prix }}')">
                            {{ $variante->taille->nom }}
                        </button>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Boutons d'action -->
                <div class="flex gap-4 mt-8">
                    <form method="POST" action="{{ route('articles.ajouter-au-panier', $article->id) }}" class="w-full flex flex-col gap-4 mt-8">
                        @csrf
                        <input type="hidden" name="couleur_id" id="selected-couleur-id">
                        <input type="hidden" name="taille_id" id="selected-taille-id">

                        <button type="submit" class="flex-1 px-6 py-3 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition text-center font-semibold">
                            Ajouter au panier
                        </button>
                        <a href="{{ url()->previous() }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 transition text-center font-semibold">
                            Retour
                        </a>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <x-footer />

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

        function changeImage(imageSrc) {
            document.getElementById('main-image').src = imageSrc;
        }

        let selectedColorId = null;
        let selectedTailleId = null;

        function changeColor(couleurId, imageSrc) {
            changeImage(imageSrc);
            selectedColorId = couleurId;
            document.getElementById('selected-couleur-id').value = couleurId;
        }

        function changeSize(tailleId, prix) {
            selectedTailleId = tailleId;
            document.getElementById('selected-taille-id').value = tailleId;

            if (prix) {
                document.getElementById('prix').textContent = parseFloat(prix).toFixed(2).replace('.', ',');
            }
        }
    </script>

</body>

</html>