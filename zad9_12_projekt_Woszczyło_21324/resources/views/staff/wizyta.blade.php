@extends('layouts.main')

@section('title', 'Szczegóły Wizyty - VetCare Klinika')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Nagłówek -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">Karta Wizyty #{{ $wizyta->id }}</h1>
                    <p class="text-gray-600">
                        {{ $wizyta->data_wizyty->format('d.m.Y') }} | 
                        <span class="font-semibold text-teal-600">{{ $wizyta->zakres_czasowy }}</span>
                        <span class="text-sm text-gray-500">({{ $wizyta->czas_trwania_minuty }} min)</span>
                    </p>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('staff.pacjent', $wizyta->zwierze->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    Karta pacjenta
                </a>
                <a href="{{ route('staff.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Powrót do panelu
                </a>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg mb-6">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-4 rounded-lg mb-6">
            <div class="flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Lewa kolumna - informacje o wizycie -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Status wizyty -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Status wizyty</h2>
                <div class="text-center">
                    @if($wizyta->status === 'zakonczona')
                        <span class="inline-block bg-green-100 text-green-800 px-4 py-2 rounded-full text-lg font-semibold">
                            ✓ Zakończona
                        </span>
                    @elseif($wizyta->status === 'umowiona')
                        <span class="inline-block bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-lg font-semibold">
                            ● Umówiona
                        </span>
                    @elseif($wizyta->status === 'oczekujaca')
                        <span class="inline-block bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full text-lg font-semibold">
                            ◐ Oczekująca
                        </span>
                    @else
                        <span class="inline-block bg-red-100 text-red-800 px-4 py-2 rounded-full text-lg font-semibold">
                            ✕ Anulowana
                        </span>
                    @endif
                </div>
            </div>

            <!-- Dane pacjenta -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    Pacjent
                </h2>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-sm text-gray-500">Imię</dt>
                        <dd class="font-semibold text-gray-800">{{ $wizyta->zwierze->imie }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Gatunek</dt>
                        <dd class="font-semibold text-gray-800">{{ $wizyta->zwierze->gatunek->nazwa }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Płeć</dt>
                        <dd class="font-semibold text-gray-800">{{ ucfirst($wizyta->zwierze->plec) }}</dd>
                    </div>
                    @if($wizyta->zwierze->waga)
                    <div>
                        <dt class="text-sm text-gray-500">Waga</dt>
                        <dd class="font-semibold text-gray-800">{{ number_format($wizyta->zwierze->waga, 2, ',', ' ') }} kg</dd>
                    </div>
                    @endif
                </dl>
            </div>

            <!-- Dane właściciela -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    Właściciel
                </h2>
                <dl class="space-y-2">
                    <div>
                        <dt class="text-sm text-gray-500">Imię i nazwisko</dt>
                        <dd class="font-semibold text-gray-800">{{ $wizyta->zwierze->uzytkownik->imie }} {{ $wizyta->zwierze->uzytkownik->nazwisko }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Telefon</dt>
                        <dd class="font-semibold text-gray-800">{{ $wizyta->zwierze->uzytkownik->telefon ?? 'Brak' }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Email</dt>
                        <dd class="font-semibold text-gray-800 text-sm">{{ $wizyta->zwierze->uzytkownik->email }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Usługi -->
            @if($wizyta->uslugi->count() > 0)
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Usługi</h2>
                <ul class="space-y-2">
                    @foreach($wizyta->uslugi as $usluga)
                        <li class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
                            <span class="text-gray-700">{{ $usluga->nazwa }}</span>
                            <span class="text-sm text-gray-500">{{ $usluga->czas_trwania_minuty }} min</span>
                        </li>
                    @endforeach
                </ul>
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <p class="text-sm text-gray-600">
                        <strong>Łączny czas:</strong> {{ $wizyta->czas_trwania_minuty }} min
                    </p>
                </div>
            </div>
            @endif

            <!-- Przepisane leki -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                    </svg>
                    Przepisane leki
                </h2>
                @if($wizyta->leki->count() > 0)
                    <ul class="space-y-2">
                        @foreach($wizyta->leki as $lek)
                            <li class="flex justify-between items-center py-2 border-b border-gray-100 last:border-0">
                                <span class="text-gray-700 font-medium">{{ $lek->nazwa }}</span>
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm font-semibold">
                                    {{ $lek->pivot->ilosc_zuzyta }} {{ $lek->jednostka }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-500 text-sm">Brak przepisanych leków</p>
                @endif
            </div>
        </div>

        <!-- Prawa kolumna - opis zgłoszenia i dokumentacja -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Opis zgłoszenia -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                    </svg>
                    Opis zgłoszenia
                </h2>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700">{{ $wizyta->opis_zgloszenia ?: 'Brak opisu zgłoszenia.' }}</p>
                </div>
            </div>

            <!-- Formularz dokumentacji medycznej -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Dokumentacja Medyczna (Karta Wizyty)
                </h2>

                <form action="{{ route('staff.wizyta.dokumentacja', $wizyta->id) }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Temperatura -->
                    <div>
                        <label for="temperatura" class="block text-sm font-medium text-gray-700 mb-1">
                            Temperatura ciała (°C)
                        </label>
                        <input type="number" 
                               name="temperatura" 
                               id="temperatura" 
                               step="0.1" 
                               min="30" 
                               max="45"
                               value="{{ old('temperatura', $wizyta->dokumentacjaMedyczna->temperatura ?? '') }}"
                               class="w-full md:w-1/3 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                               placeholder="np. 38.5">
                        @error('temperatura')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Diagnoza -->
                    <div>
                        <label for="diagnoza" class="block text-sm font-medium text-gray-700 mb-1">
                            Diagnoza / Rozpoznanie
                        </label>
                        <textarea name="diagnoza" 
                                  id="diagnoza" 
                                  rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                  placeholder="Wprowadź diagnozę lub rozpoznanie medyczne...">{{ old('diagnoza', $wizyta->dokumentacjaMedyczna->diagnoza ?? '') }}</textarea>
                        @error('diagnoza')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Zalecenia -->
                    <div>
                        <label for="zalecenia" class="block text-sm font-medium text-gray-700 mb-1">
                            Zalecenia dla właściciela
                        </label>
                        <textarea name="zalecenia" 
                                  id="zalecenia" 
                                  rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                  placeholder="Wprowadź zalecenia dotyczące opieki, leków, diety itp...">{{ old('zalecenia', $wizyta->dokumentacjaMedyczna->zalecenia ?? '') }}</textarea>
                        @error('zalecenia')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Przyciski -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4 border-t border-gray-200">
                        <button type="submit" 
                                class="flex-1 bg-teal-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-teal-700 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Zapisz dokumentację
                        </button>
                        
                        @if($wizyta->status !== 'zakonczona')
                        <button type="submit" 
                                name="zakoncz_wizyte" 
                                value="1"
                                class="flex-1 bg-green-600 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-700 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Zapisz i zakończ wizytę
                        </button>
                        @endif
                    </div>
                </form>

                @if($wizyta->dokumentacjaMedyczna)
                    <div class="mt-6 pt-4 border-t border-gray-200">
                        <p class="text-sm text-gray-500">
                            Ostatnia aktualizacja dokumentacji: 
                            <strong>{{ $wizyta->dokumentacjaMedyczna->updated_at->format('d.m.Y H:i') }}</strong>
                        </p>
                    </div>
                @endif
            </div>

            <!-- Formularz przepisywania leków -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Przepisz lek
                </h2>

                <form action="{{ route('staff.wizyta.przepisz-lek', $wizyta->id) }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="lek_id" class="block text-sm font-medium text-gray-700 mb-1">
                                Wybierz lek *
                            </label>
                            <select name="lek_id" id="lek_id" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">-- Wybierz lek --</option>
                                @foreach($leki as $lek)
                                    <option value="{{ $lek->id }}">
                                        {{ $lek->nazwa }} (dostępne: {{ $lek->ilosc_na_stanie }} {{ $lek->jednostka }})
                                    </option>
                                @endforeach
                            </select>
                            @error('lek_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label for="ilosc" class="block text-sm font-medium text-gray-700 mb-1">
                                Ilość *
                            </label>
                            <input type="number" 
                                   name="ilosc" 
                                   id="ilosc" 
                                   min="1" 
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="np. 10">
                            @error('ilosc')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-blue-500 to-cyan-500 text-white py-3 px-6 rounded-lg font-semibold hover:from-blue-600 hover:to-cyan-600 transition-all duration-300 flex items-center justify-center gap-2 transform hover:scale-[1.02]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Dodaj lek do wizyty
                    </button>
                </form>

                @if($leki->count() == 0)
                    <div class="mt-4 bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg">
                        <p class="text-sm">Brak dostępnych leków w magazynie.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
