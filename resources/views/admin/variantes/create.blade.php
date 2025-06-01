<x-admin-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">
                Ajouter une variante pour : <span class="text-blue-600">{{ $article->libelle }}</span>
            </h2>
            <a href="{{ route('admin.articles.index') }}" 
               class="flex items-center text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">
                <i class="bi bi-arrow-left mr-1"></i> Retour à l'article
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 dark:bg-gray-900 min-h-screen">
        <div class="max-w-3xl mx-auto">
            <!-- Carte principale -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
                <!-- En-tête de la carte -->
                <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white flex items-center">
                        <i class="bi bi-plus-circle-fill text-blue-500 mr-2"></i>
                        Nouvelle variante
                    </h3>
                </div>

                <!-- Contenu du formulaire -->
                <div class="p-6">
                    @if(session('success'))
                    <div class="mb-6 px-4 py-3 bg-green-50 dark:bg-green-900 text-green-800 dark:text-green-200 rounded-lg border border-green-200 dark:border-green-700 flex items-center">
                        <i class="bi bi-check-circle-fill text-green-500 mr-2"></i>
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('admin.articles.variantes.store', $article->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Section Couleur -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <i class="bi bi-palette mr-2 text-blue-500"></i>
                                Couleur
                            </label>
                            <div class="relative">
                                <select name="couleur_id" id="couleur_id"
                                    class="block w-full pl-10 pr-3 py-3 text-base border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg bg-white dark:bg-gray-700"
                                    required>
                                    <option value="">-- Sélectionnez une couleur --</option>
                                    @foreach($couleurs as $couleur)
                                    <option value="{{ $couleur->id }}" @if(old('couleur_id') == $couleur->id) selected @endif>
                                        {{ $couleur->nom }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="bi bi-palette text-gray-400"></i>
                                </div>
                            </div>
                            @error('couleur_id')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Section Tailles -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <i class="bi bi-rulers mr-2 text-blue-500"></i>
                                Tailles disponibles
                            </label>
                            <div class="relative">
                                <select name="taille_ids[]" id="taille_id" multiple
                                    class="block w-full pl-10 pr-3 py-3 text-base border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg bg-white dark:bg-gray-700"
                                    required>
                                    @foreach($tailles as $taille)
                                    <option value="{{ $taille->id }}" @if(in_array($taille->id, old('taille_ids', []))) selected @endif>
                                        {{ $taille->nom }}
                                    </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="bi bi-rulers text-gray-400"></i>
                                </div>
                            </div>
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Maintenez Ctrl (Windows) ou Cmd (Mac) pour sélectionner plusieurs tailles
                            </p>
                            @error('taille_ids')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Section Quantité -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <i class="bi bi-box-seam mr-2 text-blue-500"></i>
                                Stock initial
                            </label>
                            <div class="relative rounded-md shadow-sm">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="bi bi-123 text-gray-400"></i>
                                </div>
                                <input type="number" name="quantite" id="quantite" min="0" value="{{ old('quantite') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-blue-500 focus:border-blue-500 bg-white dark:bg-gray-700"
                                    required>
                            </div>
                            @error('quantite')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Section Image -->
                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <i class="bi bi-image mr-2 text-blue-500"></i>
                                Image spécifique à cette couleur
                            </label>
                            
                            <!-- Aperçu de l'image -->
                            <div class="mt-1 flex items-center">
                                <div id="image-preview" class="hidden mr-4">
                                    <img id="preview" class="h-20 w-20 object-cover rounded-lg border border-gray-200 dark:border-gray-600">
                                </div>
                                <label for="image" class="cursor-pointer">
                                    <div class="flex flex-col items-center justify-center px-4 py-6 bg-white dark:bg-gray-700 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition">
                                        <i class="bi bi-cloud-arrow-up text-3xl text-gray-400 mb-2"></i>
                                        <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
                                            <span class="font-medium text-blue-600 dark:text-blue-400">Cliquez pour uploader</span><br>
                                            ou glissez-déposez une image
                                        </p>
                                        <p class="text-xs text-gray-400 mt-1">PNG, JPG (Max. 2MB)</p>
                                    </div>
                                    <input type="file" name="image" id="image" class="sr-only" accept="image/*">
                                </label>
                            </div>
                            @error('image')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400 flex items-center">
                                <i class="bi bi-exclamation-circle mr-1"></i> {{ $message }}
                            </p>
                            @enderror
                        </div>

                        <!-- Boutons d'action -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                            <button type="reset" class="px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                <i class="bi bi-arrow-counterclockwise mr-1"></i> Réinitialiser
                            </button>
                            <button type="submit" class="flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition">
                                <i class="bi bi-plus-circle mr-2"></i> Ajouter la variante
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Aperçu de l'image avant upload
        document.getElementById('image').addEventListener('change', function(e) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('image-preview');
            const file = e.target.files[0];
            
            if (file) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }
                
                reader.readAsDataURL(file);
            } else {
                previewContainer.classList.add('hidden');
            }
        });

        // Meilleure expérience pour le select multiple
        document.querySelectorAll('select[multiple]').forEach(select => {
            select.addEventListener('mousedown', (e) => {
                e.preventDefault();
                
                const option = e.target;
                if (option.tagName === 'OPTION') {
                    option.selected = !option.selected;
                }
            });
        });
    </script>
</x-admin-layout>