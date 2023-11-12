<x-app-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Reset Password
            </h2>
        </div>
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <form 
                action="{{ route('password.store') }}" 
                method="POST"
                class="space-y-6" 
            >
                @csrf

                 <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <div class="mt-2">
                        <x-text-input 
                            id="email" 
                            name="email" 
                            type="email" 
                            autocomplete="email"
                            :value="old('email', $request->email)"
                            required autofocus
                        />    
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
                <div>
                    <x-input-label for="password" :value="__('Password')" />
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
                        {{ __('Reset Password') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
