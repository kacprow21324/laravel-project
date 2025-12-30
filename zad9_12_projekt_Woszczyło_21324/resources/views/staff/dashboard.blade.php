@extends('layouts.main')

@section('title', 'Panel Pracownika - Klinika Weterynaryjna')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Nagłówek panelu -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    👨‍⚕️ Panel {{ $user->isAdmin() ? 'Administratora' : 'Weterynarza' }}
                </h1>
                <p class="text-gray-600 mt-2">
                    Witaj, {{ $user->imie }} {{ $user->nazwisko }}!
                    @if($user->isAdmin())
                        <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm ml-2">Admin</span>
                    @else
                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm ml-2">Weterynarz</span>
                    @endif
                </p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-600 transition">
                    🚪 Wyloguj się
                </button>
            </form>
        </div>
    </div>

    <!-- Statystyki -->
    <section class="mb-8">
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100">Wizyty dzisiaj</p>
                        <p class="text-4xl font-bold">{{ $statystyki['dzisiaj'] }}</p>
                    </div>
                    <div class="text-5xl opacity-80">📅</div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100">Zaplanowane (7 dni)</p>
                        <p class="text-4xl font-bold">{{ $statystyki['tydzien'] }}</p>
                    </div>
                    <div class="text-5xl opacity-80">📋</div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100">Zakończone (miesiąc)</p>
                        <p class="text-4xl font-bold">{{ $statystyki['zakonczone_miesiac'] }}</p>
                    </div>
                    <div class="text-5xl opacity-80">✅</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Dzisiejsze wizyty -->
    <section class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">📅 Dzisiejsze Wizyty ({{ now()->format('d.m.Y') }})</h2>
        
        @if($dzisiejszeWizyty->count() > 0)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Godzina</th>
                            <th class="px-6 py-4 text-left font-semibold">Pacjent</th>
                            <th class="px-6 py-4 text-left font-semibold">Gatunek</th>
                            <th class="px-6 py-4 text-left font-semibold">Właściciel</th>
                            <th class="px-6 py-4 text-left font-semibold">Lekarz</th>
                            <th class="px-6 py-4 text-left font-semibold">Status</th>
                            <th class="px-6 py-4 text-left font-semibold">Opis zgłoszenia</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($dzisiejszeWizyty as $wizyta)
                            <tr class="hover:bg-blue-50">
                                <td class="px-6 py-4 font-semibold text-blue-600">
                                    {{ $wizyta->data_wizyty->format('H:i') }}
                                </td>
                                <td class="px-6 py-4 font-semibold">
                                    🐾 {{ $wizyta->zwierze->imie }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wizyta->zwierze->gatunek->nazwa }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wizyta->zwierze->uzytkownik->imie }} {{ $wizyta->zwierze->uzytkownik->nazwisko }}
                                    <br>
                                    <span class="text-sm text-gray-500">📞 {{ $wizyta->zwierze->uzytkownik->telefon }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wizyta->lekarz->imie }} {{ $wizyta->lekarz->nazwisko }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($wizyta->status === 'zakończona')
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            ✅ Zakończona
                                        </span>
                                    @elseif($wizyta->status === 'umówiona')
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            ⏳ Umówiona
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                                            ❌ Anulowana
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <p class="truncate" title="{{ $wizyta->opis_zgloszenia }}">
                                        {{ Str::limit($wizyta->opis_zgloszenia, 40) }}
                                    </p>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-8 rounded-lg text-center">
                <div class="text-4xl mb-2">🎉</div>
                <p class="text-lg font-semibold">Brak wizyt na dzisiaj!</p>
                <p class="text-sm mt-1">Możesz odpocząć lub zająć się dokumentacją.</p>
            </div>
        @endif
    </section>

    <!-- Nadchodzące wizyty -->
    <section>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">📋 Nadchodzące Wizyty (następne 7 dni)</h2>
        
        @if($nadchodzaceWizyty->count() > 0)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Data i godzina</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Pacjent</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Gatunek</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Właściciel</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Lekarz</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Opis</th>
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
                                <td class="px-6 py-4">
                                    {{ $wizyta->lekarz->imie }} {{ $wizyta->lekarz->nazwisko }}
                                </td>
                                <td class="px-6 py-4 max-w-xs truncate">
                                    {{ Str::limit($wizyta->opis_zgloszenia, 40) }}
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
