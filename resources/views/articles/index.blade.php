<x-guest-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">Nos articles</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($articles as $article)
                <x-article-card :article="$article" />
            @endforeach
        </div>

        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </div>
</x-guest-layout>
