@extends('layouts.main')

@section('title', 'Baza Pacjentów - VetCare Klinika')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Nagłówek -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    Baza Pacjentów
                </h1>
                <p class="text-gray-600 mt-2">Wszystkie zwierzęta zarejestrowane w klinice</p>
            </div>
            <a href="{{ auth()->user()->rola->nazwa === 'admin' ? route('admin.dashboard') : route('staff.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Powrót do panelu
            </a>
        </div>
    </div>

    <!-- Formularz wyszukiwania -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <form action="{{ route('pacjenci.index') }}" method="GET" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label for="szukaj" class="block text-sm font-medium text-gray-700 mb-1">Szukaj pacjenta</label>
                <input type="text" name="szukaj" id="szukaj" value="{{ request('szukaj') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                       placeholder="Imię zwierzęcia lub właściciela...">
            </div>
            <div class="min-w-[180px]">
                <label for="gatunek" class="block text-sm font-medium text-gray-700 mb-1">Gatunek</label>
                <select name="gatunek" id="gatunek"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    <option value="">Wszystkie gatunki</option>
                    @foreach($gatunki as $gatunek)
                        <option value="{{ $gatunek->id }}" {{ request('gatunek') == $gatunek->id ? 'selected' : '' }}>
                            {{ $gatunek->nazwa }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="bg-teal-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-teal-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Szukaj
                </button>
                @if(request('szukaj') || request('gatunek'))
                    <a href="{{ route('pacjenci.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-600 transition">
                        Wyczyść
                    </a>
                @endif
            </div>
        </form>
    </div>

    <!-- Statystyki -->
    <div class="mb-8">
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Wszystkich pacjentów</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $zwierzeta->total() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Gatunków</p>
                        <p class="text-3xl font-bold text-blue-600">{{ $gatunki->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A2 2 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Na tej stronie</p>
                        <p class="text-3xl font-bold text-green-600">{{ $zwierzeta->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista pacjentów -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        @if($zwierzeta->isEmpty())
            <div class="p-8 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-500 text-lg">Brak pacjentów do wyświetlenia</p>
                @if(request('szukaj') || request('gatunek'))
                    <p class="text-gray-400 mt-2">Spróbuj zmienić kryteria wyszukiwania</p>
                @endif
            </div>
        @else
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pacjent</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gatunek / Rasa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Właściciel</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Wiek</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Akcje</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($zwierzeta as $zwierze)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $zwierze->imie }}</p>
                                <p class="text-sm text-gray-500">
                                    @if($zwierze->plec === 'samiec')
                                        <span class="text-blue-600">♂ Samiec</span>
                                    @elseif($zwierze->plec === 'samica')
                                        <span class="text-pink-600">♀ Samica</span>
                                    @else
                                        <span class="text-gray-400">Nieznana płeć</span>
                                    @endif
                                </p>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-gray-800">{{ $zwierze->gatunek->nazwa ?? 'Nieznany' }}</p>
                            <p class="text-sm text-gray-500">{{ $zwierze->rasa ?? '-' }}</p>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($zwierze->uzytkownik)
                                <p class="text-gray-800">{{ $zwierze->uzytkownik->imie }} {{ $zwierze->uzytkownik->nazwisko }}</p>
                                <p class="text-sm text-gray-500">{{ $zwierze->uzytkownik->email }}</p>
                            @else
                                <p class="text-gray-400">Brak danych</p>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($zwierze->data_urodzenia)
                                @php
                                    $wiek = \Carbon\Carbon::parse($zwierze->data_urodzenia)->age;
                                @endphp
                                <span class="text-gray-800">{{ $wiek }} {{ $wiek == 1 ? 'rok' : ($wiek >= 2 && $wiek <= 4 ? 'lata' : 'lat') }}</span>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($zwierze->data_urodzenia)->format('d.m.Y') }}</p>
                            @else
                                <span class="text-gray-400">Nieznany</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('pacjenci.show', $zwierze->id) }}" 
                               class="inline-flex items-center px-3 py-1 bg-teal-100 text-teal-700 rounded-lg hover:bg-teal-200 transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Karta pacjenta
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginacja -->
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $zwierzeta->withQueryString()->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
