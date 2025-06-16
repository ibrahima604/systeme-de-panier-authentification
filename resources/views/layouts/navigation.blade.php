@php
    $user = Auth::user();
    $isAdmin = $user->email === config('admin.email');
@endphp

<div x-data="{ open: false, accountOpen: false }" class="bg-white shadow-sm">
    <nav class="fixed top-0 left-0 right-0 z-50 bg-gray-900 text-white shadow h-16 flex items-center">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between">

            {{-- Logo + Dashboard --}}
            <div class="flex items-center">
                <a href="{{ $isAdmin ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-2">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-8 w-auto" />
                    <span class="text-xl font-semibold hidden sm:block">Dashboard</span>
                </a>
            </div>

            {{-- Partie droite --}}
            <div class="hidden lg:flex items-center gap-6 ml-auto">
                @unless ($isAdmin)
                    @if (request()->path() !== 'profile')
                        <x-responsive-nav-link :href="route('about')"
                            class="text-white hover:text-gray-300 flex items-center gap-1">
                            <i class="bi bi-info-circle"></i> {{ __('À propos') }}
                        </x-responsive-nav-link>
                    @endif
                    {{-- Commandes --}}
                    <a href="{{ route('commandes.client', ['id' => auth()->id()]) }}"
                        class="flex items-center gap-1 text-white hover:text-gray-300">
                        <i class="bi bi-bag-check-fill text-lg"></i>
                        <span class="hidden sm:inline">Commandes</span>
                    </a>


                    {{-- Panier --}}
                    <a href="{{ route('panier.index') }}"
                        class="flex items-center gap-1 text-white hover:text-gray-300 relative">
                        <i class="bi bi-cart-fill text-lg"></i>
                        <span class="hidden sm:inline">Panier</span>
                        <span
                            class="absolute -top-2 -right-3 bg-red-600 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                            {{ session('cart_count', 0) }}
                        </span>
                    </a>
                @endunless

                {{-- Compte utilisateur --}}
                <div class="relative" x-data="{ accountOpen: false }">
                    <button @click="accountOpen = !accountOpen"
                        class="flex items-center gap-1 text-white hover:text-gray-300 focus:outline-none">
                        <i class="bi bi-person-circle text-xl"></i>
                        <span class="hidden sm:inline">{{ $user->prenom }}</span>
                        <i class="bi bi-chevron-down text-xs transition-transform duration-200"
                            :class="{ 'rotate-180': accountOpen }"></i>
                    </button>
                    <div x-show="accountOpen" @click.away="accountOpen = false" x-transition
                        class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 text-gray-800">
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center gap-2">
                            <i class="bi bi-person"></i> {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();"
                                class="flex items-center gap-2">
                                <i class="bi bi-box-arrow-right"></i> {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Burger menu mobile --}}
            <button @click="open = !open" class="lg:hidden focus:outline-none p-2" :class="{ 'burger-open': open }">
                <div class="w-6 space-y-1.5">
                    <span class="block h-0.5 w-6 bg-current transition-all duration-300"></span>
                    <span class="block h-0.5 w-6 bg-current transition-all duration-300"></span>
                    <span class="block h-0.5 w-6 bg-current transition-all duration-300"></span>
                </div>
            </button>
        </div>

        {{-- Menu mobile --}}
        <div x-show="open" x-cloak x-transition
            class="lg:hidden absolute top-16 left-0 right-0 bg-gray-800 shadow-lg rounded-b-lg overflow-hidden"
            @click.away="open = false">
            <div class="px-4 pt-2 pb-3 space-y-1">
                <x-responsive-nav-link :href="$isAdmin ? route('admin.dashboard') : route('dashboard')" class="text-white hover:bg-gray-700">
                    <i class="bi bi-house-door-fill mr-2"></i> {{ __('Dashboard') }}
                </x-responsive-nav-link>

                @unless ($isAdmin)
                    @if (request()->path() !== 'profile')
                        <x-responsive-nav-link :href="'#about'" class="text-white hover:bg-gray-700">
                            <i class="bi bi-info-circle mr-2"></i> {{ __('À propos') }}
                        </x-responsive-nav-link>
                    @endif

                    <x-responsive-nav-link :href="route('panier.index')" class="text-white hover:bg-gray-700">
                        <i class="bi bi-cart-fill mr-2"></i> Panier ({{ session('cart_count', 0) }})
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('commandes.client', ['id' => auth()->id()])" class="text-white hover:bg-gray-700">
                        <i class="bi bi-bag-check-fill mr-2"></i> Commandes
                    </x-responsive-nav-link>

                @endunless
            </div>

            {{-- Compte utilisateur mobile --}}
            <div class="border-t border-gray-700 px-4 py-3">
                <div class="flex items-center">
                    <i class="bi bi-person-circle text-2xl text-gray-300 mr-3"></i>
                    <div>
                        <div class="text-base font-medium text-white">{{ $user->prenom . ' ' . $user->nom }}</div>
                        <div class="text-sm font-medium text-gray-300">{{ $user->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-2">
                    <x-responsive-nav-link :href="route('profile.edit')" class="text-white hover:bg-gray-700">
                        <i class="bi bi-person mr-2"></i> {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                            class="text-white hover:bg-gray-700">
                            <i class="bi bi-box-arrow-right mr-2"></i> {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</div>

{{-- Style burger menu --}}
<style>
    .burger-open span:nth-child(1) {
        transform: translateY(6px) rotate(45deg);
    }

    .burger-open span:nth-child(2) {
        opacity: 0;
    }

    .burger-open span:nth-child(3) {
        transform: translateY(-6px) rotate(-45deg);
    }

    [x-cloak] {
        display: none !important;
    }
</style>
