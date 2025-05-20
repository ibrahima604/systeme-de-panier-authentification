<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier un Article') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-xl p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Modifier l'article</h1>

                <form method="POST" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div>
                        <label for="libelle" class="block text-sm font-medium text-gray-700">Libellé</label>
                        <input type="text" name="libelle" id="libelle" value="{{ $article->libelle }}" required
                            class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" rows="5" required
                            class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ $article->description }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="quantite" class="block text-sm font-medium text-gray-700">Quantité</label>
                            <input type="number" name="quantite" id="quantite" value="{{ $article->quantite }}" required
                                class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div>
                            <label for="prix" class="block text-sm font-medium text-gray-700">Prix (en MAD)</label>
                            <input type="number" name="prix" id="prix" step="0.01" value="{{ $article->prix }}" required
                                class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                    </div>

                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Image (remplacer si souhaité)</label>
                        <input type="file" name="image" id="image"
                            class="mt-1 block w-full rounded-xl border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    </div>

                    @if ($article->image)
                        <div class="mt-4">
                            <p class="text-sm text-gray-600 mb-2">Image actuelle :</p>
                            <img src="{{ asset('storage/' . $article->image) }}" alt="Image actuelle de l'article"
                                class="h-48 rounded-lg shadow border">
                        </div>
                    @endif

                    <div class="flex items-center justify-between mt-6">
                        <button type="submit"
                            class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-xl hover:bg-indigo-700 transition duration-200">
                            Enregistrer les modifications
                        </button>

                        <a href="{{ route('admin.articles.index') }}"
                            class="text-indigo-600 hover:text-indigo-800 font-semibold">← Retour à la liste</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
