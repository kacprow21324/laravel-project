@extends('layouts.main')

@section('title', 'Karta Pacjenta: {{ $zwierze->imie }} - VetCare Klinika')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Nagłówek -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $zwierze->imie }}</h1>
                    <p class="text-gray-600">Karta pacjenta - {{ $zwierze->gatunek->nazwa }}</p>
                </div>
            </div>
            <a href="{{ route('pacjenci.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Powrót do listy
            </a>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-8">
        <!-- Dane zwierzęcia -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Dane pacjenta
                </h2>
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm text-gray-500">Imię</dt>
                        <dd class="font-semibold text-gray-800">{{ $zwierze->imie }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Gatunek</dt>
                        <dd class="font-semibold text-gray-800">{{ $zwierze->gatunek->nazwa }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Płeć</dt>
                        <dd class="font-semibold text-gray-800">{{ ucfirst($zwierze->plec) }}</dd>
                    </div>
                    @if($zwierze->data_urodzenia)
                    <div>
                        <dt class="text-sm text-gray-500">Data urodzenia</dt>
                        <dd class="font-semibold text-gray-800">{{ $zwierze->data_urodzenia->format('d.m.Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Wiek</dt>
                        <dd class="font-semibold text-gray-800">{{ $zwierze->data_urodzenia->age }} lat</dd>
                    </div>
                    @endif
                    @if($zwierze->waga)
                    <div>
                        <dt class="text-sm text-gray-500">Waga</dt>
                        <dd class="font-semibold text-gray-800">{{ number_format($zwierze->waga, 2, ',', ' ') }} kg</dd>
                    </div>
                    @endif
                    @if($zwierze->nr_czipa)
                    <div>
                        <dt class="text-sm text-gray-500">Nr czipa</dt>
                        <dd class="font-semibold text-gray-800">{{ $zwierze->nr_czipa }}</dd>
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
                <dl class="space-y-3">
                    <div>
                        <dt class="text-sm text-gray-500">Imię i nazwisko</dt>
                        <dd class="font-semibold text-gray-800">{{ $zwierze->uzytkownik->imie }} {{ $zwierze->uzytkownik->nazwisko }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Email</dt>
                        <dd class="font-semibold text-gray-800">{{ $zwierze->uzytkownik->email }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Telefon</dt>
                        <dd class="font-semibold text-gray-800">{{ $zwierze->uzytkownik->telefon ?? 'Brak' }}</dd>
                    </div>
                    @if($zwierze->uzytkownik->adres)
                    <div>
                        <dt class="text-sm text-gray-500">Adres</dt>
                        <dd class="font-semibold text-gray-800">
                            {{ $zwierze->uzytkownik->adres->ulica }} {{ $zwierze->uzytkownik->adres->nr_domu }}
                            @if($zwierze->uzytkownik->adres->nr_mieszkania)
                                /{{ $zwierze->uzytkownik->adres->nr_mieszkania }}
                            @endif
                            <br>
                            {{ $zwierze->uzytkownik->adres->kod_pocztowy }} {{ $zwierze->uzytkownik->adres->miasto }}
                        </dd>
                    </div>
                    @endif
                </dl>
            </div>
        </div>

        <!-- Historia wizyt i dokumentacja -->
        <div class="lg:col-span-2">
            <!-- Historia wizyt -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Historia wizyt ({{ $wizyty->count() }})
                </h2>
                
                @if($wizyty->count() > 0)
                    <div class="space-y-4">
                        @foreach($wizyty as $wizyta)
                            <div class="border-l-4 @if($wizyta->status === 'zakonczona') border-green-500 @elseif($wizyta->status === 'umowiona') border-blue-500 @else border-gray-300 @endif bg-gray-50 p-4 rounded-r-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <span class="font-semibold text-gray-800">{{ $wizyta->data_wizyty->format('d.m.Y H:i') }}</span>
                                        <span class="text-gray-500 text-sm ml-2">
                                            Lekarz: {{ $wizyta->lekarz ? $wizyta->lekarz->imie . ' ' . $wizyta->lekarz->nazwisko : 'Nieprzydzielony' }}
                                        </span>
                                    </div>
                                    @if($wizyta->status === 'zakonczona')
                                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm">Zakończona</span>
                                    @elseif($wizyta->status === 'umowiona')
                                        <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-sm">Umówiona</span>
                                    @elseif($wizyta->status === 'oczekujaca')
                                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm">Oczekująca</span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm">Anulowana</span>
                                    @endif
                                </div>
                                <p class="text-gray-600 text-sm mb-2">
                                    <strong>Zgłoszenie:</strong> {{ $wizyta->opis_zgloszenia }}
                                </p>
                                @if($wizyta->uslugi->count() > 0)
                                    <p class="text-gray-600 text-sm">
                                        <strong>Usługi:</strong> {{ $wizyta->uslugi->pluck('nazwa')->join(', ') }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Brak historii wizyt.</p>
                @endif
            </div>

            <!-- Dokumentacja medyczna -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Dokumentacja medyczna ({{ $dokumentacje->count() }})
                </h2>
                
                @if($dokumentacje->count() > 0)
                    <div class="space-y-4">
                        @foreach($dokumentacje as $doc)
                            <div class="bg-gray-50 p-4 rounded-lg border">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="font-semibold text-gray-800">{{ $doc->created_at->format('d.m.Y') }}</span>
                                    <span class="text-gray-500 text-sm">ID wizyty: {{ $doc->wizyta_id }}</span>
                                </div>
                                @if($doc->rozpoznanie)
                                    <p class="text-gray-600 text-sm mb-1">
                                        <strong>Rozpoznanie:</strong> {{ $doc->rozpoznanie }}
                                    </p>
                                @endif
                                @if($doc->zalecenia)
                                    <p class="text-gray-600 text-sm mb-1">
                                        <strong>Zalecenia:</strong> {{ $doc->zalecenia }}
                                    </p>
                                @endif
                                @if($doc->uwagi)
                                    <p class="text-gray-600 text-sm">
                                        <strong>Uwagi:</strong> {{ $doc->uwagi }}
                                    </p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500">Brak dokumentacji medycznej.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
