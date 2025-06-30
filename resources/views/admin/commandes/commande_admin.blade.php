<x-admin-layout>
    <div class="container mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Gestion des Commandes</h1>

        {{-- Filtres --}}
        <form method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
            <select name="status" class="border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring focus:ring-blue-300">
                <option value="">-- Statut --</option>
                <option value="en attente" {{ request('status') === 'en attente' ? 'selected' : '' }}>En attente</option>
                <option value="en cours" {{ request('status') === 'en cours' ? 'selected' : '' }}>En cours</option>
                <option value="livrée" {{ request('status') === 'livrée' ? 'selected' : '' }}>Livrée</option>
            </select>

            <select name="date" class="border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring focus:ring-blue-300">
                <option value="">-- Date --</option>
                <option value="today" {{ request('date') === 'today' ? 'selected' : '' }}>Aujourd'hui</option>
                <option value="week" {{ request('date') === 'week' ? 'selected' : '' }}>Cette semaine</option>
                <option value="month" {{ request('date') === 'month' ? 'selected' : '' }}>Ce mois</option>
                <option value="year" {{ request('date') === 'year' ? 'selected' : '' }}>Cette année</option>
            </select>

            <input type="text" name="search" placeholder="Rechercher..." value="{{ request('search') }}"
                class="border border-gray-300 rounded-lg px-4 py-2 shadow-sm focus:ring focus:ring-blue-300 md:col-span-2" />

            <button type="submit"
                class="bg-blue-600 text-white rounded-lg px-6 py-2 hover:bg-blue-700 transition">Filtrer</button>
        </form>

        {{-- Statistiques --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <x-stat-card title="Commandes Aujourd'hui" :value="$stats['commandesAujourdhui']" color="indigo" />
            <x-stat-card title="Commandes en Attente" :value="$stats['commandesEnAttente']" color="yellow" />
            <x-stat-card title="Commandes en Cours" :value="$stats['commandesEnCours']" color="blue" />
            <x-stat-card title="CA du Mois" :value="number_format($stats['caMois'], 2) . ' MAD'" color="green" />
        </div>

        {{-- Liste des commandes --}}
        <div class="bg-white shadow rounded-lg overflow-x-auto">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100 text-xs uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4">#ID</th>
                        <th class="px-6 py-4">Client</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Statut</th>
                        <th class="px-6 py-4">Total</th>
                        <th class="px-6 py-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($commandes as $commande)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $commande->id }}</td>
                           <td class="px-6 py-4">
    @if ($commande->user)
        @php
            $prenom = $commande->user->prenom;
            $nom = $commande->user->nom;
        @endphp

        @if ($prenom && $nom)
            {{ $prenom }} {{ $nom }}
        @elseif ($prenom)
            {{ $prenom }}
        @elseif ($nom)
            {{ $nom }}
        @else
            <em>Nom non renseigné</em>
        @endif
    @else
        <em>Utilisateur introuvable</em>
    @endif
</td>

                            <td class="px-6 py-4">{{ $commande->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'en attente' => 'yellow',
                                        'en cours' => 'blue',
                                        'expédiée' => 'purple',
                                        'livrée' => 'green',
                                    ];
                                    $color = $statusColors[$commande->status] ?? 'gray';
                                @endphp
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-{{ $color }}-100 text-{{ $color }}-800">
                                    {{ ucfirst($commande->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-semibold">{{ number_format($commande->total, 2) }} MAD</td>
                            <td class="px-6 py-4 text-center space-x-2 flex justify-center items-center gap-3">

                                {{-- Voir --}}
                                <a href="{{ route('commandes.show', $commande->id) }}"
                                    class="text-blue-600 hover:text-blue-800" title="Voir">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8z"/>
                                        <path d="M8 5a3 3 0 1 0 0 6 3 3 0 0 0 0-6z"/>
                                    </svg>
                                </a>

                                {{-- Supprimer --}}
                                <form method="POST" action="{{ route('commandes.destroy', $commande->id) }}"
                                    onsubmit="return confirm('Supprimer cette commande ?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Supprimer">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5z"/>
                                            <path d="M8 5.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5z"/>
                                            <path d="M10.5 5.5a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0v-6a.5.5 0 0 1 .5-.5z"/>
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1 0-2h3.5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118z"/>
                                        </svg>
                                    </button>
                                </form>

                                {{-- Modifier statut --}}
                                <form method="POST" action="{{ route('commandes.updateStatus', $commande->id) }}"
                                    onsubmit="return confirm('Modifier le statut de la commande ?');" class="inline-block">
                                    @csrf
                                    @method('PATCH')

                                    <select name="status"
                                        class="border border-gray-300 rounded px-2 py-1 text-sm cursor-pointer"
                                        onchange="this.form.submit()" title="Modifier le statut">
                                        @php
                                            $statuses = ['en attente', 'en cours', 'expédiée', 'livrée'];
                                        @endphp
                                        @foreach ($statuses as $status)
                                            <option value="{{ $status }}" {{ $commande->status === $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Aucune commande trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $commandes->withQueryString()->links() }}
        </div>
    </div>
</x-admin-layout>
