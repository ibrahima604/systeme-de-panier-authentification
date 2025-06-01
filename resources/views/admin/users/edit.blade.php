<x-admin-layout>
    <x-slot name="header">
        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white">Modifier l'utilisateur</h1>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden p-8 mt-6">
        <div class="text-center mb-8">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Modification du profil</h2>
            <p class="text-gray-600 dark:text-gray-300 mt-2">Mettez à jour les informations de l'utilisateur</p>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            <!-- Prénom -->
            <div>
                <x-input-label for="prenom" :value="__('Prénom')" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <x-text-input id="prenom" class="block w-full pl-10" type="text" name="prenom" 
                                 :value="old('prenom', $user->prenom)" required autofocus placeholder="Jean" />
                </div>
                <x-input-error :messages="$errors->get('prenom')" class="mt-2" />
            </div>

            <!-- Nom -->
            <div>
                <x-input-label for="nom" :value="__('Nom')" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <x-text-input id="nom" class="block w-full pl-10" type="text" name="nom" 
                                 :value="old('nom', $user->nom)" required placeholder="Dupont" />
                </div>
                <x-input-error :messages="$errors->get('nom')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <x-text-input id="email" class="block w-full pl-10" type="email" name="email" 
                                 :value="old('email', $user->email)" required placeholder="jean.dupont@example.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Rôle (exemple de champ supplémentaire) -->
            <div>
                <x-input-label for="role" :value="__('Rôle')" />
                <select id="role" name="role" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>Utilisateur</option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Administrateur</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Boutons d'action -->
            <div class="flex items-center justify-between mt-8">
                <a href="{{ route('admin.users.show', $user->id) }}" 
                   class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors flex items-center">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                    Retour
                </a>

                <button type="submit" 
                        class="px-5 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors flex items-center">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                    Enregistrer les modifications
                </button>
            </div>
        </form>
    </div>
</x-admin-layout>