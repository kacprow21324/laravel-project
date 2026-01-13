@extends('layouts.main')

@section('title', 'Zarządzanie Usługami - VetCare Klinika')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Nagłówek -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                    </svg>
                    Zarządzanie Usługami (Badania)
                </h1>
                <p class="text-gray-600 mt-2">Cennik i oferta badań weterynaryjnych</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.uslugi.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Dodaj usługę
                </a>
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Powrót do panelu
                </a>
            </div>
        </div>
    </div>

    <!-- Statystyki -->
    <div class="mb-8">
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Wszystkie usługi</p>
                        <p class="text-3xl font-bold text-teal-600">{{ $uslugi->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Średnia cena</p>
                        <p class="text-3xl font-bold text-green-600">{{ $uslugi->count() > 0 ? number_format($uslugi->avg('cena_aktualna'), 2, ',', ' ') : '0,00' }} zł</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Suma cennika</p>
                        <p class="text-3xl font-bold text-blue-600">{{ number_format($uslugi->sum('cena_aktualna'), 2, ',', ' ') }} zł</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista usług -->
    <section>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Lista usług (badań)</h2>
        
        @if($uslugi->count() > 0)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-teal-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">ID</th>
                            <th class="px-6 py-4 text-left font-semibold">Nazwa usługi</th>
                            <th class="px-6 py-4 text-left font-semibold">Opis</th>
                            <th class="px-6 py-4 text-left font-semibold">Cena</th>
                            <th class="px-6 py-4 text-left font-semibold">Czas trwania</th>
                            <th class="px-6 py-4 text-left font-semibold">Akcje</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($uslugi as $usluga)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $usluga->id }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-800">
                                    {{ $usluga->nazwa }}
                                </td>
                                <td class="px-6 py-4 text-gray-600 max-w-xs truncate" title="{{ $usluga->opis }}">
                                    {{ Str::limit($usluga->opis, 50) ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ number_format($usluga->cena_aktualna, 2, ',', ' ') }} zł
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    @if($usluga->czas_trwania_minuty)
                                        {{ $usluga->czas_trwania_minuty }} min
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.uslugi.edit', $usluga->id) }}" 
                                           class="bg-blue-100 text-blue-600 hover:bg-blue-200 px-3 py-1 rounded text-sm transition flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edytuj
                                        </a>
                                        <form action="{{ route('admin.uslugi.destroy', $usluga->id) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Czy na pewno chcesz usunąć usługę {{ $usluga->nazwa }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-100 text-red-600 hover:bg-red-200 px-3 py-1 rounded text-sm transition flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Usuń
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 text-gray-600 px-6 py-8 rounded-lg text-center">
                <p class="text-lg">Brak usług w systemie.</p>
                <a href="{{ route('admin.uslugi.create') }}" class="inline-block mt-4 bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700 transition">
                    Dodaj pierwszą usługę
                </a>
            </div>
        @endif
    </section>
</div>
@endsection
