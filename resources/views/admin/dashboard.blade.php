@extends('layouts.app-admin')

@section('header')
    <div class="flex justify-between items-center mt-9">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Tableau de bord administrateur
            </h2>
            <p class="text-sm text-gray-500 mt-1">Aperçu des performances et activités récentes</p>
        </div>
        <div class="text-sm bg-white dark:bg-gray-800 px-4 py-2 rounded-lg shadow-sm">
            <div class="font-medium text-gray-700 dark:text-gray-300">{{ now()->format('l, j F Y') }}</div>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <!-- Bienvenue -->
        <div class="mb-8 bg-gradient-to-r from-blue-600 to-blue-800 rounded-xl p-6 shadow-lg text-white">
            <h1 class="text-3xl font-bold mb-2">Bienvenue, {{ Auth::user()->prenom }} !</h1>
            <p class="text-blue-100">Voici ce qui s'est passé sur votre boutique aujourd'hui</p>
            <div class="mt-4 flex space-x-2">
                <span class="bg-blue-500 bg-opacity-30 px-3 py-1 rounded-full text-xs flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                    </svg>
                    {{ $varianteNbrCommande }}% commandes aujourd'hui
                </span>
                <span class="bg-green-500 bg-opacity-30 px-3 py-1 rounded-full text-xs flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ $variation }}% revenus
                </span>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Commandes -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 transition-all hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Commandes aujourd'hui</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $NbrCommande }}</p>
                    </div>
                    <div class="p-3 rounded-lg bg-blue-50 dark:bg-blue-900 dark:bg-opacity-20 text-blue-600 dark:text-blue-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-green-600 dark:text-green-400 text-sm font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        {{ $varianteNbrCommande }}% vs hier
                    </span>
                </div>
            </div>

            <!-- Revenus -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 transition-all hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Revenus aujourd'hui</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $revenuDuJour }} MAD</p>
                    </div>
                    <div class="p-3 rounded-lg bg-green-50 dark:bg-green-900 dark:bg-opacity-20 text-green-600 dark:text-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-green-600 dark:text-green-400 text-sm font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        {{ $variation }}% vs hier
                    </span>
                </div>
            </div>

            <!-- Produits -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 transition-all hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Produits en stock</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $stock }}</p>
                    </div>
                    <div class="p-3 rounded-lg bg-purple-50 dark:bg-purple-900 dark:bg-opacity-20 text-purple-600 dark:text-purple-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-red-600 dark:text-red-400 text-sm font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        {{ $articleEnRupture }} produits en rupture
                    </span>
                </div>
            </div>

            <!-- Clients -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-5 transition-all hover:shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Nouveaux clients</p>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white mt-1">{{ $clients }}</p>
                    </div>
                    <div class="p-3 rounded-lg bg-yellow-50 dark:bg-yellow-900 dark:bg-opacity-20 text-yellow-600 dark:text-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center">
                    <span class="text-green-600 dark:text-green-400 text-sm font-medium flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                        </svg>
                        {{ $variationClient }} cette semaine
                    </span>
                </div>
            </div>
        </div>

        <!-- Deux colonnes principales -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <!-- Dernières commandes -->
            <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Dernières commandes</h3>
                    <a href="#" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 flex items-center">
                        Voir tout
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">N° Commande</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Client</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Montant</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Statut</th>

                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($dernieresCommandes as $commande)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-white">
                                        #CMD-{{ $commande->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $commande->user->prenom }} {{ $commande->user->nom }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $commande->created_at->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                        {{ $commande->lignes->sum(function ($ligne) {
                                            return $ligne->prix * $ligne->quantite_commande;
                                        }) }} MAD
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @php
                                            $statusClasses = [
                                                'en attente' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200',
                                                'en cours' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                                'expédiée' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
                                                'livrée' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                                'annulée' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200',
                                            ];
                                        @endphp
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClasses[$commande->statut] ?? 'bg-gray-100 text-gray-800' }}">
                                            {{ ucfirst(str_replace('_', ' ', $commande->status)) }}
                                        </span>
                                    </td>
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Produits populaires -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">Produits populaires</h3>
                    <a href="{{route ('admin.commandes')}}" class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 flex items-center">
                        Voir tout
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                <div class="divide-y divide-gray-100 dark:divide-gray-700">
                    @foreach ($topProducts as $product)
                        <div class="py-4 px-6 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-12 w-12 rounded-lg overflow-hidden">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->libelle }}" class="h-full w-full object-cover">
                                </div>
                                <div class="ml-4 flex-1 min-w-0">
                                    <h4 class="text-sm font-semibold text-gray-800 dark:text-white truncate">{{ $product->libelle }}</h4>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $product->total_vendu }} ventes cette semaine</p>
                                </div>
                                <div class="ml-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                        +{{ rand(5, 30) }}%
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Activité récente -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Activité récente</h3>
            </div>
            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @foreach ($dernieresInscriptions as $client)
                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Nouveau client : {{ $client->prenom }} {{ $client->nom }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $client->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach

                @foreach ($dernieresCommandesPourActivite as $cmd)
                    <div class="p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-green-100 text-green-600 dark:bg-green-900 dark:text-green-300 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Commande #CMD-{{ $cmd->id }} par {{ $cmd->user->prenom . ' ' . $cmd->user->nom }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $cmd->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="px-6 py-3 border-t border-gray-100 dark:border-gray-700 text-center">
                <a href="#" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300">Voir toute l'activité</a>
            </div>
        </div>
    </div>
@endsection