<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form class="h-[500px] w-[400px] px-[40px] flex flex-col items-center justify-center rounded-xl" method="POST" action="{{ route('login') }}">
        @csrf
        
        <!--Title -->
        <div class="flex flex-col justify-center items-center w-full">
            <img class="w-20 h-20" src="{{ asset('images/logo.png') }}" alt="title" />
            <h3 class="text-light-fg-primary dark:text-dark-fg-primary text-3xl font-bold mt-8">LOGIN</h3>
        </div>

        <!-- Email Address -->
        <div class="mt-4 w-full">
            <x-text-input id="email" class="block mt-1 w-full rounded-xl" 
                            placeholder="Email"
                            type="email" 
                            name="email" :value="old('email')" 
                            required autofocus autocomplete="username" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 w-full">
            <x-text-input id="password" class="block mt-1 w-full rounded-xl"
                            placeholder="Password"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex flex-row mt-4 justify-between w-full select-none">
            <label for="remember_me" class="inline-flex flex-row items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Remember Me -->
        <div class="flex mt-4 w-full justify-end">
            <label for="remember_me" class="">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Sign Up') }}</span>
            </label>
        </div>
        
    </form>
</x-guest-layout>
