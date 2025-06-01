<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-900 dark:text-white">
                {{ __('Tableau de bord') }}
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-300 hidden sm:block">
                {{ now()->format('d M Y') }}
            </p>
        </div>
    </x-slot>

    <div class="py-10 bg-gray-100 dark:bg-gray-900 min-h-screen">
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

            <!-- Widget de contenu personnalisé -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Exemples de widgets -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">🛍️ Mes commandes</h4>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Consultez l’historique de vos achats et suivez vos livraisons en temps réel.</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">🧾 Factures</h4>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Téléchargez vos factures ou consultez les détails de vos paiements.</p>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-5">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">⚙️ Paramètres</h4>
                    <p class="text-gray-600 dark:text-gray-300 text-sm">Gérez votre profil, vos préférences et la sécurité de votre compte.</p>
                </div>
            </div>

            <!-- Composant de bienvenue (si tu l’utilises encore) -->
            <x-welcome />
        </div>
    </div>
</x-app-layout>
