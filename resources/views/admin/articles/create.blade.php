<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight text-center">
            {{ __('Créer un nouvel article') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-md rounded-2xl p-8">
            <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Libellé -->
                <div class="mb-6">
                    <label for="libelle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                        Libellé de l'article
                    </label>
                    <input type="text" name="libelle" id="libelle"
                           value="{{ old('libelle') }}"
                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                           required>
                    @error('libelle')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                        Description
                    </label>
                    <textarea name="description" id="description" rows="5"
                              class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                              required>{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Prix -->
                <div class="mb-6">
                    <label for="prix" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                        Prix (MAD)
                    </label>
                    <input type="number" name="prix" id="prix" step="0.01" min="0"
                           value="{{ old('prix') }}"
                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                           required>
                    @error('prix')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <!-- quantité -->
                <div class="mb-6">
                    <label for="quantite" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                        Quantité
                    </label>
                    <input type="number" name="quantite" id="quantite" step="1" min="0"
                           value="{{ old('quantite') }}"
                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                           required>
                    @error('quantite')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                <!-- Image -->
                <div class="mb-6">
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-200">
                        Image de l'article
                    </label>
                    <input type="file" name="image" id="image"
                           class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"
                           required>
                    @error('image')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Bouton -->
                <div class="flex justify-end">
                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out">
                        Créer l'article
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
