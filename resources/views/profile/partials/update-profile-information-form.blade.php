<section class="max-w-3xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-md p-8">
    <header class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-8">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            {{-- Nom --}}
            <div>
                <x-input-label for="nom" :value="__('Nom')" class="block mb-2 font-medium text-gray-700 dark:text-gray-300" />
                <x-text-input 
                    id="nom" 
                    name="nom" 
                    type="text" 
                    class="block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:ring-opacity-50 transition" 
                    :value="old('nom', $user->nom)" 
                    required 
                    autofocus 
                    autocomplete="nom" 
                />
                <x-input-error class="mt-1 text-red-600 dark:text-red-400" :messages="$errors->get('nom')" />
            </div>

            {{-- Prenom --}}
            <div>
                <x-input-label for="prenom" :value="__('Prenom')" class="block mb-2 font-medium text-gray-700 dark:text-gray-300" />
                <x-text-input 
                    id="prenom" 
                    name="prenom" 
                    type="text" 
                    class="block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:ring-opacity-50 transition" 
                    :value="old('prenom', $user->prenom)" 
                    required 
                    autocomplete="prenom" 
                />
                <x-input-error class="mt-1 text-red-600 dark:text-red-400" :messages="$errors->get('prenom')" />
            </div>

            {{-- Tel --}}
            <div>
                <x-input-label for="tel" :value="__('Tel')" class="block mb-2 font-medium text-gray-700 dark:text-gray-300" />
                <x-text-input 
                    id="tel" 
                    name="tel" 
                    type="tel" 
                    class="block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:ring-opacity-50 transition" 
                    :value="old('tel', $user->tel)" 
                    required 
                    autocomplete="tel" 
                    pattern="[0-9]+" 
                    inputmode="numeric"
                />
                <x-input-error class="mt-1 text-red-600 dark:text-red-400" :messages="$errors->get('tel')" />
            </div>

            {{-- Sexe --}}
            <div>
                <x-input-label for="sexe" :value="__('Sexe')" class="block mb-2 font-medium text-gray-700 dark:text-gray-300" />
                <select 
                    id="sexe" 
                    name="sexe" 
                    class="block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:ring-opacity-50 transition"
                    required
                >
                    <option value="M" {{ old('sexe', $user->sexe) == 'M' ? 'selected' : '' }}>{{ __('Masculin') }}</option>
                    <option value="F" {{ old('sexe', $user->sexe) == 'F' ? 'selected' : '' }}>{{ __('Feminin') }}</option>
                </select>
                <x-input-error class="mt-1 text-red-600 dark:text-red-400" :messages="$errors->get('sexe')" />
            </div>
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" class="block mb-2 font-medium text-gray-700 dark:text-gray-300" />
            <x-text-input 
                id="email" 
                name="email" 
                type="email" 
                class="block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:ring-opacity-50 transition" 
                :value="old('email', $user->email)" 
                required 
                autocomplete="username" 
            />
            <x-input-error class="mt-1 text-red-600 dark:text-red-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 bg-yellow-100 dark:bg-yellow-800 border border-yellow-400 dark:border-yellow-600 text-yellow-700 dark:text-yellow-300 p-4 rounded-md">
                    <p class="text-sm">
                        {{ __('Your email address is unverified.') }}
                        <button 
                            form="send-verification" 
                            class="underline font-semibold hover:text-yellow-900 dark:hover:text-yellow-100 ml-1 focus:outline-none focus:ring-2 focus:ring-yellow-500 rounded"
                        >
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Boutons --}}
        <div class="flex items-center gap-6">
            <x-primary-button class="px-6 py-2">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2500)"
                    class="text-sm text-gray-600 dark:text-gray-400 select-none"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
