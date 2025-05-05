<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                type="password"
                name="password"
                required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
            <!-- Boutons de réseaux sociaux -->
            <div class="mt-6">
                <div class="relative flex items-center justify-center">
                    <span class="absolute inset-x-0 h-px bg-gray-300 dark:bg-gray-700"></span>
                    <span class="bg-white dark:bg-gray-900 px-4 text-sm text-gray-500 dark:text-gray-400 z-10">
                        {{ __('Or log in with') }}
                    </span>
                </div>

                <div class="flex justify-center items-center gap-6 mt-6">
                    @foreach(\App\Enums\Provider::cases() as $provider)
                    <a href="{{ route('oauth.redirect', ['provider' => $provider->value]) }}"
                        class="p-3 rounded-full shadow-md transition hover:scale-105 hover:bg-gray-100 dark:hover:bg-gray-800">
                        @switch($provider)
                        @case(\App\Enums\Provider::GITHUB)
                        <i class="fab fa-github text-2xl text-gray-800 dark:text-gray-200"></i>
                        @break
                        @case(\App\Enums\Provider::GOOGLE)
                        <i class="fab fa-google text-2xl text-red-600"></i>
                        @break
                        @case(\App\Enums\Provider::FACEBOOK)
                        <i class="fab fa-facebook text-2xl text-blue-600"></i>
                        @break
                        @case(\App\Enums\Provider::LINKEDIN)
                        <i class="fab fa-linkedin text-2xl text-blue-700"></i>
                        @break
                        @default
                        <i class="fas fa-question-circle text-2xl text-gray-500"></i>
                        @endswitch
                    </a>
                    @endforeach
                </div>
            </div>



        </div>

    </form>
</x-guest-layout>