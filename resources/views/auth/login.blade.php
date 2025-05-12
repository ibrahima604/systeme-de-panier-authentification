<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me and Forgot Password -->
        <div class="flex items-center justify-between mb-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
            <a class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif
        </div>

        <!-- Log in Button -->
        <div class="flex justify-center mb-6">
            <x-primary-button class="w-full sm:w-auto bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 text-white text-center justify-center">
                {{ __('Log in') }}
            </x-primary-button>

        </div>

        <!-- Or Separator -->
        <div class="relative flex items-center my-6">
            <div class="flex-grow border-t border-gray-300 dark:border-gray-700"></div>
            <span class="px-4 text-sm text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-900">
                {{ __('Or log in with') }}
            </span>
            <div class="flex-grow border-t border-gray-300 dark:border-gray-700"></div>
        </div>

        <!-- Social Buttons -->
        <div class="flex justify-center gap-6 mb-4">
            @foreach(\App\Enums\Provider::cases() as $provider)
            <a href="{{ route('oauth.redirect', ['provider' => $provider->value]) }}"
                class="p-3 rounded-full shadow-md hover:scale-105 transition dark:bg-gray-800 bg-gray-100">
                @switch($provider)
                @case(\App\Enums\Provider::GITHUB)
                <i class="fab fa-github text-2xl text-gray-800 dark:text-gray-200"></i>
                @break
                @case(\App\Enums\Provider::GOOGLE)
                <i class="fab fa-google text-3xl text-red-600"></i>
                @break
                @case(\App\Enums\Provider::LINKEDIN)
                <i class="fab fa-linkedin text-3xl text-blue-700"></i>
                @break
                @default
                <i class="fas fa-question-circle text-3xl text-gray-500"></i>
                @endswitch
            </a>
            @endforeach
        </div>
    </form>
</x-guest-layout>