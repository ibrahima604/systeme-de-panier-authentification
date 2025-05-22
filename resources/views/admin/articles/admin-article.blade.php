<x-admin-layout>
    <div class="container mx-auto px-4 py-6">
        <div class="mb-10 text-center">
            <h1 class="text-4xl font-bold text-gray-800 mb-6">Gestion des articles</h1>

            <a href="{{ route('admin.articles.create') }}"
                class="inline-flex items-center px-5 py-3 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition duration-300 ease-in-out">
                <i class="bi bi-plus-circle mr-2 text-lg"></i>
                Ajouter un article
            </a>
            <a href="{{ route('articles.generate.ia') }}" class="btn btn-primary inline-flex items-center px-5 py-3 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 transition duration-300 ease-in-out">
                Générer un article IA
            </a>

        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($articles as $article)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{asset('storage/'. $article->image ) }}" alt="{{ $article->libelle }}" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">{{ $article->libelle }}</h2>
                    <p class="text-gray-700 mb-2 truncate">{{ Str::limit($article->description, 80) }}</p>
                    <p class="text-lg font-bold text-indigo-600 mb-4">{{ number_format($article->prix, 2) }} MAD</p>

                    <div class="flex justify-between gap-2">
                        <a href="{{ route('admin.articles.edit', $article->id) }}"
                            class="w-1/2 text-center bg-yellow-500 text-white py-2 px-4 rounded hover:bg-yellow-600 transition duration-200">
                            Modifier
                        </a>

                        @if (is_null($article->deleted_at))
                        <!-- Bouton de suppression -->
                        <form method="POST" action="{{ route('admin.articles.softDelete', $article->id) }}" class="w-1/2">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-full bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 transition duration-200"
                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                Supprimer
                            </button>
                        </form>
                        @else
                        <!-- Bouton de restauration -->
                        <form method="POST" action="{{ route('admin.articles.restore', $article->id) }}" class="w-1/2">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="w-full bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600 transition duration-200"
                                onclick="return confirm('Voulez-vous restaurer cet article ?');">
                                Restaurer
                            </button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </div>
</x-admin-layout>