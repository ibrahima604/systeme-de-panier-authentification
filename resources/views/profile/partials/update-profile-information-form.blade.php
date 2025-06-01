<section class="max-w-2xl mx-auto bg-gray-400 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
    <!-- Header Section -->
    <div class=" text-center px-8 py-6">
        <h2 class="text-2xl font-bold text-black">
            {{ __('Profile Information') }}
        </h2>
        <p class="mt-1 text-black">
            {{ __("Update your account's profile information.") }}
        </p>
    </div>

    <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" class="p-8 space-y-6">
        @csrf
        @method('patch')

        <!-- Grid Layout for Personal Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- First Name -->
            <div>
                <x-input-label for="prenom" :value="__('First Name')" class="block mb-2 font-medium text-gray-700 dark:text-gray-300" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <x-text-input 
                        id="prenom" 
                        name="prenom" 
                        type="text" 
                        class="block w-full pl-10 rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:ring-opacity-50 transition" 
                        :value="old('prenom', $user->prenom)" 
                        required 
                        autocomplete="given-name" 
                        placeholder="John"
                    />
                </div>
                <x-input-error class="mt-2 text-red-600 dark:text-red-400" :messages="$errors->get('prenom')" />
            </div>

            <!-- Last Name -->
            <div>
                <x-input-label for="nom" :value="__('Last Name')" class="block mb-2 font-medium text-gray-700 dark:text-gray-300" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <x-text-input 
                        id="nom" 
                        name="nom" 
                        type="text" 
                        class="block w-full pl-10 rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:ring-opacity-50 transition" 
                        :value="old('nom', $user->nom)" 
                        required 
                        autocomplete="family-name" 
                        placeholder="Doe"
                    />
                </div>
                <x-input-error class="mt-2 text-red-600 dark:text-red-400" :messages="$errors->get('nom')" />
            </div>

            <!-- Phone -->
            <div>
                <x-input-label for="tel" :value="__('Phone Number')" class="block mb-2 font-medium text-gray-700 dark:text-gray-300" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7 2a2 2 0 00-2 2v12a2 2 0 002 2h6a2 2 0 002-2V4a2 2 0 00-2-2H7zm3 14a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <x-text-input 
                        id="tel" 
                        name="tel" 
                        type="tel" 
                        class="block w-full pl-10 rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:ring-opacity-50 transition" 
                        :value="old('tel', $user->tel)" 
                        required 
                        autocomplete="tel" 
                        placeholder="+1234567890"
                        pattern="[0-9]+"
                        inputmode="numeric"
                    />
                </div>
                <x-input-error class="mt-2 text-red-600 dark:text-red-400" :messages="$errors->get('tel')" />
            </div>

            <!-- Gender -->
            <div>
                <x-input-label for="sexe" :value="__('Gender')" class="block mb-2 font-medium text-gray-700 dark:text-gray-300" />
                <div class="relative mt-1">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <select 
                        id="sexe" 
                        name="sexe" 
                        class="block w-full pl-10 rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:ring-opacity-50 transition appearance-none"
                        required
                    >
                        <option value="">{{ __('Select Gender') }}</option>
                        <option value="M" {{ old('sexe', $user->sexe) == 'M' ? 'selected' : '' }}>{{ __('Male') }}</option>
                        <option value="F" {{ old('sexe', $user->sexe) == 'F' ? 'selected' : '' }}>{{ __('Female') }}</option>
                        <option value="O" {{ old('sexe', $user->sexe) == 'O' ? 'selected' : '' }}>{{ __('Other') }}</option>
                    </select>
                </div>
                <x-input-error class="mt-2 text-red-600 dark:text-red-400" :messages="$errors->get('sexe')" />
            </div>
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="block mb-2 font-medium text-gray-700 dark:text-gray-300" />
            <div class="relative mt-1">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
                <x-text-input 
                    id="email" 
                    name="email" 
                    type="email" 
                    class="block w-full pl-10 rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 focus:ring-opacity-50 transition" 
                    :value="old('email', $user->email)" 
                    required 
                    autocomplete="email" 
                    placeholder="your@email.com"
                />
            </div>
            <x-input-error class="mt-2 text-red-600 dark:text-red-400" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-yellow-50 dark:bg-yellow-900 border border-yellow-200 dark:border-yellow-700 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800 dark:text-yellow-200">
                                {{ __('Your email address is unverified.') }}
                            </h3>
                            <div class="mt-2 text-sm text-yellow-700 dark:text-yellow-300">
                                <p>
                                    {{ __('Please verify your email address to access all features.') }}
                                    <button form="send-verification" class="font-medium underline text-yellow-800 dark:text-yellow-200 hover:text-yellow-900 dark:hover:text-yellow-100">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>
                            </div>
                            @if (session('status') === 'verification-link-sent')
                                <div class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-6">
            @if (session('status') === 'profile-updated')
                <div class="flex items-center text-green-600 dark:text-green-400">
                    <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                    <span x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)">
                        {{ __('Profile updated successfully!') }}
                    </span>
                </div>
            @else
                <div></div> <!-- Empty div for flex spacing -->
            @endif

            <x-primary-button class="flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                <svg class="h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                {{ __('Save Changes') }}
            </x-primary-button>
        </div>
    </form>
</section>