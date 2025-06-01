<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Modification d\'article') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-400 dark:bg-gray-900">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden">
                <!-- En-tête de la carte -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                    <h1 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Modification de l'article #{{ $article->id }}
                    </h1>
                </div>

                <div class="p-6">
                    <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PATCH')

                        <!-- Section Informations -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 border-b pb-2">
                                Informations générales
                            </h3>

                            <!-- Libellé -->
                            <div>
                                <label for="libelle" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Libellé <span class="text-red-500">*</span>
                                </label>
                                <input type="text" name="libelle" id="libelle" value="{{ old('libelle', $article->libelle) }}" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">
                                @error('libelle')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    Description <span class="text-red-500">*</span>
                                </label>
                                <textarea name="description" id="description" rows="4" required
                                    class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white">{{ old('description', $article->description) }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Section Détails -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 border-b pb-2">
                                Détails techniques
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Quantité -->
                                <div>
                                    <label for="quantite" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Quantité en stock <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        </div>
                                        <input type="number" name="quantite" id="quantite" value="{{ old('quantite', $article->quantite) }}" required
                                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    @error('quantite')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Prix -->
                                <div>
                                    <label for="prix" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Prix (MAD) <span class="text-red-500">*</span>
                                    </label>
                                    <div class="mt-1 relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                                            <span class="text-gray-500">DH</span>
                                        </div>
                                        <input type="number" name="prix" id="prix" step="0.01" min="0" value="{{ old('prix', $article->prix) }}" required
                                            class="block w-full pl-12 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md dark:bg-gray-700 dark:text-white focus:border-indigo-500 focus:ring-indigo-500">
                                    </div>
                                    @error('prix')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Section Image -->
                        <div class="space-y-6">
                            <h3 class="text-lg font-medium text-gray-900 dark:text-gray-100 border-b pb-2">
                                Image de l'article
                            </h3>

                            <!-- Image actuelle -->
                            @if($article->image)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Image actuelle
                                    </label>
                                    <div class="flex items-center space-x-4">
                                        <img src="{{ asset('storage/' . $article->image) }}" alt="Image actuelle" class="h-32 w-32 object-cover rounded-lg border border-gray-200 dark:border-gray-600">
                                        <div>
                                            <button type="button" onclick="confirmDeleteImage()" class="text-sm text-red-600 hover:text-red-800">
                                                Supprimer cette image
                                            </button>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                                                Téléversez une nouvelle image pour remplacer celle-ci
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Nouvelle image -->
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                    {{ $article->image ? 'Nouvelle image' : 'Image' }}
                                </label>
                                <div class="mt-1 flex items-center">
                                    <label for="image" class="cursor-pointer">
                                        <div class="px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                            Choisir un fichier
                                        </div>
                                        <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                                    </label>
                                    <span class="ml-2 text-sm text-gray-500 dark:text-gray-400" id="file-name">
                                        Aucun fichier sélectionné
                                    </span>
                                </div>
                                <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                    Formats acceptés: JPEG, PNG, GIF. Taille maximale: 2MB.
                                </p>
                                @error('image')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                            <a href="{{ route('admin.articles.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                Retour à la liste
                            </a>
                            <div class="space-x-3">
                                <button type="reset" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm text-sm font-medium text-gray-700 dark:text-gray-200 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Réinitialiser
                                </button>
                                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                                    </svg>
                                    Enregistrer les modifications
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Formulaire caché pour la suppression d'image -->
                    @if($article->image)
                        <form id="delete-image-form" method="POST" action="" class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // Afficher le nom du fichier sélectionné
        document.getElementById('image').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Aucun fichier sélectionné';
            document.getElementById('file-name').textContent = fileName;
        });

        // Confirmation de suppression d'image
        function confirmDeleteImage() {
            if (confirm('Êtes-vous sûr de vouloir supprimer cette image ?')) {
                document.getElementById('delete-image-form').submit();
            }
        }
    </script>
</x-admin-layout>