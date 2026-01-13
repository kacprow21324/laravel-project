@extends('layouts.main')

@section('title', 'Panel Weterynarza - VetCare Klinika')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Nagłówek panelu -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Panel Weterynarza
                </h1>
                <p class="text-gray-600 mt-2">
                    Witaj, dr {{ $user->imie }} {{ $user->nazwisko }}!
                    <span class="bg-teal-100 text-teal-800 px-2 py-1 rounded text-sm ml-2">Weterynarz</span>
                </p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('pacjenci.index') }}" class="bg-teal-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-teal-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    Baza Pacjentów
                </a>
                <a href="{{ route('staff.leki') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    Magazyn leków
                </a>
            </div>
        </div>
    </div>

    <!-- Statystyki -->
    <div class="mb-8">
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-teal-100">Moje wizyty dzisiaj</p>
                        <p class="text-4xl font-bold">{{ $statystyki['dzisiaj'] }}</p>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
            </div>
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100">Zaplanowane (7 dni)</p>
                        <p class="text-4xl font-bold">{{ $statystyki['tydzien'] }}</p>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100">Zakończone (miesiąc)</p>
                        <p class="text-4xl font-bold">{{ $statystyki['zakonczone_miesiac'] }}</p>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Dzisiejsze wizyty -->
    <section class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Moje dzisiejsze wizyty ({{ now()->format('d.m.Y') }})
        </h2>
        
        @if($dzisiejszeWizyty->count() > 0)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-teal-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Godzina</th>
                            <th class="px-6 py-4 text-left font-semibold">Pacjent</th>
                            <th class="px-6 py-4 text-left font-semibold">Gatunek</th>
                            <th class="px-6 py-4 text-left font-semibold">Właściciel</th>
                            <th class="px-6 py-4 text-left font-semibold">Status</th>
                            <th class="px-6 py-4 text-left font-semibold">Opis zgłoszenia</th>
                            <th class="px-6 py-4 text-left font-semibold">Akcje</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($dzisiejszeWizyty as $wizyta)
                            <tr class="hover:bg-teal-50">
                                <td class="px-6 py-4 font-semibold text-teal-600">
                                    {{ $wizyta->zakres_czasowy }}
                                </td>
                                <td class="px-6 py-4 font-semibold">
                                    {{ $wizyta->zwierze->imie }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wizyta->zwierze->gatunek->nazwa }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wizyta->zwierze->uzytkownik->imie }} {{ $wizyta->zwierze->uzytkownik->nazwisko }}
                                    <br>
                                    <span class="text-sm text-gray-500">Tel: {{ $wizyta->zwierze->uzytkownik->telefon }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    @if($wizyta->status === 'zakonczona')
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            Zakończona
                                        </span>
                                    @elseif($wizyta->status === 'umowiona')
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            Umówiona
                                        </span>
                                    @elseif($wizyta->status === 'oczekujaca')
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            Oczekująca
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            Anulowana
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <p class="truncate" title="{{ $wizyta->opis_zgloszenia }}">
                                        {{ Str::limit($wizyta->opis_zgloszenia, 40) }}
                                    </p>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('staff.wizyta', $wizyta->id) }}" 
                                           class="bg-teal-600 text-white px-3 py-1 rounded text-sm hover:bg-teal-700 transition">
                                            Karta wizyty
                                        </a>
                                        <a href="{{ route('pacjenci.show', $wizyta->zwierze->id) }}" 
                                           class="bg-gray-500 text-white px-3 py-1 rounded text-sm hover:bg-gray-600 transition">
                                            Pacjent
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-8 rounded-lg text-center">
                <svg class="w-12 h-12 mx-auto mb-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-lg font-semibold">Brak wizyt na dzisiaj!</p>
                <p class="text-sm mt-1">Możesz odpocząć lub zająć się dokumentacją.</p>
            </div>
        @endif
    </section>

    <!-- Nadchodzące wizyty -->
    <section>
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            Moje nadchodzące wizyty (następne 7 dni)
        </h2>
        
        @if($nadchodzaceWizyty->count() > 0)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Data i godzina</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Pacjent</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Gatunek</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Właściciel</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Opis</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Akcje</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($nadchodzaceWizyty as $wizyta)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <span class="font-semibold">{{ $wizyta->data_wizyty->format('d.m.Y') }}</span>
                                    <br>
                                    <span class="text-sm text-gray-500">{{ $wizyta->data_wizyty->format('H:i') }}</span>
                                </td>
                                <td class="px-6 py-4 font-semibold">
                                    {{ $wizyta->zwierze->imie }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wizyta->zwierze->gatunek->nazwa }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wizyta->zwierze->uzytkownik->imie }} {{ $wizyta->zwierze->uzytkownik->nazwisko }}
                                </td>
                                <td class="px-6 py-4 max-w-xs truncate">
                                    {{ Str::limit($wizyta->opis_zgloszenia, 40) }}
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('pacjenci.show', $wizyta->zwierze->id) }}" 
                                       class="text-teal-600 hover:text-teal-800 font-medium">
                                        Zobacz kartę
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 text-gray-600 px-6 py-4 rounded-lg">
                <p>Brak zaplanowanych wizyt na najbliższe 7 dni.</p>
            </div>
        @endif
    </section>
</div>
@endsection
