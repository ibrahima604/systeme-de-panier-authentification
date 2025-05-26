<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 leading-tight text-center">
            Ajouter une variante à : {{ $article->libelle }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-md">

            @if(session('success'))
            <div class="mb-4 text-green-600 font-semibold">
                {{ session('success') }}
            </div>
            @endif

            <form action="{{ route('admin.articles.variantes.store', $article->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Couleur -->
                <div class="mb-6">
                    <label for="couleur_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Couleur
                    </label>
                    <select name="couleur_id" id="couleur_id"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                        required>
                        <option value="">-- Sélectionnez une couleur --</option>
                        @foreach($couleurs as $couleur)
                        <option value="{{ $couleur->id }}">{{ $couleur->nom }}</option>
                        @endforeach
                    </select>
                    @error('couleur_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Taille -->
                <div class="mb-6">
                    <label for="taille_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Tailles (sélection multiple possible)
                    </label>
                    <select name="taille_ids[]" id="taille_id" multiple
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                        required>
                        @foreach($tailles as $taille)
                        <option value="{{ $taille->id }}"
                            {{ (collect(old('taille_ids'))->contains($taille->id)) ? 'selected' : '' }}>
                            {{ $taille->nom }}
                        </option>
                        @endforeach
                    </select>
                    @error('taille_ids')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Quantité -->
                <div class="mb-6">
                    <label for="quantite" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Quantité
                    </label>
                    <input type="number" name="quantite" id="quantite" min="0"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                        required>
                    @error('quantite')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Image pour la couleur (optionnelle) -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Image associée à la couleur (optionnelle)
                    </label>
                    <input type="file" name="image" id="image"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                        accept="image/*">
                    @error('image')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <!-- Bouton -->
                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow transition duration-300">
                        Ajouter la variante
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>