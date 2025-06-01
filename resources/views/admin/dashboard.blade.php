@extends('layouts.app-admin')

@section('header')
    <div class="flex justify-between items-center mt-10">
        <h2 class="text-2xl font-bold text-gray-800">
            Tableau de bord administrateur
        </h2>
        <div class="text-sm text-gray-500">
            {{ now()->format('l j F Y') }}
        </div>
    </div>
@endsection

@section('content')
    <div class="py-8 px-4 sm:px-6 lg:px-8 bg-gray-400">
        <!-- Bienvenue -->
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Bienvenue, {{ Auth::user()->prenom }} !</h1>
            <p class="text-lg text-gray-600">Gérez votre plateforme e-commerce depuis cet espace</p>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Commandes -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Commandes aujourd'hui</p>
                        <p class="text-2xl font-bold text-gray-800">24</p>
                    </div>
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="bi bi-cart-check text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-green-600 text-sm font-medium">+12% vs hier</span>
                </div>
            </div>

            <!-- Revenus -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Revenus aujourd'hui</p>
                        <p class="text-2xl font-bold text-gray-800">3,450 MAD</p>
                    </div>
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="bi bi-currency-exchange text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-green-600 text-sm font-medium">+8% vs hier</span>
                </div>
            </div>

            <!-- Produits -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Produits en stock</p>
                        <p class="text-2xl font-bold text-gray-800">156</p>
                    </div>
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="bi bi-box-seam text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-red-600 text-sm font-medium">5 produits en rupture</span>
                </div>
            </div>

            <!-- Clients -->
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nouveaux clients</p>
                        <p class="text-2xl font-bold text-gray-800">8</p>
                    </div>
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="bi bi-people text-xl"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-green-600 text-sm font-medium">+3 cette semaine</span>
                </div>
            </div>
        </div>

        <!-- Dernières commandes -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-10">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Dernières commandes</h3>
                <a href="" class="text-sm text-blue-600 hover:text-blue-800">Voir tout</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N° Commande</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#CMD-2023-001</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ahmed Benali</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aujourd'hui, 14:30</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">450 MAD</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Payé</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Voir</a>
                                <a href="#" class="text-red-600 hover:text-red-900">Annuler</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#CMD-2023-002</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Fatima Zahra</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Aujourd'hui, 12:15</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">780 MAD</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">En traitement</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Voir</a>
                                <a href="#" class="text-green-600 hover:text-green-900">Valider</a>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#CMD-2023-003</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Karim El Mansouri</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Hier, 18:45</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">1,200 MAD</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Expédié</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <a href="#" class="text-blue-600 hover:text-blue-900 mr-3">Voir</a>
                                <a href="#" class="text-gray-600 hover:text-gray-900">Suivi</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Produits populaires -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Produits populaires</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    @foreach([1, 2, 3] as $product)
                    <div class="p-4 flex items-center">
                        <img src="https://via.placeholder.com/50" alt="Product" class="w-12 h-12 rounded-md object-cover">
                        <div class="ml-4 flex-1">
                            <h4 class="text-sm font-medium text-gray-900">Nom du produit {{ $product }}</h4>
                            <p class="text-sm text-gray-500">12 ventes cette semaine</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">320 MAD</p>
                            <p class="text-xs text-green-600">+15%</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Activité récente -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Activité récente</h3>
                </div>
                <div class="divide-y divide-gray-200">
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-blue-100 text-blue-600 mr-3">
                                <i class="bi bi-person-plus"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Nouveau client enregistré</p>
                                <p class="text-xs text-gray-500">Il y a 2 heures</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-green-100 text-green-600 mr-3">
                                <i class="bi bi-cart-check"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Commande #CMD-2023-004 passée</p>
                                <p class="text-xs text-gray-500">Il y a 4 heures</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-yellow-100 text-yellow-600 mr-3">
                                <i class="bi bi-exclamation-triangle"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">Stock faible pour "Produit XYZ"</p>
                                <p class="text-xs text-gray-500">Il y a 1 jour</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection