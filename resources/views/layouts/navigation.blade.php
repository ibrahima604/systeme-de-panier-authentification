@php
$user = Auth::user();
$isAdmin = $user->email === config('admin.email');
@endphp

<div x-data="{ open: false }" class="bg-white shadow-sm">
    <nav class="fixed top-0 left-0 right-0 z-10 bg-white border border-gray-900 rounded-md shadow-sm h-16 flex items-center justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">

        {{-- Logo + Menu Desktop --}}
        <div class="flex items-center justify-between w-full sm:w-auto">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto" />
            </a>

            {{-- Burger menu pour mobile --}}
            <button @click="open = !open" class="sm:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-500 hover:text-gray-900 hover:bg-gray-100 focus:outline-none">
                <i x-show="!open" class="bi bi-list text-xl"></i>
                <i x-show="open" class="bi bi-x text-xl"></i>
            </button>

            {{-- Liens principaux pour desktop --}}
            <div class="hidden sm:flex sm:ml-6 sm:space-x-8">
                @if($isAdmin)
                <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    {{ __('Accueil') }}
                </x-nav-link>
                @else
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('user.dashboard')">
                    {{ __('Dashboard') }}
                </x-nav-link>
                @endif
            </div>
        </div>

        {{-- Partie droite : recherche, panier, menu utilisateur --}}
        <div class="flex items-center gap-x-6">
            @unless($isAdmin)
            {{-- Formulaire de recherche --}}
            <div class="hidden sm:flex items-center">
                <form action="{{ url('/') }}" method="GET" class="flex">
                    @csrf
                    <input
                        type="text"
                        name="query"
                        value="{{ request('query') }}"
                        placeholder="Rechercher un article..."
                        class="px-3 py-2 border border-gray-300 rounded-l-md text-sm text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md text-sm hover:bg-blue-600">
                        Rechercher
                    </button>
                </form>
            </div>

            @if(request()->path() !== 'profile')
            <x-responsive-nav-link :href="'#about'" class="hidden sm:flex">
                <i class="bi bi-info-circle mr-2"></i> {{ __('À propos') }}
            </x-responsive-nav-link>
            @endif


            {{-- Panier --}}
            <a href="{{ route('panier.index') }}" class="hidden sm:flex items-center gap-1 relative hover:text-gray-900">
                <i class="bi bi-cart-fill text-lg"></i>
                <span class="ml-1">Panier</span>
                <span class="absolute -top-2 -right-3 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                    {{ session('cart_count', 0) }}
                </span>
            </a>
            @endunless

            {{-- Menu utilisateur --}}
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 text-sm rounded-md text-gray-500 hover:text-gray-700 focus:outline-none">
                            <div>{{ $user->prenom . ' ' . $user->nom }}</div>
                            <i class="bi bi-chevron-down ml-1"></i>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            <i class="bi bi-person mr-2"></i> {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                <i class="bi bi-box-arrow-right mr-2"></i> {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </nav>

    {{-- Menu mobile --}}
    <div x-show="open" x-cloak @click.away="open = false" x-transition class="sm:hidden bg-white border-t border-gray-200 mt-2  fixed top-16 left-0 right-0 z-10 shadow-lg rounded-md">
        <div class="border-t border-gray-200 pt-4 pb-3">
            <div class="px-4 flex items-center">
                <div class="flex-shrink-0">
                    <i class="bi bi-person-circle text-2xl text-gray-400"></i>
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-gray-800">{{ $user->prenom . ' ' . $user->nom }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ $user->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <x-responsive-nav-link :href="route('profile.edit')">
                    <i class="bi bi-person mr-2"></i> {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        <i class="bi bi-box-arrow-right mr-2"></i> {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                @if($isAdmin)
                <x-responsive-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                    <i class="bi bi-house-door-fill mr-2"></i> {{ __('Accueil') }}
                </x-responsive-nav-link>
                @else
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('user.dashboard')">
                    <i class="bi bi-speedometer2 mr-2"></i> {{ __('Dashboard') }}
                </x-responsive-nav-link>
                @endif
            </div>
        </div>

        @unless($isAdmin)
        <div class="border-t border-gray-200 px-4 py-3">
            <x-responsive-nav-link :href="route('panier.index')">
                <i class="bi bi-cart-fill mr-2"></i> Panier ({{ session('cart_count', 0) }})
            </x-responsive-nav-link>
            @if(request()->path() !== 'profile')
            <x-responsive-nav-link :href="'#about'" >
                <i class="bi bi-info-circle mr-2"></i> {{ __('À propos') }}
            </x-responsive-nav-link>
            @endif
        </div>
          

        @endunless
    </div>
</div>