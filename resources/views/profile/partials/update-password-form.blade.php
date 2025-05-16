<section class="max-w-xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
  <header class="mb-6">
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
      {{ __('Update Password') }}
    </h2>
    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
      {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>
  </header>

  <form method="post" action="{{ route('password.update') }}" class="space-y-6">
    @csrf
    @method('put')

    <div>
      <x-input-label for="update_password_current_password" :value="__('Current Password')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
      <x-text-input 
        id="update_password_current_password" 
        name="current_password" 
        type="password" 
        class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 dark:focus:border-indigo-400 dark:focus:ring-indigo-600 transition" 
        autocomplete="current-password" 
        placeholder="••••••••" 
      />
      <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-sm text-red-600 dark:text-red-400" />
    </div>

    <div>
      <x-input-label for="update_password_password" :value="__('New Password')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
      <x-text-input 
        id="update_password_password" 
        name="password" 
        type="password" 
        class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 dark:focus:border-indigo-400 dark:focus:ring-indigo-600 transition" 
        autocomplete="new-password" 
        placeholder="••••••••" 
      />
      <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-sm text-red-600 dark:text-red-400" />
    </div>

    <div>
      <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="block text-sm font-medium text-gray-700 dark:text-gray-300" />
      <x-text-input 
        id="update_password_password_confirmation" 
        name="password_confirmation" 
        type="password" 
        class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-400 dark:focus:border-indigo-400 dark:focus:ring-indigo-600 transition" 
        autocomplete="new-password" 
        placeholder="••••••••" 
      />
      <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-sm text-red-600 dark:text-red-400" />
    </div>

    <div class="flex items-center gap-4">
      <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500">
        {{ __('Save') }}
      </x-primary-button>

      @if (session('status') === 'password-updated')
        <p
          x-data="{ show: true }"
          x-show="show"
          x-transition
          x-init="setTimeout(() => show = false, 3000)"
          class="text-sm text-green-600 dark:text-green-400"
        >
          {{ __('Saved.') }}
        </p>
      @endif
    </div>
  </form>
</section>
