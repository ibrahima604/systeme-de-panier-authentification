<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-gray-900">Détails de l'utilisateur</h1>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-8 mt-6">
        <h2 class="text-xl font-semibold text-gray-700 mb-6 border-b pb-3">Informations générales</h2>

        <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-gray-700">
            <div>
                <dt class="font-medium">ID</dt>
                <dd class="mt-1">{{ $user->id }}</dd>
            </div>

            <div>
                <dt class="font-medium">Nom complet</dt>
                <dd class="mt-1">{{ $user->prenom }} {{ $user->nom }}</dd>
            </div>

            <div>
                <dt class="font-medium">Email</dt>
                <dd class="mt-1">{{ $user->email }}</dd>
            </div>

            <div>
                <dt class="font-medium">Date d'inscription</dt>
                <dd class="mt-1">{{ $user->created_at->format('d/m/Y H:i') }}</dd>
            </div>

            <div>
                <dt class="font-medium">Dernière mise à jour</dt>
                <dd class="mt-1">{{ $user->updated_at->format('d/m/Y H:i') }}</dd>
            </div>

            <div>
                <dt class="font-medium">Statut</dt>
                <dd class="mt-1">
                    @if ($user->deleted_at)
                        <span class="inline-block px-3 py-1 text-sm font-semibold text-red-700 bg-red-100 rounded-full">Désactivé</span>
                    @else
                        <span class="inline-block px-3 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded-full">Actif</span>
                    @endif
                </dd>
            </div>
        </dl>

        <div class="mt-8 flex space-x-4">
            <a href="{{ route('utilisateurs') }}"
               class="inline-flex items-center px-5 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                {{-- Icon Bootstrap "arrow-left" --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-arrow-left mr-2" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 1-.5.5H2.707l4.147 4.146a.5.5 0 0 1-.708.708l-5-5a.5.5 0 0 1 0-.708l5-5a.5.5 0 1 1 .708.708L2.707 7.5H14.5A.5.5 0 0 1 15 8z"/>
                </svg>
                Retour à la liste
            </a>

            <a href=""
               class="inline-flex items-center px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                {{-- Icon Bootstrap "pencil" --}}
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil mr-2" viewBox="0 0 16 16">
                    <path d="M12.146.854a.5.5 0 0 1 .708 0l2.292 2.292a.5.5 0 0 1 0 .708l-9.793 9.793-3.528.884a.25.25 0 0 1-.316-.316l.884-3.528L12.146.854zM11.207 2L3 10.207V13h2.793L14 4.793 11.207 2z"/>
                </svg>
                Modifier
            </a>
        </div>
    </div>
</x-admin-layout>
