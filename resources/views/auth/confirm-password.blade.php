<x-app-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Konfirmasi Password
            </h2>
        </div>
        <div class="mt-5 sm:mx-auto sm:w-full sm:max-w-sm">
            <p class="text-center text-sm leading-6 text-gray-500">
                Silahkan konfirmasi password anda terlebih dahulu.                
            </p>
        </div>
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <form 
                action="{{ route('password.confirm') }}" 
                method="POST"
                class="space-y-6" 
            >
                @csrf

                <div>
                    <x-input-label for="password" :value="__('Password')" />
                    <div class="mt-2">
                        <x-text-input 
                            id="password" 
                            name="password" 
                            type="password"
                            autocomplete="current-password" 
                            required 
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>
                <div>
                    <x-primary-button>
                        {{ __('Konfirmasi') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
