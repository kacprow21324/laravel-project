@extends('layouts.main')

@section('title', 'Oferta i Cennik - VetCare Klinika')

@section('content')
    <!-- Hero Cennik -->
    <section class="bg-gradient-to-r from-teal-600 via-cyan-600 to-blue-600 py-16">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold text-white drop-shadow-lg mb-4">Nasza Oferta</h1>
            <p class="text-xl text-white/90 max-w-2xl mx-auto">
                Sprawdź pełen cennik naszych usług weterynaryjnych. 
                Oferujemy konkurencyjne ceny i najwyższą jakość opieki.
            </p>
        </div>
    </section>

    <!-- Cennik -->
    <section class="py-16 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            
            <!-- Karty usług - Grid Layout -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($uslugi as $usluga)
                    <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 hover:scale-[1.02] overflow-hidden border border-gray-100">
                        <!-- Górna część z gradientem -->
                        <div class="bg-gradient-to-r from-teal-500 to-cyan-500 p-4">
                            <div class="flex items-center justify-center">
                                <div class="bg-white/20 rounded-full p-3">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Treść karty -->
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 text-center mb-3 group-hover:text-teal-600 transition-colors">
                                {{ $usluga->nazwa }}
                            </h3>
                            
                            @if($usluga->opis)
                                <p class="text-gray-600 text-sm text-center mb-4 line-clamp-2">
                                    {{ $usluga->opis }}
                                </p>
                            @endif
                            
                            <!-- Cena -->
                            <div class="text-center">
                                <div class="inline-block bg-gradient-to-r from-green-100 to-emerald-100 rounded-xl px-4 py-2">
                                    <span class="text-2xl font-bold text-green-700">
                                        {{ number_format($usluga->cena_aktualna, 2, ',', ' ') }}
                                    </span>
                                    <span class="text-green-600 font-medium ml-1">zł</span>
                                </div>
                            </div>
                            
                            @if($usluga->czas_trwania_minuty)
                                <p class="text-gray-500 text-sm text-center mt-3">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    ok. {{ $usluga->czas_trwania_minuty }} min
                                </p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p class="text-gray-600 text-xl">Brak usług w bazie danych</p>
                    </div>
                @endforelse
            </div>

            <!-- Alternatywna tabela (zebra striping) -->
            <div class="mt-16">
                <h2 class="text-3xl font-bold text-center text-gray-800 mb-8">Pełny cennik (tabela)</h2>
                
                <div class="overflow-x-auto rounded-2xl shadow-xl">
                    <table class="w-full" role="table" aria-label="Cennik usług weterynaryjnych">
                        <thead>
                            <tr class="bg-gradient-to-r from-teal-600 to-cyan-600 text-white">
                                <th scope="col" class="px-6 py-4 text-left font-bold text-lg">Nazwa usługi</th>
                                <th scope="col" class="px-6 py-4 text-left font-bold text-lg hidden md:table-cell">Opis</th>
                                <th scope="col" class="px-6 py-4 text-center font-bold text-lg">Czas</th>
                                <th scope="col" class="px-6 py-4 text-right font-bold text-lg">Cena</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($uslugi as $index => $usluga)
                                <tr class="{{ $index % 2 === 0 ? 'bg-white' : 'bg-gray-50' }} hover:bg-teal-50 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-gray-800">
                                        {{ $usluga->nazwa }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 hidden md:table-cell">
                                        {{ Str::limit($usluga->opis ?? '-', 50) }}
                                    </td>
                                    <td class="px-6 py-4 text-center text-gray-600">
                                        {{ $usluga->czas_trwania_minuty ? $usluga->czas_trwania_minuty . ' min' : '-' }}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="inline-block bg-green-100 text-green-800 font-bold px-3 py-1 rounded-full">
                                            {{ number_format($usluga->cena_aktualna, 2, ',', ' ') }} zł
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- CTA -->
            <div class="mt-16 text-center">
                <div class="bg-gradient-to-r from-teal-600 via-cyan-600 to-blue-600 rounded-2xl shadow-xl p-8 max-w-2xl mx-auto">
                    <h3 class="text-2xl font-bold text-white mb-4">Chcesz umówić wizytę?</h3>
                    <p class="text-white/90 mb-6">Zaloguj się do swojego konta lub zarejestruj, aby umówić wizytę online.</p>
                    <div class="flex justify-center gap-4 flex-wrap">
                        @guest
                            <a href="{{ route('login') }}" class="bg-white text-teal-700 px-6 py-3 rounded-xl font-bold hover:bg-gray-100 transition shadow-lg transform hover:scale-105 duration-300">
                                Zaloguj się
                            </a>
                            <a href="{{ route('register') }}" class="bg-teal-800 text-white px-6 py-3 rounded-xl font-bold hover:bg-teal-900 transition shadow-lg transform hover:scale-105 duration-300 border-2 border-white/30">
                                Zarejestruj się
                            </a>
                        @else
                            <a href="{{ route('client.dashboard') }}" class="bg-white text-teal-700 px-6 py-3 rounded-xl font-bold hover:bg-gray-100 transition shadow-lg transform hover:scale-105 duration-300">
                                Przejdź do panelu
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
