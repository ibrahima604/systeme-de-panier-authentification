@php use Illuminate\Support\Facades\Auth; @endphp
@extends('layouts.panier-affichage')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-7xl mx-auto">
        <!-- Breadcrumbs -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                @if(!auth::check())
                <li class="inline-flex items-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                        <i class="bi bi-house-door mr-2"></i>
                        Accueil
                    </a>
                </li>
                @else
                 <li class="inline-flex items-center">
                    <a href="{{route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                        <i class="bi bi-house-door mr-2"></i>
                        Dashboard
                    </a>
                </li>
                @endif
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="bi bi-chevron-right text-gray-400 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">Panier</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="bg-white shadow-xl rounded-xl overflow-hidden">
            <!-- Header du panier -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-4 text-white">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold flex items-center gap-3">
                        <i class="bi bi-cart3 text-3xl"></i>
                        Votre Panier ({{ count($panier) }})
                    </h1>
                    <div class="flex items-center">
                        <span class="text-blue-100 mr-2">Total:</span>
                        <span class="text-xl font-bold">{{ number_format($total, 2) }} MAD</span>
                    </div>
                </div>
            </div>

            @if(empty($panier))
            <!-- Panier vide -->
            <div class="p-12 text-center">
                <div class="mx-auto w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                    <i class="bi bi-cart-x text-4xl text-blue-500"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800 mb-2">Votre panier est vide</h2>
                <p class="text-gray-500 mb-6">Parcourez nos produits et ajoutez des articles à votre panier</p>
                <a href="{{ url('/') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow-md transition">
                    <i class="bi bi-bag mr-2"></i> Découvrir la boutique
                </a>
            </div>
            @else
            <!-- Liste des articles -->
            <div class="divide-y divide-gray-200">
                @foreach($panier as $id => $item)
                <div class="p-6 flex flex-col md:flex-row gap-6 hover:bg-gray-50 transition">
                    <!-- Image du produit -->
                    <div class="w-full md:w-1/5 lg:w-1/6">
                        <div class="aspect-w-1 aspect-h-1 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['libelle'] }}"
                                class="w-full h-full object-cover object-center">
                        </div>
                    </div>
                    
                    <!-- Détails du produit -->
                    <div class="flex-1">
                        <div class="flex justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">{{ $item['libelle'] }}</h3>
                                <p class="text-blue-600 font-medium mt-1">{{ number_format($item['prix'], 2) }} MAD</p>
                            </div>
                            <form action="{{ route('panier.supprimer', $id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Supprimer">
                                    <i class="bi bi-x-lg text-xl"></i>
                                </button>
                            </form>
                        </div>

                        <!-- Variantes (couleur/taille) -->
                        <div class="mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Sélecteur de couleur -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Couleur</label>
                                @if($item['couleurArticleIDS'] && count($item['couleurArticleIDS']) >= 1)
                                <form action="{{ route('panier.changerCouleur') }}" method="POST">
                                    @csrf
                                    <select name="nouvelle_couleur" onchange="this.form.submit()"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                        <option disabled selected>{{ $item['couleur'] }}</option>
                                        @foreach($item['couleurArticle'] as $index => $couleur)
                                        <option value="{{ $item['couleurArticleIDS'][$index] }}">{{ $couleur }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="taille_id" value="{{ $item['taille_id'] }}">
                                    <input type="hidden" name="article_id" value="{{ $item['article_id'] }}">
                                    <input type="hidden" name="old_key" value="{{ $id }}">
                                </form>
                                @else
                                <div class="text-sm text-gray-600">{{ $item['couleur'] }}</div>
                                @endif
                            </div>

                            <!-- Sélecteur de taille -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Taille</label>
                                @if ($item['tailleArticleIDS'] && count($item['tailleArticleIDS']) >= 1)
                                <form action="{{ route('panier.changerTaille') }}" method="POST">
                                    @csrf
                                    <select name="nouvelle_taille" onchange="this.form.submit()"
                                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-sm">
                                        <option disabled selected>{{ $item['taille'] }}</option>
                                        @foreach($item['tailleArticle'] as $index => $taille)
                                        <option value="{{ $item['tailleArticleIDS'][$index] }}">{{ $taille }}</option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" name="couleur_id" value="{{ $item['couleur_id'] }}">
                                    <input type="hidden" name="article_id" value="{{ $item['article_id'] }}">
                                    <input type="hidden" name="old_key" value="{{ $id }}">
                                </form>
                                @else
                                <div class="text-sm text-gray-600">{{ $item['taille'] }}</div>
                                @endif
                            </div>
                        </div>

                        <!-- Quantité et sous-total -->
                        <div class="mt-6 flex flex-wrap items-center justify-between gap-4">
                            <form action="{{ route('panier.article.update', $id) }}" method="POST" class="flex items-center">
                                @csrf
                                @method('PATCH')
                                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown(); this.parentNode.submit()" 
                                    class="w-10 h-10 border border-gray-300 rounded-l-md flex items-center justify-center text-gray-500 hover:bg-gray-100 transition">
                                    <i class="bi bi-dash-lg"></i>
                                </button>
                                <input type="number" name="quantite" value="{{ $item['quantite'] }}" min="1"
                                    class="w-16 h-10 border-t border-b border-gray-300 text-center focus:outline-none focus:ring-1 focus:ring-blue-500">
                                <button type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp(); this.parentNode.submit()" 
                                    class="w-10 h-10 border border-gray-300 rounded-r-md flex items-center justify-center text-gray-500 hover:bg-gray-100 transition">
                                    <i class="bi bi-plus-lg"></i>
                                </button>
                            </form>

                            <div class="text-lg font-semibold text-gray-800">
                                {{ number_format($item['prix'] * $item['quantite'], 2) }} MAD
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Résumé et actions -->
            <div class="p-6 bg-gray-50 border-t border-gray-200">
                <div class="flex flex-col md:flex-row justify-between gap-6">
                    <!-- Code promo -->
                    <div class="flex-1 max-w-md">
                        <h3 class="text-lg font-medium text-gray-800 mb-3">Code promo</h3>
                        <div class="flex">
                            <input type="text" placeholder="Entrez votre code" 
                                class="flex-1 rounded-l-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 px-4 py-2">
                            <button class="bg-gray-800 text-white px-4 py-2 rounded-r-md hover:bg-gray-700 transition">
                                Appliquer
                            </button>
                        </div>
                    </div>

                    <!-- Résumé de commande -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 w-full md:w-1/3">
                        <h3 class="text-lg font-medium text-gray-800 mb-4">Résumé de la commande</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Sous-total</span>
                                <span class="font-medium">{{ number_format($total, 2) }} MAD</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Livraison</span>
                                <span class="font-medium">-</span>
                            </div>
                            <div class="flex justify-between border-t border-gray-200 pt-3 mt-3">
                                <span class="text-lg font-semibold">Total</span>
                                <span class="text-lg font-bold text-blue-600">{{ number_format($total, 2) }} MAD</span>
                            </div>
                        </div>

                        <div class="mt-6 space-y-3">
                            <a href="{{ route('checkout.process') }}" 
                               class="block w-full bg-blue-600 hover:bg-blue-700 text-white text-center py-3 px-4 rounded-lg shadow-md transition font-medium">
                                Passer la commande
                            </a>
                            @if(!auth::check())
                            <a href="{{url('/')}}" 
                               class="block w-full border border-gray-300 text-gray-700 text-center py-3 px-4 rounded-lg hover:bg-gray-50 transition font-medium">
                                Continuer mes achats
                            </a>
                            @else
                            <a href="{{route('dashboard')}}" 
                               class="block w-full border border-gray-300 text-gray-700 text-center py-3 px-4 rounded-lg hover:bg-gray-50 transition font-medium">
                                Continuer mes achats
                            </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection