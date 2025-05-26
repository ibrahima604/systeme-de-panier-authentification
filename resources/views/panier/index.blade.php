@extends('layouts.panier-affichage')

@section('content')
<div class="container mx-auto mt-10 p-6 bg-white shadow-xl rounded-lg">
    <h1 class="text-2xl font-bold mb-6 text-center flex items-center justify-center gap-3">
        <i class="bi bi-cart text-3xl text-blue-500"></i>
        {{ count($panier) }} article(s) dans le panier
    </h1>


    @if(empty($panier))
    <p class="text-gray-500 text-center text-lg flex items-center justify-center gap-2">
        <i class="bi bi-cart-x text-2xl text-red-400"></i>
        Votre panier est vide.
    </p>
    @else
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-lg overflow-hidden">
            <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="py-3 px-4 border-b"><i class="bi bi-hash"></i> ID</th>
                    <th class="py-3 px-4 border-b"><i class="bi bi-image"></i> Image</th>
                    <th class="py-3 px-4 border-b"><i class="bi bi-tag"></i> Libellé</th>
                    <th class="py-3 px-4 border-b"><i class="bi bi-palette"></i> Couleur</th> <!-- ✅ -->
                    <th class="py-3 px-4 border-b"><i class="bi bi-aspect-ratio"></i> Taille</th> <!-- ✅ -->
                    <th class="py-3 px-4 border-b"><i class="bi bi-currency-dollar"></i> Prix unitaire</th>
                    <th class="py-3 px-4 border-b"><i class="bi bi-plus-slash-minus"></i> Quantité</th>
                    <th class="py-3 px-4 border-b"><i class="bi bi-cash-coin"></i> Total</th>
                    <th class="py-3 px-4 border-b"><i class="bi bi-tools"></i> Actions</th>
                </tr>
            </thead>

            <tbody class="text-gray-700">
                @foreach($panier as $id => $item)
                <tr class="hover:bg-gray-50 transition">
                    <td class="py-3 px-4 border-b">{{ $id }}</td>
                    <td class="py-3 px-4 border-b">
                        <img src="{{ asset('storage/' . $item['image']) }}"
                            alt="{{ $item['libelle'] }}"
                            class="w-16 h-16 object-cover mx-auto rounded-full shadow-md">
                    </td>
                    <td class="py-3 px-4 border-b">{{ $item['libelle'] }}</td>
                    <td class="py-3 px-4 border-b">{{ $item['couleur'] ?? 'N/A' }}</td> <!-- ✅ Affiche couleur -->
                    <td class="py-3 px-4 border-b">{{ $item['taille'] ?? 'N/A' }}</td> <!-- ✅ Affiche taille -->
                    <td class="py-3 px-4 border-b">{{ number_format($item['prix'], 2) }} MAD</td>
                    <td class="py-3 px-4 border-b">
                        <form action="{{ route('panier.article.update',$id) }}" method="post" class="flex items-center gap-2 justify-center">
                            @csrf
                            @method('PATCH')
                            <input type="number" name="quantite" value="{{ $item['quantite'] }}" min="1"
                                class="w-16 text-center border border-gray-300 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-300">
                            <button type="submit" class="text-green-600 hover:text-green-800 text-lg">
                                <i class="bi bi-check-circle-fill"></i>
                            </button>
                        </form>
                    </td>
                    <td class="py-3 px-4 border-b">{{ number_format($item['prix'] * $item['quantite'], 2) }} MAD</td>
                    <td class="py-3 px-4 border-b">
                        <form action="{{ route('panier.supprimer',$id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-full shadow-sm transition">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
            <tfoot>
                <tr class="bg-gray-100 font-bold">
                    <td colspan="1" class="py-3 px-4 text-right">
                        <form action="{{ route('panier.vider') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir vider le panier ?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-full shadow-sm transition">
                                Vider le panier
                            </button>
                        </form>
                    </td>
                    <td colspan="7" class="py-3 px-4 text-right">Total :</td>
                    <td colspan="2" class="py-3 px-4 text-blue-600">{{ number_format($total, 2) }} MAD</td>

                </tr>
            </tfoot>
        </table>
    </div>

    <div class="mt-6 text-center">
        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow-md transition text-lg">
            <i class="bi bi-credit-card mr-2"></i> Passer à la caisse
        </a>
    </div>
    @endif
</div>
@endsection