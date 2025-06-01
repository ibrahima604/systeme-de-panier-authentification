<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center mt-20">
            <h2 class="font-bold text-2xl text-gray-900 dark:text-white">
                {{ __('Tableau de bord') }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-300 hidden sm:block">
                {{ now()->format('d M Y') }}
            </p>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-400 dark:bg-gray-900 min-h-screen ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Carte de bienvenue -->
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">
                    👋 Bienvenue, {{ Auth::user()->prenom }} !
                </h3>
                <p class="text-gray-600 dark:text-gray-300">
                    {{ __("Vous êtes connecté avec succès à votre espace personnel. Accédez à vos articles, suivez vos commandes ou mettez à jour votre profil.") }}
                </p>
            </div>

            

            <!-- Composant de bienvenue (si tu l’utilises encore) -->
            <x-welcome />
        </div>
    </div>
</x-app-layout>
