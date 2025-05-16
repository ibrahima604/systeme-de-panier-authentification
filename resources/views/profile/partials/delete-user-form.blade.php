<section class="max-w-xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md space-y-6">
  <header>
    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
      {{ __('Delete Account') }}
    </h2>

    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
      {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
    </p>
  </header>

  <x-danger-button
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    class="inline-block px-6 py-2 bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-500 text-white rounded-md transition"
  >
    {{ __('Delete Account') }}
  </x-danger-button>

  <x-modal
    name="confirm-user-deletion"
    :show="$errors->userDeletion->isNotEmpty()"
    focusable
  >
    <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white dark:bg-gray-900 rounded-lg shadow-lg max-w-md mx-auto">
      @csrf
      @method('delete')

      <h2 class="text-xl font-semibold text-gray-900 dark:text-gray-100">
        {{ __('Are you sure you want to delete your account?') }}
      </h2>

      <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
      </p>

      <div class="mt-6">
        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

        <x-text-input
          id="password"
          name="password"
          type="password"
          class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-400 focus:border-red-500 focus:ring-2 focus:ring-red-400 dark:focus:border-red-400 dark:focus:ring-red-600 transition"
          placeholder="{{ __('Password') }}"
          autocomplete="current-password"
          required
        />

        <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-sm text-red-600 dark:text-red-400" />
      </div>

      <div class="mt-6 flex justify-end gap-3">
        <x-secondary-button
          x-on:click="$dispatch('close')"
          type="button"
          class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-md hover:bg-gray-300 dark:hover:bg-gray-600 focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 transition"
        >
          {{ __('Cancel') }}
        </x-secondary-button>

        <x-danger-button
          type="submit"
          class="px-4 py-2 bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-500 text-white rounded-md transition"
        >
          {{ __('Delete Account') }}
        </x-danger-button>
      </div>
    </form>
  </x-modal>
</section>
