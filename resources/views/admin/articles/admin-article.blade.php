<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
            {{ __('Gestion des Articles') }}
        </h2>
    </x-slot>

    <div class="py-8 bg-gray-400">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- En-tête avec boutons d'action -->
            <div class="flex flex-col sm:flex-row justify-between items-center mb-8 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Catalogue des Articles</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                        {{ $articles->total() }} articles disponibles
                    </p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <a href="{{ route('admin.articles.create') }}" 
                       class="inline-flex items-center justify-center px-5 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Nouvel Article
                    </a>
                    
                    <a href="{{ route('articles.generate.ia') }}" 
                       class="inline-flex items-center justify-center px-5 py-3 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-all duration-300 shadow-lg hover:shadow-xl">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        Générer par IA
                    </a>
                </div>
            </div>

            <!-- Grille des articles -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @foreach ($articles as $article)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300 border border-gray-100 dark:border-gray-700">
                    <!-- Image avec badge de statut -->
                    <div class="relative">
                        <img src="{{ asset('storage/'. $article->image) }}" alt="{{ $article->libelle }}" 
                             class="w-full h-48 object-cover hover:scale-105 transition-transform duration-500">
                        
                        @if($article->deleted_at)
                            <span class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                Archivé
                            </span>
                        @elseif($article->quantite <= 0)
                            <span class="absolute top-2 right-2 bg-yellow-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                Rupture
                            </span>
                        @elseif($article->quantite <= 5)
                            <span class="absolute top-2 right-2 bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                                Stock faible
                            </span>
                        @endif
                    </div>

                    <!-- Contenu de la carte -->
                    <div class="p-5">
                        <div class="flex justify-between items-start mb-2">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-white truncate">
                                {{ $article->libelle }}
                            </h3>
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs font-semibold px-2.5 py-0.5 rounded">
                                {{ $article->quantite }} en stock
                            </span>
                        </div>

                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-2">
                            {{ $article->description }}
                        </p>

                        <div class="flex items-center justify-between mb-4">
                            <span class="text-xl font-bold text-indigo-600 dark:text-indigo-400">
                                {{ number_format($article->prix, 2) }} MAD
                            </span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                Ref: {{ str_pad($article->id, 5, '0', STR_PAD_LEFT) }}
                            </span>
                        </div>

                        <!-- Actions -->
                        <div class="grid grid-cols-2 gap-2">
                            <a href="{{ route('admin.articles.edit', $article->id) }}"
                               class="flex items-center justify-center px-3 py-2 bg-blue-50 dark:bg-blue-900/30 hover:bg-blue-100 dark:hover:bg-blue-900/50 text-blue-600 dark:text-blue-400 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Modifier
                            </a>

                            <a href="{{ route('admin.articles.variantes.create', $article->id) }}"
                               class="flex items-center justify-center px-3 py-2 bg-purple-50 dark:bg-purple-900/30 hover:bg-purple-100 dark:hover:bg-purple-900/50 text-purple-600 dark:text-purple-400 rounded-lg transition-colors duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6z"/>
                                </svg>
                                Variante
                            </a>
                        </div>

                        @if (is_null($article->deleted_at))
                        <form method="POST" action="{{ route('admin.articles.softDelete', $article->id) }}" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full flex items-center justify-center px-3 py-2 bg-red-50 dark:bg-red-900/30 hover:bg-red-100 dark:hover:bg-red-900/50 text-red-600 dark:text-red-400 rounded-lg transition-colors duration-200"
                                onclick="return confirm('Êtes-vous sûr de vouloir archiver cet article ?');">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Archiver
                            </button>
                        </form>
                        @else
                        <form method="POST" action="{{ route('admin.articles.restore', $article->id) }}" class="mt-2">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="w-full flex items-center justify-center px-3 py-2 bg-green-50 dark:bg-green-900/30 hover:bg-green-100 dark:hover:bg-green-900/50 text-green-600 dark:text-green-400 rounded-lg transition-colors duration-200"
                                onclick="return confirm('Voulez-vous restaurer cet article ?');">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Restaurer
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>