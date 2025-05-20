@extends('layouts.panier-affichage')

@section('content')
<div class="container mx-auto py-10 px-4 max-w-7xl">
    <!-- En-tête -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
            <i class="bi bi-cart3 text-indigo-600 text-3xl"></i> Votre Panier
        </h1>
        <div class="flex items-center gap-4">
            <span class="bg-gray-100 px-4 py-1.5 rounded-full text-sm font-medium text-gray-700">
                {{ count($panier) }} article(s)
            </span>
            <a href="{{ route('panier.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 flex items-center gap-1 font-medium">
                <i class="bi bi-arrow-left"></i> Continuer mes achats
            </a>
            <a href="#" class="mt-8 w-full no-underline bg-indigo-600 hover:bg-indigo-700 text-black font-semibold py-4 px-6 rounded-lg flex items-center justify-center transition duration-300 shadow-md hover:shadow-lg">
                    <i class="bi bi-lock-fill mr-3 text-xl"></i> Valider la commande
            </a>
        </div>
    </div>

    <!-- Liste des articles -->
    <div class="bg-white rounded-xl shadow-md border border-gray-200 mb-10 divide-y divide-gray-100">
        @foreach ($panier as $id => $item)
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 p-5 hover:bg-gray-50 transition">
                <!-- Image + Détails -->
                <div class="md:col-span-6 flex items-start gap-4">
                    <div class="relative group overflow-hidden rounded border border-gray-300 w-24 h-24 flex-shrink-0">
                        <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['libelle'] }}"
                             class="w-full h-full object-cover rounded transition-transform duration-300 group-hover:scale-110">
                        <form action="" method="POST" class="absolute top-1 right-1 opacity-70 hover:opacity-100 transition">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                class="bg-white w-7 h-7 rounded-full border border-gray-200 flex items-center justify-center shadow-sm text-gray-400 hover:text-red-600 hover:shadow-md transition">
                                <i class="bi bi-x-lg text-base"></i>
                            </button>
                        </form>
                    </div>
                    <div class="flex flex-col justify-between">
                        <h3 class="font-semibold text-gray-800 text-lg">{{ $item['libelle'] }}</h3>
                        <p class="text-xs text-gray-500 mt-1">Réf: {{ $id }}</p>

                        <!-- Bloc quantité + boutons (uniquement une fois visible, responsive) -->
                        <div class="flex items-center gap-3 mt-4">
                            <form action="{{ route('panier.diminuer', ['id' => $id]) }}" method="POST">@csrf
                                <button type="submit" aria-label="Diminuer quantité" 
                                        class="text-gray-400 hover:text-indigo-600 transition text-2xl">
                                    <i class="bi bi-dash-circle"></i>
                                </button>
                            </form>
                            <span class="w-12 text-center border border-gray-300 rounded bg-white py-1 font-medium text-lg">
                                {{ $item['quantite'] }}
                            </span>
                            <form action="{{ route('panier.augmenter', ['id' => $id]) }}" method="POST">@csrf
                                <button type="submit" aria-label="Augmenter quantité" 
                                        class="text-gray-400 hover:text-indigo-600 transition text-2xl">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Prix unitaire -->
                <div class="hidden md:flex md:col-span-2 items-center justify-center">
                    <div class="text-center">
                        <span class="font-semibold text-gray-800 text-lg">{{ number_format($item['prix'], 2) }} MAD</span>
                        @if(isset($item['reduction']))
                            <span class="block text-xs text-red-500 line-through mt-1">
                                {{ number_format($item['prix_avant_reduction'], 2) }} MAD
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Total -->
                <div class="hidden md:flex md:col-span-4 items-center justify-end">
                    <span class="font-bold text-gray-800 text-lg">
                        {{ number_format($item['prix'] * $item['quantite'], 2) }} MAD
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Récapitulatif -->
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Garanties -->
        <div class="lg:w-2/3 grid grid-cols-1 sm:grid-cols-3 gap-4">
            @php
                $services = [
                    ['icon' => 'shield-check', 'title' => 'Paiement sécurisé', 'desc' => 'Cryptage SSL'],
                    ['icon' => 'truck', 'title' => 'Livraison rapide', 'desc' => 'Expédition 24/48h'],
                    ['icon' => 'arrow-repeat', 'title' => 'Retours faciles', 'desc' => 'Sous 30 jours']
                ];
            @endphp
            @foreach ($services as $service)
                <div class="bg-gray-50 p-5 rounded-lg border border-gray-100 flex items-start gap-3 hover:bg-indigo-50 transition">
                    <div class="bg-indigo-100 p-3 rounded-full text-indigo-600 text-2xl">
                        <i class="bi bi-{{ $service['icon'] }}"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-sm">{{ $service['title'] }}</h4>
                        <p class="text-xs text-gray-500">{{ $service['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Total -->
        <div class="lg:w-1/3">
            <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-lg">
                <h3 class="text-xl font-bold text-gray-800 mb-6">Récapitulatif</h3>
                <div class="space-y-4 text-sm text-gray-600">
                    <div class="flex justify-between">
                        <span>Sous-total ({{ count($panier) }} article(s))</span>
                        <span class="font-semibold">{{ number_format($total, 2) }} MAD</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Livraison</span>
                        <span class="text-green-600 font-medium">Gratuite</span>
                    </div>
                    <div class="border-t pt-4 flex justify-between font-bold text-gray-800 text-lg">
                        <span>Total TTC</span>
                        <span>{{ number_format($total, 2) }} MAD</span>
                    </div>
                </div>
                <a href="#" class="mt-8 w-full no-underline bg-indigo-600 hover:bg-indigo-700 text-black font-semibold py-4 px-6 rounded-lg flex items-center justify-center transition duration-300 shadow-md hover:shadow-lg">
                    <i class="bi bi-lock-fill mr-3 text-xl"></i> Valider la commande
                </a>
                <p class="text-xs text-gray-500 mt-4 text-center">
                    <i class="bi bi-lock-fill mr-1"></i> Paiement 100% sécurisé
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
