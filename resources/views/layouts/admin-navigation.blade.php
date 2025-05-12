<nav x-data="{ open: false }" class="bg-gray-800 text-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="text-lg font-semibold">
                <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
            </div>

            <div class="flex items-center space-x-10 py-2 hidden sm:flex">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 px-3 py-2 hover:text-white hover:bg-gray-700 rounded transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 1.293a1 1 0 00-1.414 0l-8 8A1 1 0 002 10h1v7a1 1 0 001 1h5v-5h2v5h5a1 1 0 001-1v-7h1a1 1 0 00.707-1.707l-8-8z" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:text-white hover:bg-gray-700 rounded transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13 7a3 3 0 11-6 0 3 3 0 016 0zM3 14a4 4 0 014-4h6a4 4 0 014 4v1H3v-1z" />
                    </svg>
                    <span>Utilisateurs</span>
                </a>

                <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:text-white hover:bg-gray-700 rounded transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M16 6V4a2 2 0 00-2-2H6a2 2 0 00-2 2v2H2v2h1v8a2 2 0 002 2h10a2 2 0 002-2v-8h1V6h-3zM6 4h8v2H6V4z" />
                    </svg>
                    <span>Commandes</span>
                </a>

                <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:text-white hover:bg-gray-700 rounded transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M11.3 1.046a1 1 0 00-2.6 0L8.157 3H5a1 1 0 000 2h3.157l-.543 2H5a1 1 0 000 2h2.614l-.563 2H5a1 1 0 000 2h2.157l-.543 2H5a1 1 0 000 2h3.157l.543 2.046a1 1 0 001.9 0L10.843 19H14a1 1 0 000-2h-3.157l.543-2H14a1 1 0 000-2h-2.614l.563-2H14a1 1 0 000-2h-2.157l.543-2H14a1 1 0 000-2h-3.157L11.3 1.046z" />
                    </svg>
                    <span>Paramètres</span>
                </a>
                 <!-- Ajouter Article Link -->
                 <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:text-white hover:bg-gray-700 rounded transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h1a1 1 0 110 2H9v1a1 1 0 11-2 0v-1H6a1 1 0 110-2h1V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    <span>Ajouter Article</span>
                </a>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->prenom.'  ' .Auth::user()->nom }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>


    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10.707 1.293a1 1 0 00-1.414 0l-8 8A1 1 0 002 10h1v7a1 1 0 001 1h5v-5h2v5h5a1 1 0 001-1v-7h1a1 1 0 00.707-1.707l-8-8z" />
                </svg>
                <span class="ms-2">Dashboard</span>
            </a>
            <a href="#" class="flex items-center px-3 py-2 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 7a3 3 0 11-6 0 3 3 0 016 0zM3 14a4 4 0 014-4h6a4 4 0 014 4v1H3v-1z" />
                </svg>
                <span class="ms-2">Utilisateurs</span>
            </a>
            <a href="#" class="flex items-center px-3 py-2 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M16 6V4a2 2 0 00-2-2H6a2 2 0 00-2 2v2H2v2h1v8a2 2 0 002 2h10a2 2 0 002-2v-8h1V6h-3zM6 4h8v2H6V4z" />
                </svg>
                <span class="ms-2">Commandes</span>
            </a>
            <a href="#" class="flex items-center px-3 py-2 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M11.3 1.046a1 1 0 00-2.6 0L8.157 3H5a1 1 0 000 2h3.157l-.543 2H5a1 1 0 000 2h2.614l-.563 2H5a1 1 0 000 2h2.157l-.543 2H5a1 1 0 000 2h3.157l.543 2.046a1 1 0 001.9 0L10.843 19H14a1 1 0 000-2h-3.157l.543-2H14a1 1 0 000-2h-2.614l.563-2H14a1 1 0 000-2h-2.157l.543-2H14a1 1 0 000-2h-3.157L11.3 1.046z" />
                </svg>
                <span class="ms-2">Paramètres</span>
            </a>
            <!-- Ajouter Article Link in Burger Menu -->
            <a href="#" class="flex items-center px-3 py-2 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-300" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h1a1 1 0 110 2H9v1a1 1 0 11-2 0v-1H6a1 1 0 110-2h1V4a1 1 0 011-1z" clip-rule="evenodd" />
                </svg>
                <span class="ms-2">Ajouter Article</span>
            </a>
        </div>

        <!-- Responsive Settings Dropdown -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center w-full px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->prenom.' '.Auth::user()->nom }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>

</nav>