<x-app-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Sign in to your account
            </h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div>
                    <x-input-label :value="__('Email')" for="email" />
                    <div class="mt-2">
                        <x-text-input id="email" name="email" type="email" autocomplete="email" required :value="old('email')"
                            class="block w-full"/>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <x-input-label :value="__('Password')" for="password" />
                    </div>
                    <div class="mt-2">
                        <x-text-input id="password" name="password" type="password" autocomplete="current-password" required
                            class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-baut-color-red-200 sm:text-sm sm:leading-6" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-baut-color-red-300 focus:ring-baut-color-red-200">
                        <label for="remember-me" class="ml-3 block text-sm leading-6 text-gray-900">
                            {{ __('Remember me') }}
                        </label>
                    </div>

                    <div class="text-sm leading-6">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="font-semibold text-baut-color-red-200 hover:text-baut-color-red-300">
                                {{-- Forgot password? --}}
                                {{ __('Forgot password?') }}
                            </a>
                         @endif
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-baut-color-red-100 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-baut-color-red-200 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign
                        in</button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
