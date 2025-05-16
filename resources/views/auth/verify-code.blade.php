<x-guest-layout>
    <x-auth-card>
        <div class="mb-6 text-center">
            <h2 class="text-2xl font-semibold text-gray-800">Vérification du code</h2>
            <p class="mt-2 text-sm text-gray-600">
                Entrez le code que vous avez reçu par email pour finaliser votre connexion.
            </p>
        </div>

        <!-- Affichage des erreurs -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('verify.code') }}">
            @csrf

            <!-- Code -->
            <div class="mb-4">
                <x-label for="code" :value="'Code de vérification'" />
                <x-input
                    id="code"
                    class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    type="text"
                    name="code"
                    placeholder="Ex: 123456"
                    required
                    autofocus
                />
            </div>

            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
                    Retour à la connexion
                </a>

                <x-button class="ml-4">
                    Vérifier
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
