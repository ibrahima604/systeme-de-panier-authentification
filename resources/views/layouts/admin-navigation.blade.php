<nav x-data="{ open: false }" class="bg-gray-800 text-white shadow">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between h-16 items-center">

      <!-- Logo / Titre -->
      <div class="text-lg font-semibold">
        <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
      </div>

      <!-- Menu principal visible sur sm+ -->
      <div class="hidden sm:flex items-center space-x-10 py-2">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 px-3 py-2 hover:text-white hover:bg-gray-700 rounded transition">
          <i class="bi bi-house-door text-gray-300"></i>
          <span>Dashboard</span>
        </a>

        <a href="{{ route('utilisateurs') }}" class="flex items-center space-x-2 px-3 py-2 hover:text-white hover:bg-gray-700 rounded transition">
          <i class="bi bi-people text-gray-300"></i>
          <span>Utilisateurs</span>
        </a>

        <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:text-white hover:bg-gray-700 rounded transition">
          <i class="bi bi-cart text-gray-300"></i>
          <span>Commandes</span>
        </a>

        <a href="#" class="flex items-center space-x-2 px-3 py-2 hover:text-white hover:bg-gray-700 rounded transition">
          <i class="bi bi-plus-square text-gray-300"></i>
          <span>Ajouter Article</span>
        </a>
      </div>

      <!-- Hamburger - visible uniquement sur petits écrans -->
      <div class="flex items-center sm:hidden">
        <button @click="open = !open" type="button"
                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <!-- Icone burger -->
          <i :class="{'hidden': open, 'block': !open }" class="bi bi-list block h-6 w-6"></i>
          <!-- Icone croix -->
          <i :class="{'block': open, 'hidden': !open }" class="bi bi-x hidden h-6 w-6"></i>
        </button>
      </div>

      <!-- Dropdown utilisateur sm+ -->
      <div class="hidden sm:flex sm:items-center sm:ms-6">
        <x-dropdown align="right" width="48">
          <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
              <div>{{ Auth::user()->prenom.'  ' .Auth::user()->nom }}</div>
              <div class="ms-1">
                <i class="bi bi-chevron-down fill-current h-4 w-4"></i>
              </div>
            </button>
          </x-slot>

          <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Log Out</x-dropdown-link>
            </form>
          </x-slot>
        </x-dropdown>
      </div>
    </div>
  </div>

  <!-- Menu responsive - visible uniquement quand open est true -->
  <div :class="open ? 'block' : 'hidden'" class="sm:hidden" id="mobile-menu">
    <div class="px-2 pt-2 pb-3 space-y-1">
      <a href="{{ route('admin.dashboard') }}" class="flex items-center px-3 py-2 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md">
        <i class="bi bi-house-door h-5 w-5 text-gray-300"></i>
        <span class="ms-2">Dashboard</span>
      </a>

      <a href="{{ route('utilisateurs') }}" class="flex items-center px-3 py-2 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md">
        <i class="bi bi-people h-5 w-5 text-gray-300"></i>
        <span class="ms-2">Utilisateurs</span>
      </a>

      <a href="#" class="flex items-center px-3 py-2 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md">
        <i class="bi bi-cart h-5 w-5 text-gray-300"></i>
        <span class="ms-2">Commandes</span>
      </a>

      <a href="#" class="flex items-center px-3 py-2 text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 rounded-md">
        <i class="bi bi-plus-square h-5 w-5 text-gray-300"></i>
        <span class="ms-2">Ajouter Article</span>
      </a>
    </div>

    <!-- Dropdown utilisateur mobile -->
    <div class="pt-4 pb-3 border-t border-gray-700">
      <div class="px-5 flex items-center">
        <div class="flex-shrink-0">
          <!-- Ici tu peux mettre l'avatar si tu veux -->
        </div>
        <div class="ml-3">
          <div class="text-base font-medium leading-none text-white">{{ Auth::user()->prenom.'  ' .Auth::user()->nom }}</div>
          <div class="text-sm font-medium leading-none text-gray-400">{{ Auth::user()->email }}</div>
        </div>
      </div>
      <div class="mt-3 px-2 space-y-1">
        <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Profile</a>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button type="submit" class="block w-full text-left px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700">Déconnexion</button>
        </form>
      </div>
    </div>
  </div>
</nav>
