<x-guest-layout>
    <x-auth-card>
        
        <div class="mb-4 text-sm text-gray-600">
            Veuillez entrer le code que vous avez reçu par email pour finaliser la connexion.
        </div>

        <!-- Affichage des erreurs -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('verify.code') }}">
            @csrf

            <!-- Code -->
            <div>
                <x-label for="code" :value="'Code de vérification'" />
                <x-input id="code" class="block mt-1 w-full" type="text" name="code" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    Vérifier
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
