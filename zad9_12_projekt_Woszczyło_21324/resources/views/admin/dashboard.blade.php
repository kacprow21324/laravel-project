@extends('layouts.main')

@section('title', 'Panel Administratora - VetCare Klinika')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Nagłówek panelu -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    Panel Administratora
                </h1>
                <p class="text-gray-600 mt-2">
                    Witaj, {{ $user->imie }} {{ $user->nazwisko }}!
                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm ml-2">Administrator</span>
                </p>
            </div>
            <div class="flex gap-3 flex-wrap">
                <a href="{{ route('admin.users.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-purple-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Użytkownicy
                </a>
                <a href="{{ route('admin.uslugi.index') }}" class="bg-teal-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-teal-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    Usługi
                </a>
                <a href="{{ route('admin.leki') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    Magazyn leków
                </a>
                <a href="{{ route('pacjenci.index') }}" class="bg-pink-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-pink-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    Baza Pacjentów
                </a>
            </div>
        </div>
    </div>

    <!-- Statystyki globalne -->
    <div class="mb-8">
        <div class="grid md:grid-cols-4 gap-6">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100">Wszystkie wizyty dzisiaj</p>
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
                        <p class="text-blue-100">Oczekujące na zatwierdzenie</p>
                        <p class="text-4xl font-bold">{{ $statystyki['oczekujace'] }}</p>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-teal-100">Weterynarzy</p>
                        <p class="text-4xl font-bold">{{ $statystyki['weterynarze'] }}</p>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100">Klientów</p>
                        <p class="text-4xl font-bold">{{ $statystyki['klienci'] }}</p>
                    </div>
                    <svg class="w-12 h-12 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-8">
        <!-- Lista pracowników -->
        <section class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Pracownicy kliniki
            </h2>
            @if($pracownicy->count() > 0)
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Imię i nazwisko</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Email</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Telefon</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Rola</th>
                                <th class="px-4 py-3 text-left text-gray-700 font-semibold">Akcje</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($pracownicy as $pracownik)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-3 font-semibold text-gray-800">
                                        {{ $pracownik->imie }} {{ $pracownik->nazwisko }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $pracownik->email }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">
                                        {{ $pracownik->telefon ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($pracownik->rola_id == 1)
                                            <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-sm">Admin</span>
                                        @else
                                            <span class="bg-teal-100 text-teal-800 px-2 py-1 rounded text-sm">Weterynarz</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($pracownik->id !== auth()->id())
                                            <form action="{{ route('admin.uzytkownicy.destroy', $pracownik->id) }}" method="POST" class="inline"
                                                  onsubmit="return confirm('Czy na pewno chcesz usunąć użytkownika {{ $pracownik->imie }} {{ $pracownik->nazwisko }}?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-100 text-red-600 hover:bg-red-200 px-2 py-1 rounded text-sm transition flex items-center gap-1">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Usuń
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-400 text-sm">Twoje konto</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-gray-500">Brak pracowników w systemie.</p>
            @endif
        </section>
    </div>

    <!-- Oczekujące wizyty do zatwierdzenia -->
    @if($oczekujaceWizyty->count() > 0)
    <section class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Oczekujące na zatwierdzenie ({{ $oczekujaceWizyty->count() }})
        </h2>
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <table class="w-full">
                <thead class="bg-yellow-500 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left font-semibold">Data</th>
                        <th class="px-6 py-4 text-left font-semibold">Pacjent</th>
                        <th class="px-6 py-4 text-left font-semibold">Właściciel</th>
                        <th class="px-6 py-4 text-left font-semibold">Opis zgłoszenia</th>
                            <th class="px-6 py-4 text-left font-semibold">Przydziel weterynarza</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($oczekujaceWizyty as $wizyta)
                        <tr class="hover:bg-yellow-50">
                            <td class="px-6 py-4 font-semibold">
                                {{ $wizyta->data_wizyty->format('d.m.Y H:i') }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $wizyta->zwierze->imie }} ({{ $wizyta->zwierze->gatunek->nazwa }})
                            </td>
                            <td class="px-6 py-4">
                                {{ $wizyta->zwierze->uzytkownik->imie }} {{ $wizyta->zwierze->uzytkownik->nazwisko }}
                            </td>
                            <td class="px-6 py-4 max-w-xs truncate">
                                {{ Str::limit($wizyta->opis_zgloszenia, 50) }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2 items-center">
                                    <form action="{{ route('admin.wizyty.przydziel', $wizyta->id) }}" method="POST" class="flex gap-2">
                                        @csrf
                                        <select name="lekarz_id" required class="border border-gray-300 rounded px-2 py-1 text-sm">
                                            <option value="">-- Wybierz --</option>
                                            @foreach($weterynarze as $wet)
                                                <option value="{{ $wet->id }}">{{ $wet->imie }} {{ $wet->nazwisko }}</option>
                                            @endforeach
                                        </select>
                                        <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                            Zatwierdź
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.wizyty.anuluj', $wizyta->id) }}" method="POST" 
                                          onsubmit="return confirm('Czy na pewno chcesz anulować tę wizytę?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                            Anuluj
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    @endif

    <!-- Wszystkie dzisiejsze wizyty -->
    <section class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Wszystkie wizyty dzisiaj ({{ now()->format('d.m.Y') }})
        </h2>
        
        @if($dzisiejszeWizyty->count() > 0)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-purple-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">Godzina</th>
                            <th class="px-6 py-4 text-left font-semibold">Pacjent</th>
                            <th class="px-6 py-4 text-left font-semibold">Właściciel</th>
                            <th class="px-6 py-4 text-left font-semibold">Lekarz</th>
                            <th class="px-6 py-4 text-left font-semibold">Status</th>
                            <th class="px-6 py-4 text-left font-semibold">Opis</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($dzisiejszeWizyty as $wizyta)
                            <tr class="hover:bg-purple-50">
                                <td class="px-6 py-4 font-semibold text-purple-600">
                                    {{ $wizyta->data_wizyty->format('H:i') }}
                                </td>
                                <td class="px-6 py-4 font-semibold">
                                    {{ $wizyta->zwierze->imie }} ({{ $wizyta->zwierze->gatunek->nazwa }})
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wizyta->zwierze->uzytkownik->imie }} {{ $wizyta->zwierze->uzytkownik->nazwisko }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($wizyta->lekarz)
                                        {{ $wizyta->lekarz->imie }} {{ $wizyta->lekarz->nazwisko }}
                                    @else
                                        <span class="text-yellow-600">Do przydzielenia</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($wizyta->status === 'zakonczona')
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Zakończona</span>
                                    @elseif($wizyta->status === 'umowiona')
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">Umówiona</span>
                                    @elseif($wizyta->status === 'oczekujaca')
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">Oczekująca</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">Anulowana</span>
                                    @endif
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
            <div class="bg-gray-50 border border-gray-200 text-gray-600 px-6 py-8 rounded-lg text-center">
                <p class="text-lg">Brak wizyt na dzisiaj.</p>
            </div>
        @endif
    </section>

    <!-- Nadchodzące wizyty -->
    <section>
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
            </svg>
            Nadchodzące wizyty (następne 7 dni)
        </h2>
        
        @if($nadchodzaceWizyty->count() > 0)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Data i godzina</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Pacjent</th>
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
                                    {{ $wizyta->zwierze->imie }} ({{ $wizyta->zwierze->gatunek->nazwa }})
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wizyta->zwierze->uzytkownik->imie }} {{ $wizyta->zwierze->uzytkownik->nazwisko }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($wizyta->lekarz)
                                        {{ $wizyta->lekarz->imie }} {{ $wizyta->lekarz->nazwisko }}
                                    @else
                                        <span class="text-yellow-600">Do przydzielenia</span>
                                    @endif
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
