@extends('layouts.main')

@section('title', 'Magazyn Leków - VetCare Klinika')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Nagłówek -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    Magazyn Leków
                </h1>
                <p class="text-gray-600 mt-2">Przegląd stanów magazynowych leków i preparatów</p>
            </div>
            <a href="{{ route('staff.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Powrót do panelu
            </a>
        </div>
    </div>

    <!-- Statystyki magazynu -->
    <section class="mb-8">
        <div class="grid md:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Wszystkie leki</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $leki->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Niski stan (&lt;10)</p>
                        <p class="text-3xl font-bold text-yellow-600">{{ $leki->where('ilosc_na_stanie', '<', 10)->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Brak na stanie</p>
                        <p class="text-3xl font-bold text-red-600">{{ $leki->where('ilosc_na_stanie', 0)->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Wartość magazynu</p>
                        <p class="text-2xl font-bold text-green-600">{{ number_format($leki->sum(fn($l) => $l->cena_jednostkowa * $l->ilosc_na_stanie), 2, ',', ' ') }} zł</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lista leków -->
    <section>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Lista leków w magazynie</h2>
        
        @if($leki->count() > 0)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Nazwa leku</th>
                            <th class="px-6 py-4 text-left font-semibold">Jednostka</th>
                            <th class="px-6 py-4 text-left font-semibold">Cena jednostkowa</th>
                            <th class="px-6 py-4 text-left font-semibold">Ilość na stanie</th>
                            <th class="px-6 py-4 text-left font-semibold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($leki as $lek)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-semibold text-gray-800">
                                    {{ $lek->nazwa }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $lek->jednostka }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ number_format($lek->cena_jednostkowa, 2, ',', ' ') }} zł
                                </td>
                                <td class="px-6 py-4 font-semibold">
                                    @if($lek->ilosc_na_stanie == 0)
                                        <span class="text-red-600">{{ $lek->ilosc_na_stanie }}</span>
                                    @elseif($lek->ilosc_na_stanie < 10)
                                        <span class="text-yellow-600">{{ $lek->ilosc_na_stanie }}</span>
                                    @else
                                        <span class="text-green-600">{{ $lek->ilosc_na_stanie }}</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($lek->ilosc_na_stanie == 0)
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            Brak
                                        </span>
                                    @elseif($lek->ilosc_na_stanie < 10)
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            Niski stan
                                        </span>
                                    @else
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            Dostępny
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 text-gray-600 px-6 py-8 rounded-lg text-center">
                <p class="text-lg">Brak leków w magazynie.</p>
            </div>
        @endif
    </section>
</div>
@endsection
