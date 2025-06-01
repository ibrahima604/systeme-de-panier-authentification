<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Détails de l'utilisateur</h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Informations complètes sur le profil utilisateur</p>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('utilisateurs') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Retour
                </a>
                <a href="{{ route('admin.users.edit', $user->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-lg shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Modifier
                </a>
            </div>
        </div>
    </x-slot>

    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Carte de profil -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center space-x-4">
                <div class="relative">
                    <div class="h-16 w-16 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center">
                        <svg class="h-8 w-8 text-indigo-600 dark:text-indigo-300" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    @if($user->deleted_at)
                        <span class="absolute -bottom-1 -right-1 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">INACTIF</span>
                    @else
                        <span class="absolute -bottom-1 -right-1 bg-green-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">ACTIF</span>
                    @endif
                </div>
                <div>
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $user->prenom }} {{ $user->nom }}</h2>
                    <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                </div>
            </div>
            
            <!-- Informations détaillées -->
            <div class="px-6 py-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Informations de base</h3>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">ID Utilisateur</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white font-mono">{{ $user->id }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nom complet</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->prenom }} {{ $user->nom }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->email }}</dd>
                            </div>
                        </dl>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Dates importantes</h3>
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date d'inscription</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->created_at->format('d/m/Y à H:i') }}</dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Dernière mise à jour</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->updated_at->format('d/m/Y à H:i') }}</dd>
                            </div>
                            @if($user->deleted_at)
                            <div>
                                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date de désactivation</dt>
                                <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $user->deleted_at->format('d/m/Y à H:i') }}</dd>
                            </div>
                            @endif
                        </dl>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="px-6 py-4 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600 flex justify-end space-x-3">
                @if($user->deleted_at)
                <form action="{{ route('admin.users.restore', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                        </svg>
                        Réactiver
                    </button>
                </form>
                @else
                <form action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                        Désactiver
                    </button>
                </form>
                @endif
            </div>
        </div>
        
        <!-- Section supplémentaire (optionnelle) -->
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Activité récente</h3>
            </div>
            <div class="px-6 py-4">
                <p class="text-sm text-gray-500 dark:text-gray-400">Aucune activité récente à afficher.</p>
                <!-- Ici vous pourriez ajouter un historique des actions de l'utilisateur -->
            </div>
        </div>
    </div>
</x-admin-layout>