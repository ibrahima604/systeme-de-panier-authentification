<section class="max-w-2xl mx-auto bg-gray-400 dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">
    <!-- Header Section -->
    <div class="text-center px-8 py-6">
        <h2 class="text-2xl font-bold text-black dark:text-white">
            {{ __('Update Password') }}
        </h2>
        <p class="mt-1 text-black dark:text-gray-300">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </div>

    <!-- Password Update Form -->
    <form method="POST" action="{{ route('password.update') }}" class="px-8 pb-8 space-y-6">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <x-input-label for="current_password" :value="__('Current Password')" class="block mb-2 font-medium text-gray-700 dark:text-gray-300" />
            <x-text-input 
                id="current_password" 
                name="current_password" 
                type="password" 
                class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-200 dark:focus:ring-indigo-600 transition"
                autocomplete="current-password" 
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <!-- New Password -->
        <div>
            <x-input-label for="password" :value="__('New Password')" class="block mb-2 font-medium text-gray-700 dark:text-gray-300" />
            <x-text-input 
                id="password" 
                name="password" 
                type="password" 
                class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-200 dark:focus:ring-indigo-600 transition"
                autocomplete="new-password" 
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="block mb-2 font-medium text-gray-700 dark:text-gray-300" />
            <x-text-input 
                id="password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-200 dark:focus:ring-indigo-600 transition"
                autocomplete="new-password" 
                placeholder="••••••••"
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-red-600 dark:text-red-400" />
        </div>

        <!-- Save Button -->
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
                {{ __('Save') }}
            </x-primary-button>
        </div>
    </form>
</section>
