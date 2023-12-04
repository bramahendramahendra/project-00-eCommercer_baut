<x-app-layout>
    <div>
        <main>
            <div class="bg-white">
                <div class="mx-auto max-w-7xl divide-y divide-gray-900/10 px-6 py-24 lg:px-8 lg:py-20">
                    <h2 class="text-2xl font-bold leading-10 tracking-tight text-gray-900">Syarat dan Ketentuan</h2>
                     <p class="mt-6 text-base leading-7 text-gray-600">{{$descTermsAndCondition[0]->content}}</p>
                    <dl class="mt-10 space-y-8 divide-y divide-gray-900/10">
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($termsAndConditions as $termAndCondition)
                            <div class="pt-8 lg:grid lg:grid-cols-12 lg:gap-8">
                                <dt class="text-base font-semibold leading-7 text-gray-900 lg:col-span-3">
                                    {{$no++.'. '.$termAndCondition->title}}
                                </dt>
                                <dd class="mt-4 lg:col-span-9 lg:mt-0">
                                    <p class="text-base leading-7 text-gray-600">
                                        {{$termAndCondition->content}}
                                    </p>
                                </dd>
                            </div>
                        @endforeach
                    </dl>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>