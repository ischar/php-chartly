<x-guest-layout>
    <form class="h-[500px] w-[400px] px-[40px] flex flex-col items-center justify-center rounded-xl relative" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="absolute top-0 left-0">
            <a href="{{ route('login') }}">
                <img class="w-8 h-8 flex filter dark:invert" src="{{ asset('images/icons/back.svg') }}" alt="back" />
            </a>
        </div>

        <!--Title -->
        <div class="flex flex-col justify-center items-center w-full">
            <h3 class="text-light-fg-primary dark:text-dark-fg-primary text-3xl font-bold mt-8">Sign Up</h3>
        </div>

        <!-- Name -->
        <div class="mt-4 w-full">
            <x-text-input id="name" placeholder="Name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4 w-full">
            <x-text-input id="email" placeholder="Email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4 w-full">
            <x-text-input id="password" class="block mt-1 w-full"
                            placeholder="Password"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4 w-full">
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            placeholder="Confirm Password"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex w-full justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
