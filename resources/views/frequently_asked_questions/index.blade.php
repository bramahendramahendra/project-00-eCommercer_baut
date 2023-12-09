<x-app-layout>
    <div>
        <main>
            <div class="bg-white" x-data="{ expandedQuestion: null }">
                <div class="mx-auto max-w-7xl px-6 py-24 sm:py-32 lg:px-8 lg:py-20">
                    <div class="mx-auto max-w-4xl divide-y divide-gray-900/10">
                    <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">FAQ</h2>
                    <dl class="mt-10 space-y-6 divide-y divide-gray-900/10">
                        <!-- Question 1 -->
                        @foreach ($frequentlyAskedQuestions as $frequentlyAskedQuestion)
                            <div class="pt-6">
                                <dt>
                                    <button @click="expandedQuestion = expandedQuestion === 0 ? null : 0" class="flex w-full items-start justify-between text-left text-gray-900" aria-controls="faq-0" :aria-expanded="expandedQuestion === 0">
                                        <span class="text-base font-semibold leading-7">
                                            {{$frequentlyAskedQuestion->question}}
                                        </span>
                                        <span class="ml-6 flex h-7 items-center">
                                            <svg x-show="expandedQuestion !== 0" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                            </svg>
                                            <svg x-show="expandedQuestion === 0" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 12H6" />
                                            </svg>
                                        </span>
                                    </button>
                                </dt>
                                <dd x-show="expandedQuestion === 0" class="mt-2 pr-12" id="faq-0">
                                    <p class="text-base leading-7 text-gray-600">
                                        {{$frequentlyAskedQuestion->answer}}
                                    </p>
                                </dd>
                            </div>
                        @endforeach

                        <!-- Tambahkan lebih banyak pertanyaan dengan format yang sama dan ubah indeks di x-data -->

                    </dl>
                    </div>
                </div>
            </div>

        </main>
    </div>
</x-app-layout>