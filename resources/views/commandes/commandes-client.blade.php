@php
use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Mes Commandes - {{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .bi {
            display: inline-block;
            vertical-align: -.125em;
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-400">
    <nav class="bg-black shadow-sm border-b border-gray-200 fixed top-0 left-0 right-0 z-50 mb-10" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo - Toujours visible -->
                <a href="{{ url('dashboard') }}" class="flex items-center space-x-2 text-gray-800 hover:text-blue-600">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto" />
                    <span class="text-xl font-semibold hidden md:block text-white">Dashboard</span>
                </a>

                <!-- Menu pour mobile - Bouton hamburger -->
                <div class="md:hidden flex items-center">
                    <button @click="open = !open" class="text-white focus:outline-none">
                        <i class="bi bi-list text-2xl"></i>
                    </button>
                </div>

                <!-- Navigation Links - Caché sur mobile par défaut -->
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ route('panier.index') }}" class="flex items-center text-sm font-medium text-white hover:text-blue-600">
                        <i class="bi bi-cart3 mr-1 text-lg"></i>
                        Panier
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center text-sm font-medium text-white hover:text-blue-600">
                            <i class="bi bi-box-arrow-right mr-1 text-lg"></i>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>

            <!-- Menu mobile - Apparaît seulement quand ouvert -->
            <div x-show="open" @click.away="open = false" class="md:hidden bg-black pb-3 px-2">
                <div class="flex flex-col space-y-3">
                    <a href="{{ route('panier.index') }}" class="flex items-center text-sm font-medium text-white hover:text-blue-600 px-3 py-2">
                        <i class="bi bi-cart3 mr-3 text-lg"></i>
                        Panier
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full flex items-center text-sm font-medium text-white hover:text-blue-600 px-3 py-2">
                            <i class="bi bi-box-arrow-right mr-3 text-lg"></i>
                            Déconnexion
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 mt-8">
        <div class="flex flex-col md:flex-row gap-8">
            <!-- Sidebar -->
            <aside class="md:w-1/4 mt-6">
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="w-16 h-16 rounded-full bg-gray-200 flex items-center justify-center">
                            <i class="bi bi-person text-2xl text-gray-500"></i>
                        </div>
                        <div>
                            <h2 class="font-semibold text-lg">{{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h2>
                            <p class="text-gray-500 text-sm">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <nav>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2 px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                                    <i class="bi bi-person-gear"></i>
                                    <span>Mon profil</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('commandes.client', Auth::id()) }}" class="flex items-center space-x-2 px-3 py-2 bg-blue-50 text-blue-600 rounded-lg font-medium">
                                    <i class="bi bi-bag-check"></i>
                                    <span>Mes commandes</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>

            <!-- Main content -->
            <main class="md:w-3/4 mt-6">
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                        <h1 class="text-xl font-semibold text-gray-900">Historique de commandes</h1>
                    </div>

                    @if($commandes->isEmpty())
                        <div class="p-8 text-center">
                            <div class="mx-auto w-24 h-24 text-gray-400 mb-4">
                                <i class="bi bi-bag-x text-5xl"></i>
                            </div>
                            <h3 class="text-lg font-medium text-gray-900 mb-1">Aucune commande trouvée</h3>
                            <p class="text-gray-500 mb-6">Vous n'avez pas encore passé de commande.</p>
                            @if(!Auth::check())
                                <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition">
                                    <i class="bi bi-bag mr-2"></i> Découvrir la boutique
                                </a>
                            @else
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition">
                                    <i class="bi bi-bag mr-2"></i> Découvrir la boutique
                                </a>
                            @endif
                        </div>
                    @else
                        <div class="divide-y divide-gray-200">
                            @foreach($commandes as $commande)
                                <div class="p-6">
                                    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4">
                                        <div class="mb-4 md:mb-0">
                                            <div class="flex items-center space-x-4">
                                                <h3 class="text-lg font-medium text-gray-900">Commande #{{ $commande->id }}</h3>
                                                <span class="px-3 py-1 text-xs font-medium rounded-full 
                                                    @if($commande->status == 'livré') bg-green-100 text-green-800
                                                    @elseif($commande->status == 'annulé') bg-red-100 text-red-800
                                                    @elseif($commande->status == 'en cours') bg-yellow-100 text-yellow-800
                                                    @else bg-gray-100 text-gray-800 @endif">
                                                    {{ ucfirst($commande->status) }}
                                                </span>
                                            </div>
                                            <p class="text-sm text-gray-500 mt-1">Passée le {{ $commande->created_at->format('d/m/Y à H:i') }}</p>
                                        </div>
                                        <div class="flex items-center space-x-4">
                                            <span class="text-lg font-semibold">{{ number_format($commande->total, 2) }} MAD</span>
                                            <a href="{{ route('commandes.show', $commande->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                                Voir les détails
                                            </a>
                                        </div>
                                    </div>

                                    <div class="border border-gray-200 rounded-lg overflow-hidden mb-4">
                                        @foreach($commande->lignes as $ligne)
                                            <div class="p-4 flex items-start border-b border-gray-200 last:border-b-0">
                                                <div class="flex-shrink-0 w-20 h-20 bg-gray-200 rounded-md overflow-hidden">
                                                    @if($ligne->article->image)
                                                        <img src="{{ asset('storage/' . $ligne->article->image) }}" alt="{{ $ligne->article->nom }}" class="w-full h-full object-cover" />
                                                    @else
                                                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                            <i class="bi bi-image text-2xl"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="ml-4 flex-1">
                                                    <h4 class="text-sm font-medium text-gray-900">{{ $ligne->article->nom }}</h4>
                                                    <p class="text-sm text-gray-500 mt-1">Référence: {{ $ligne->article->id }}</p>
                                                    <div class="mt-2 flex items-center justify-between">
                                                        <span class="text-sm text-gray-900">Quantité: {{ $ligne->quantite_commande }}</span>
                                                        <span class="text-sm font-medium">{{ number_format($ligne->prix * $ligne->quantite_commande, 2) }} MAD</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
<!-- Actions de la commande -->
<div class="flex justify-end space-x-3 mt-4">
    @if($commande->status === 'en cours')
        <form method="POST" action="{{ route('commande.toggleStatus', $commande->id) }}" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette commande ?');">
            @csrf
            @method('PATCH')
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition">
                <i class="bi bi-x-circle mr-2"></i> Annuler la commande
            </button>
        </form>
    @elseif($commande->status === 'annulé')
        <form method="POST" action="{{ route('commande.toggleStatus', $commande->id) }}" onsubmit="return confirm('Voulez-vous réactiver cette commande ?');">
            @csrf
            @method('PATCH')
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg text-sm font-medium transition">
                <i class="bi bi-arrow-clockwise mr-2"></i> Réactiver la commande
            </button>
        </form>
    @endif

    <!-- Bouton Générer facture -->
    <a href="{{ route('commande.facture', $commande->id) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition">
        <i class="bi bi-file-earmark-text mr-2"></i> Facture
    </a>
</div>

                                </div>
                            @endforeach
                        </div>

                    @endif
                </div>
            </main>
        </div>
    </div>
</body>
</html>
