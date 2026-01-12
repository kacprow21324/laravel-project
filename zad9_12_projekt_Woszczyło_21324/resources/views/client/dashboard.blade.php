@extends('layouts.main')

@section('title', 'Panel Klienta - VetCare Klinika')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Nagłówek panelu -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    Witaj, {{ $user->imie }} {{ $user->nazwisko }}!
                </h1>
                <p class="text-gray-600 mt-2">Panel Klienta - zarządzaj swoimi zwierzętami i wizytami</p>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-8 mb-8">
        <!-- Formularz dodawania zwierzaka -->
        <section class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Dodaj Zwierzaka
            </h2>
            <form action="{{ route('client.zwierzeta.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="imie" class="block text-sm font-medium text-gray-700 mb-1">Imię zwierzaka *</label>
                    <input type="text" name="imie" id="imie" required 
                           class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('imie') border-red-500 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                           placeholder="np. Burek"
                           value="{{ old('imie') }}">
                    @error('imie')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="gatunek_id" class="block text-sm font-medium text-gray-700 mb-1">Gatunek *</label>
                    <select name="gatunek_id" id="gatunek_id" required
                            class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('gatunek_id') border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror">
                        <option value="">-- Wybierz gatunek --</option>
                        @foreach($gatunki as $gatunek)
                            <option value="{{ $gatunek->id }}" {{ old('gatunek_id') == $gatunek->id ? 'selected' : '' }}>{{ $gatunek->nazwa }}</option>
                        @endforeach
                    </select>
                    @error('gatunek_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="plec" class="block text-sm font-medium text-gray-700 mb-1">Płeć *</label>
                        <select name="plec" id="plec" required
                                class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('plec') border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror">
                            <option value="">-- Wybierz --</option>
                            <option value="samiec" {{ old('plec') == 'samiec' ? 'selected' : '' }}>Samiec</option>
                            <option value="samica" {{ old('plec') == 'samica' ? 'selected' : '' }}>Samica</option>
                        </select>
                        @error('plec')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="data_urodzenia" class="block text-sm font-medium text-gray-700 mb-1">Data urodzenia</label>
                        <input type="date" name="data_urodzenia" id="data_urodzenia"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('data_urodzenia') border-red-500 text-red-900 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                               value="{{ old('data_urodzenia') }}">
                        @error('data_urodzenia')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="waga" class="block text-sm font-medium text-gray-700 mb-1">Waga (kg)</label>
                        <input type="number" name="waga" id="waga" step="0.01" min="0.01"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('waga') border-red-500 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                               placeholder="np. 5.50"
                               value="{{ old('waga') }}">
                        @error('waga')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="nr_czipa" class="block text-sm font-medium text-gray-700 mb-1">Nr czipa</label>
                        <input type="text" name="nr_czipa" id="nr_czipa"
                               class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 @error('nr_czipa') border-red-500 text-red-900 placeholder-red-300 focus:ring-red-500 focus:border-red-500 @else border-gray-300 @enderror"
                               placeholder="Opcjonalnie"
                               value="{{ old('nr_czipa') }}">
                        @error('nr_czipa')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="w-full bg-teal-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-teal-700 transition">
                    Dodaj zwierzaka
                </button>
            </form>
        </section>

        <!-- Formularz rezerwacji wizyty -->
        <section class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Umów Wizytę
            </h2>
            @if($zwierzeta->count() > 0)
                <form action="{{ route('client.wizyty.store') }}" method="POST" class="space-y-4" aria-label="Formularz umawiania wizyty">
                    @csrf
                    <div>
                        <label for="zwierze_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Zwierzę <span class="text-red-600" aria-hidden="true">*</span>
                        </label>
                        <select name="zwierze_id" id="zwierze_id" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                aria-describedby="zwierze-help">
                            <option value="">-- Wybierz zwierzę --</option>
                            @foreach($zwierzeta as $zwierze)
                                <option value="{{ $zwierze->id }}">{{ $zwierze->imie }} ({{ $zwierze->gatunek->nazwa }})</option>
                            @endforeach
                        </select>
                        <p id="zwierze-help" class="text-xs text-gray-500 mt-1">Wybierz zwierzę, które wymaga konsultacji</p>
                        @error('zwierze_id')
                            <span class="error-message" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="usluga_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Rodzaj usługi <span class="text-red-600" aria-hidden="true">*</span>
                        </label>
                        <select name="usluga_id" id="usluga_id" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                aria-describedby="usluga-help">
                            <option value="">-- Wybierz usługę --</option>
                            @foreach($uslugi as $usluga)
                                <option value="{{ $usluga->id }}">{{ $usluga->nazwa }} - {{ number_format($usluga->cena_aktualna, 2, ',', ' ') }} zł ({{ $usluga->czas_trwania_minuty }} min)</option>
                            @endforeach
                        </select>
                        <p id="usluga-help" class="text-xs text-gray-500 mt-1">Wybierz rodzaj wizyty (ceny orientacyjne)</p>
                        @error('usluga_id')
                            <span class="error-message" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="data_wizyty" class="block text-sm font-medium text-gray-700 mb-1">
                            Preferowana data i godzina <span class="text-red-600" aria-hidden="true">*</span>
                        </label>
                           <input type="datetime-local" name="data_wizyty" id="data_wizyty" required
                               min="{{ now()->addDay()->format('Y-m-d\TH:i') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                               aria-describedby="data-help">
                        <p id="data-help" class="text-xs text-gray-500 mt-1">Wizyta nie wcześniej niż jutro</p>
                        @error('data_wizyty')
                            <span class="error-message" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="opis_zgloszenia" class="block text-sm font-medium text-gray-700 mb-1">
                            Opis problemu / powód wizyty <span class="text-red-600" aria-hidden="true">*</span>
                        </label>
                        <textarea name="opis_zgloszenia" id="opis_zgloszenia" rows="3" required
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                                  placeholder="Opisz powód wizyty lub objawy..."
                                  aria-describedby="opis-help"></textarea>
                        <p id="opis-help" class="text-xs text-gray-500 mt-1">Opisz objawy, aby lekarz mógł się lepiej przygotować</p>
                        @error('opis_zgloszenia')
                            <span class="error-message" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-teal-600 text-white py-2 px-4 rounded-lg font-semibold hover:bg-teal-700 transition">
                        Zarezerwuj wizytę
                    </button>
                </form>
            @else
                <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg">
                    <p>Najpierw dodaj zwierzę, aby móc umówić wizytę.</p>
                </div>
            @endif
        </section>
    </div>

    <!-- Moje Zwierzaki -->
    <section class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
            </svg>
            Moje Zwierzaki
        </h2>
        
        @if($zwierzeta->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($zwierzeta as $zwierze)
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-teal-100 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $zwierze->imie }}</h3>
                                <p class="text-gray-600">{{ $zwierze->gatunek->nazwa }}</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><strong>Płeć:</strong> {{ ucfirst($zwierze->plec) }}</p>
                            @if($zwierze->data_urodzenia)
                                <p><strong>Data urodzenia:</strong> {{ $zwierze->data_urodzenia->format('d.m.Y') }}</p>
                            @endif
                            @if($zwierze->waga)
                                <p><strong>Waga:</strong> {{ number_format($zwierze->waga, 2, ',', ' ') }} kg</p>
                            @endif
                            @if($zwierze->nr_czipa)
                                <p><strong>Nr czipa:</strong> {{ $zwierze->nr_czipa }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 text-gray-600 px-6 py-4 rounded-lg">
                <p>Nie masz jeszcze zarejestrowanych zwierząt. Skorzystaj z formularza powyżej, aby dodać swojego pupila.</p>
            </div>
        @endif
    </section>

    <!-- Historia Wizyt -->
    <section>
        <h2 class="text-2xl font-bold text-gray-800 mb-4 flex items-center gap-2">
            <svg class="w-7 h-7 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            Moje Wizyty
        </h2>
        
        @if($wizyty->count() > 0)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Data</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Zwierzę</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Lekarz</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Status</th>
                            <th class="px-6 py-4 text-left text-gray-700 font-semibold">Opis</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($wizyty as $wizyta)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    {{ $wizyta->data_wizyty->format('d.m.Y H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wizyta->zwierze->imie }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($wizyta->lekarz)
                                        {{ $wizyta->lekarz->imie }} {{ $wizyta->lekarz->nazwisko }}
                                    @else
                                        <span class="text-gray-400">Do przydzielenia</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($wizyta->status === 'zakonczona')
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            Zakończona
                                        </span>
                                    @elseif($wizyta->status === 'umowiona')
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                                            Umówiona
                                        </span>
                                    @elseif($wizyta->status === 'oczekujaca')
                                        <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                            Oczekująca
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-medium">
                                            Anulowana
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 max-w-xs truncate" title="{{ $wizyta->opis_zgloszenia }}">
                                    {{ Str::limit($wizyta->opis_zgloszenia, 50) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 text-gray-600 px-6 py-4 rounded-lg">
                <p>Brak historii wizyt. Umów pierwszą wizytę używając formularza powyżej!</p>
            </div>
        @endif
    </section>
</div>
@endsection
