<x-app-layout>
    <div class="container mx-auto px-4 py-8 max-w-6xl mt-10">
        <!-- En-tête de la commande -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Commande #{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</h1>
                    <p class="text-gray-600">Passée le {{ $commande->created_at->format('d/m/Y à H\hi') }}</p>
                </div>
                <div class="mt-4 md:mt-0">
                    <span class="px-4 py-2 rounded-full text-sm font-semibold 
                        @if($commande->status === 'en cours') bg-blue-100 text-blue-800
                        @elseif($commande->status === 'expédiée') bg-purple-100 text-purple-800
                        @elseif($commande->status === 'livrée') bg-green-100 text-green-800
                        @elseif($commande->status === 'annulée') bg-red-100 text-red-800
                        @endif">
                        {{ ucfirst($commande->status) }}
                    </span>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-700 mb-2">Adresse de livraison</h3>
                    <p class="text-gray-600">{{ $commande->adresse }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-700 mb-2">Mode de paiement</h3>
                    <p class="text-gray-600">
                        {{ $commande->mode_paiement === 'carte' ? 'Carte bancaire' : 'Paiement en espèces' }}
                    </p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-700 mb-2">Total</h3>
                    <p class="text-2xl font-bold text-gray-800">{{ number_format($commande->total, 2, ',', ' ') }} MAD</p>
                </div>
            </div>
        </div>

        <!-- Détails des articles -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Détails des articles</h2>
            </div>
            
            <div class="divide-y divide-gray-200">
                @foreach($commande->lignes as $ligne)
                @php
                    $sousTotal = $ligne->quantite_commande * $ligne->prix;
                @endphp
                <div class="p-6 flex flex-col md:flex-row">
                    <div class="w-full md:w-1/6 mb-4 md:mb-0">
                        <img src="{{ asset('storage/' . $ligne->image) }}" alt="{{ $ligne->article->nom ?? 'Article' }}" 
                             class="w-full h-auto max-h-40 object-contain rounded-lg">
                    </div>
                    <div class="w-full md:w-3/6 md:px-6">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $ligne->article->libelle }}</h3>
                        @if($ligne->couleur)
                        <p class="text-gray-600 mt-1">
                            Couleur: <span class="inline-block w-4 h-4 rounded-full border border-gray-300" style="background-color: {{ $ligne->couleur }}"></span>
                            {{ $ligne->couleur }}
                        </p>
                        @endif
                        @if($ligne->taille)
                        <p class="text-gray-600">Taille: {{ $ligne->taille }}</p>
                        @endif
                    </div>
                    <div class="w-full md:w-2/6 mt-4 md:mt-0 md:text-right">
                        <p class="text-gray-600">Quantité: {{ $ligne->quantite_commande }}</p>
                        <p class="text-gray-600">Prix unitaire: {{ number_format($ligne->prix, 2, ',', ' ') }} MAD</p>
                        <p class="text-lg font-semibold mt-2">Sous-total: {{ number_format($sousTotal, 2, ',', ' ') }} MAD</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Total -->
            <div class="px-6 py-4 bg-gray-50 border-t">
                <div class="flex justify-end">
                    <div class="text-right">
                        <p class="text-gray-600">Sous-total: {{ number_format($commande->total, 2, ',', ' ') }} MAD</p>
                        <p class="text-gray-600">Livraison: 0,00 MAD</p>
                        <p class="text-xl font-bold mt-2">Total TTC: {{ number_format($commande->total, 2, ',', ' ') }} MAD</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-6 flex flex-col sm:flex-row justify-end gap-4">
            <a href="" 
               class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition">
                Retour à mes commandes
            </a>
            <button onclick="window.print()" 
                    class="px-6 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition">
                Imprimer cette commande
            </button>
        </div>
    </div>
</x-app-layout>