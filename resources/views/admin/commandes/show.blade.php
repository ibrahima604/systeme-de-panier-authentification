<x-admin-layout>
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Détails de la commande #{{ $commande->id }}</h1>

        {{-- Infos client et commande --}}
        <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6 bg-white p-6 rounded-lg shadow">
            <div>
                <h2 class="text-xl font-semibold mb-3">Informations Client</h2>
                <p><span class="font-semibold">Nom :</span> {{ $commande->user->prenom }} {{ $commande->user->nom }}</p>
                <p><span class="font-semibold">Email :</span> {{ $commande->user->email }}</p>
                <p><span class="font-semibold">Date :</span> {{ $commande->created_at->format('d/m/Y H:i') }}</p>
                <p><span class="font-semibold">Statut :</span> 
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                    {{ 
                        $commande->status === 'en attente' ? 'bg-yellow-100 text-yellow-800' :
                        ($commande->status === 'en cours' ? 'bg-blue-100 text-blue-800' :
                        ($commande->status === 'livrée' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'))
                    }}">
                        {{ ucfirst($commande->status) }}
                    </span>
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold mb-3">Résumé de la commande</h2>
                <p><span class="font-semibold">Nombre d'articles :</span> {{ $commande->lignes->sum('quantite_commande') }}</p>
                <p><span class="font-semibold">Total :</span> <span class="text-green-700 font-bold text-lg">{{ number_format($commande->total, 2) }} MAD</span></p>
            </div>
        </div>

        {{-- Table des lignes de commande --}}
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full text-gray-700">
                <thead class="bg-gray-100 text-gray-600 uppercase text-sm tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">Produit</th>
                        <th class="px-6 py-3 text-left">Détails</th>
                        <th class="px-6 py-3 text-center">Quantité</th>
                        <th class="px-6 py-3 text-right">Prix Unitaire</th>
                        <th class="px-6 py-3 text-right">Sous-total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($commande->lignes as $ligne)
                        <tr class="border-t hover:bg-gray-50">
                            {{-- Image + Nom produit --}}
                            <td class="flex items-center space-x-4 px-6 py-4">
                                <img src="{{ asset('storage/' . ($ligne->image ?? $ligne->article->image ?? 'images/default-product.png')) }}" alt="{{ $ligne->article->nom ?? 'Produit' }}" class="w-16 h-16 object-cover rounded-md border" />
                                <div class="font-semibold text-gray-800">{{ $ligne->article->nom ?? 'Produit inconnu' }}</div>
                            </td>

                            {{-- Détails (taille, couleur) --}}
                            <td class="px-6 py-4">
                                @if ($ligne->taille)
                                    <div><span class="font-semibold">Taille :</span> {{ $ligne->taille }}</div>
                                @endif
                                @if ($ligne->couleur)
                                    <div><span class="font-semibold">Couleur :</span> {{ $ligne->couleur }}</div>
                                @endif
                            </td>

                            {{-- Quantité --}}
                            <td class="text-center px-6 py-4">{{ $ligne->quantite_commande }}</td>

                            {{-- Prix unitaire --}}
                            <td class="text-right px-6 py-4">{{ number_format($ligne->prix, 2) }} MAD</td>

                            {{-- Sous-total --}}
                            <td class="text-right px-6 py-4 font-semibold">{{ number_format($ligne->prix * $ligne->quantite_commande, 2) }} MAD</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Total général --}}
        <div class="mt-6 flex justify-end bg-white p-6 rounded-lg shadow">
            <div class="text-right text-xl font-bold text-gray-800">
                Total commande : <span class="text-green-700">{{ number_format($commande->total, 2) }} MAD</span>
            </div>
        </div>

        {{-- Bouton retour --}}
        <div class="mt-8">
            <a href="{{ route('admin.commandes') }}"
                class="inline-block px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                ← Retour à la liste des commandes
            </a>
        </div>
    </div>
</x-admin-layout>
