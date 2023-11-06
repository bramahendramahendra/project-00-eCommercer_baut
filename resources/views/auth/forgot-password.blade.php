<x-app-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Forgot Password
            </h2>
        </div>
        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
            <p class="text-center text-sm leading-6 text-gray-500">
                or
                <a href="{{ route('login') }}" class="font-semibold text-baut-color-red-200 hover:text-baut-color-red-300">
                    login with existing account
                </a>
            </p>
        </div>
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div>
                    <x-input-label :value="__('Email')" for="email" />
                    <div class="mt-2">
                        <x-text-input 
                            id="email" 
                            name="email" 
                            type="email" 
                            autocomplete="email" 
                            :value="old('email')"
                            :errors="$errors"
                            required autofocus
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>   
                <div>
                    <x-primary-button>
                        {{ __('Login') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
