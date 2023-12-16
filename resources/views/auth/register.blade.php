<x-app-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Create an account
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
            @if (session('error'))
                <div class="py-2 px-3 bg-red-500 text-white">
                    {{ session('error') }}
                </div>
            @endif
            <form 
                action="{{ route('register') }}" 
                method="POST"
                class="space-y-6" 
            >
                @csrf
                <div>
                    <x-input-label for="name" :value="__('Nama Lengkap')" />
                    <div class="mt-2">
                        <x-text-input 
                            id="name" 
                            name="name" 
                            type="text" 
                            autocomplete="name"
                            :value="old('name')"
                            required autofocus
                        />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <div class="mt-2">
                        <x-text-input 
                            id="email" 
                            name="email" 
                            type="email" 
                            autocomplete="email"
                            :value="old('email')"
                            required  
                        />    
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
                <div>
                    <x-input-label for="password" class="block text-sm font-medium leading-6 text-gray-900" :value="__('Password')" />
                    <div class="mt-2">
                        <x-text-input 
                            id="password" 
                            name="password" 
                            type="password"
                            autocomplete="new-password" 
                            required 
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>
                <div>
                    <x-input-label for=" password_confirmation" :value="__('Confirm Password')" />
                    <div class="mt-2">
                        <x-text-input 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            type="password"
                            autocomplete="new-password" 
                            required 
                        />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>
                <div>
                    <x-primary-button>
                        {{ __('Register') }}
                    </x-primary-button>
                    {{-- <button type="submit"
                        class="flex w-full justify-center rounded-md bg-baut-color-red-100 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-baut-color-red-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                        in</button> --}}
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
