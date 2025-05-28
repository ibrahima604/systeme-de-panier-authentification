@extends('layouts.panier-affichage')

@section('content')
<div class="container mx-auto mt-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-xl rounded-2xl p-6 sm:p-10">
        <h1 class="text-3xl font-extrabold mb-6 text-center flex items-center justify-center gap-3 text-blue-700">
            <i class="bi bi-cart text-4xl"></i>
            {{ count($panier) }} article(s) dans le panier
        </h1>

        @if(empty($panier))
        <p class="text-gray-500 text-center text-lg flex items-center justify-center gap-2">
            <i class="bi bi-cart-x text-2xl text-red-400"></i>
            Votre panier est vide.
        </p>
        @else
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-blue-100 text-blue-800 text-sm uppercase font-semibold">
                    <tr>
                        <th class="py-3 px-4 border-b">#</th>
                        <th class="py-3 px-4 border-b">Image</th>
                        <th class="py-3 px-4 border-b">Libellé</th>
                        <th class="py-3 px-4 border-b">Couleur</th>
                        <th class="py-3 px-4 border-b">Taille</th>
                        <th class="py-3 px-4 border-b">Prix unitaire</th>
                        <th class="py-3 px-4 border-b">Quantité</th>
                        <th class="py-3 px-4 border-b">Total</th>
                        <th class="py-3 px-4 border-b">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @foreach($panier as $id => $item)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="py-3 px-4">{{ $id }}</td>
                        <td class="py-3 px-4">
                            <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['libelle'] }}"
                                class="w-16 h-16 object-cover rounded-lg shadow">
                        </td>
                        <td class="py-3 px-4 font-medium">{{ $item['libelle'] }}</td>
                        <td class="py-3 px-4">
                            @if($item['couleurArticleIDS'] && count($item['couleurArticleIDS']) >= 1)
                            <form action="{{ route('panier.changerCouleur') }}" method="POST">
                                @csrf
                                <select name="nouvelle_couleur" onchange="this.form.submit()"
                                    class="w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
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
                            <span class="text-gray-600">{{ $item['couleur'] }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">
                            @if ($item['tailleArticleIDS'] && count($item['tailleArticleIDS']) >= 1)
                            <form action="{{ route('panier.changerTaille') }}" method="POST">
                                @csrf
                                <select name="nouvelle_taille" onchange="this.form.submit()"
                                    class="border-gray-300 rounded-md shadow-sm focus:ring focus:ring-blue-200">
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
                            <span class="text-gray-600">{{ $item['taille'] }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-4">{{ number_format($item['prix'], 2) }} MAD</td>
                        <td class="py-3 px-4">
                            <form action="{{ route('panier.article.update', $id) }}" method="POST" class="flex items-center gap-2 justify-center">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantite" value="{{ $item['quantite'] }}" min="1"
                                    class="w-20 border-gray-300 text-center rounded-md shadow-sm focus:ring focus:ring-blue-200">
                                <button type="submit" class="text-green-600 hover:text-green-800 text-md">
                                    <i class="bi bi-check-circle-fill"></i>
                                </button>
                            </form>
                        </td>
                        <td class="py-3 px-4 font-semibold text-blue-700">
                            {{ number_format($item['prix'] * $item['quantite'], 2) }} MAD
                        </td>
                        <td class="py-3 px-4">
                            <form action="{{ route('panier.supprimer', $id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer cet article ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-full transition shadow-sm">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-100 font-bold text-gray-800">
                    <tr>
                        <td colspan="1" class="py-3 px-4">
                            <form action="{{ route('panier.vider') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir vider le panier ?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-full shadow-md">
                                    Vider le panier
                                </button>
                            </form>
                        </td>
                        <td colspan="7" class="py-3 px-4 text-right">Total :</td>
                        <td colspan="1" class="py-3 px-4 text-blue-700 text-md font-semibold">
                            {{ number_format($total, 2) }} MAD
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('checkout.process') }}" class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg shadow-lg text-lg transition">
                <i class="bi bi-credit-card mr-2"></i> Passer à la caisse
            </a>
        </div>
        @endif
    </div>
</div>
@endsection