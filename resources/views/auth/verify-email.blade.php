<x-app-layout>
    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8 ">
        {{-- <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900"> --}}
        
        <div class=" w-full sm:max-w-md  sm:mx-auto sm:w-full mt-6 px-6 py-10 s dark:bg-gray-200 shadow-md overflow-hidden sm:rounded-lg">
           
           
            <h2 class="mt-2 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
                Terima kasih telah mendaftar.
            </h2>

            <div class="mt-3 mb-6 text-sm text-gray-600 dark:text-gray-900">
                {{ __('Kami sudah mengirim tautan verifikasi ke email Anda. Buka email dari kami dan klik untuk mengaktifkan akun. Tak muncul? Periksa spam, atau [Kirim Ulang Email Verifikasi] untuk bantuan.') }}
            </div>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-emerald-600 dark:text-emerald-400">
                    {{ __('Cek inbox Anda, tautan baru sudah kami kirimkan ke email anda.') }}
                </div>
            @endif

            <div class="mt-4 flex items-center justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <div>
                        <x-primary-button>
                            {{ __('Kirim Ulang Email Verifikasi') }}
                        </x-primary-button>
                    </div>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="underline text-sm text-red-600 dark:text-gray-900 hover:text-red-700 dark:hover:text-red-500 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-700 dark:focus:ring-offset-red-800">
                        {{ __('Keluar') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
