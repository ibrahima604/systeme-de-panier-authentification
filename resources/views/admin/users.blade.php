<x-admin-layout>
    <x-slot name="header" >
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800">Gestion des utilisateurs</h1>
            <a href="" class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                <i class="bi bi-plus-circle mr-2"></i> Nouvel utilisateur
            </a>
        </div>
    </x-slot>

    <div class="overflow-x-auto rounded-lg border border-gray-200 shadow-sm bg-gray-400 ">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom complet</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Inscription</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($users as $user)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $user->id }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                        {{ $user->prenom }} {{ $user->nom }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $user->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $user->created_at->format('d/m/Y H:i') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">

                            @if (is_null($user->deleted_at))
                            <form action="{{ route('admin.users.softDelete', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 rounded-md hover:bg-red-200 transition"
                                    onclick="return confirm('Voulez-vous désactiver cet utilisateur ?')"
                                    title="Désactiver">
                                    <i class="bi bi-person-x mr-1"></i> Désactiver
                                </button>
                            </form>
                            @else
                            <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-md hover:bg-green-200 transition"
                                    onclick="return confirm('Voulez-vous activer cet utilisateur ?')"
                                    title="Activer">
                                    <i class="bi bi-person-check mr-1"></i> Activer
                                </button>
                            </form>
                            @endif



                            <!-- Autres actions comme modifier, voir détails, etc. -->
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 rounded-md hover:bg-blue-200 transition"
                                title="Modifier">
                                <i class="bi bi-pencil-square mr-1"></i> Modifier
                            </a>


                            <a href="{{ route('admin.users.show', $user->id)}}"
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-md hover:bg-gray-200 transition"
                                title="Voir les détails">
                                <i class="bi bi-eye mr-1"></i> Détails
                            </a>´


                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        <i class="bi bi-exclamation-circle mr-2"></i> Aucun utilisateur trouvé
                    </td>
                </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    @if($users->hasPages())
    <div class="mt-6 px-4 py-3 bg-white border-t border-gray-200 sm:px-6 rounded-b-lg">
        {{ $users->links() }}
    </div>
    @endif
    <div></div>

</x-admin-layout>