@extends('layouts.main')

@section('title', 'Karta pacjenta: {{ $zwierze->imie }} - VetCare Klinika')

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
                    <p class="text-gray-600">Karta pacjenta - {{ $zwierze->gatunek->nazwa ?? 'Nieznany gatunek' }}</p>
                </div>
            </div>
            <a href="{{ route('client.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Powrót do panelu
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
                        <dd class="font-semibold text-gray-800">{{ $zwierze->gatunek->nazwa ?? '-' }}</dd>
                    </div>
                    @if($zwierze->rasa)
                    <div>
                        <dt class="text-sm text-gray-500">Rasa</dt>
                        <dd class="font-semibold text-gray-800">{{ $zwierze->rasa }}</dd>
                    </div>
                    @endif
                    <div>
                        <dt class="text-sm text-gray-500">Płeć</dt>
                        <dd class="font-semibold text-gray-800">
                            @if($zwierze->plec === 'samiec')
                                <span class="text-blue-600">♂ Samiec</span>
                            @elseif($zwierze->plec === 'samica')
                                <span class="text-pink-600">♀ Samica</span>
                            @else
                                {{ ucfirst($zwierze->plec ?? '-') }}
                            @endif
                        </dd>
                    </div>
                    @if($zwierze->data_urodzenia)
                    <div>
                        <dt class="text-sm text-gray-500">Data urodzenia</dt>
                        <dd class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($zwierze->data_urodzenia)->format('d.m.Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm text-gray-500">Wiek</dt>
                        <dd class="font-semibold text-gray-800">
                            @php
                                $wiek = \Carbon\Carbon::parse($zwierze->data_urodzenia)->age;
                            @endphp
                            {{ $wiek }} {{ $wiek == 1 ? 'rok' : ($wiek >= 2 && $wiek <= 4 ? 'lata' : 'lat') }}
                        </dd>
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

            <!-- Statystyki wizyt -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                    Statystyki
                </h2>
                <div class="space-y-3">
                    <div class="flex justify-between items-center p-3 bg-teal-50 rounded-lg">
                        <span class="text-gray-600">Wszystkie wizyty</span>
                        <span class="text-2xl font-bold text-teal-600">{{ $wizyty->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                        <span class="text-gray-600">Zakończone</span>
                        <span class="text-2xl font-bold text-green-600">{{ $wizyty->where('status', 'zakonczona')->count() }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                        <span class="text-gray-600">Zaplanowane</span>
                        <span class="text-2xl font-bold text-blue-600">{{ $wizyty->whereIn('status', ['umowiona', 'oczekujaca'])->count() }}</span>
                    </div>
                </div>
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
                            <div class="border-l-4 @if($wizyta->status === 'zakonczona') border-green-500 @elseif($wizyta->status === 'umowiona') border-blue-500 @elseif($wizyta->status === 'oczekujaca') border-yellow-500 @else border-red-300 @endif bg-gray-50 p-4 rounded-r-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <span class="font-semibold text-gray-800">{{ $wizyta->data_wizyty->format('d.m.Y H:i') }}</span>
                                        <span class="text-gray-500 text-sm ml-2">
                                            Lekarz: {{ $wizyta->lekarz ? 'dr ' . $wizyta->lekarz->imie . ' ' . $wizyta->lekarz->nazwisko : 'Nieprzydzielony' }}
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
                                    <strong>Zgłoszenie:</strong> {{ $wizyta->opis_zgloszenia ?? '-' }}
                                </p>
                                
                                @if($wizyta->dokumentacjaMedyczna)
                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                        <p class="text-teal-700 font-semibold text-sm mb-1">Dokumentacja medyczna:</p>
                                        @if($wizyta->dokumentacjaMedyczna->temperatura)
                                            <p class="text-gray-600 text-sm">
                                                <strong>Temperatura:</strong> 
                                                <span class="text-teal-600 font-bold">{{ number_format($wizyta->dokumentacjaMedyczna->temperatura, 1, ',', '') }}°C</span>
                                            </p>
                                        @endif
                                        @if($wizyta->dokumentacjaMedyczna->rozpoznanie)
                                            <p class="text-gray-600 text-sm"><strong>Rozpoznanie:</strong> {{ $wizyta->dokumentacjaMedyczna->rozpoznanie }}</p>
                                        @endif
                                        @if($wizyta->dokumentacjaMedyczna->zalecenia)
                                            <p class="text-gray-600 text-sm"><strong>Zalecenia:</strong> {{ $wizyta->dokumentacjaMedyczna->zalecenia }}</p>
                                        @endif
                                    </div>
                                @endif
                                
                                @if($wizyta->leki && $wizyta->leki->count() > 0)
                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                        <p class="text-blue-700 font-semibold text-sm mb-2">Przepisane leki:</p>
                                        <div class="flex flex-wrap gap-2">
                                            @foreach($wizyta->leki as $lek)
                                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs">
                                                    {{ $lek->nazwa }} ({{ $lek->pivot->ilosc_zuzyta }} {{ $lek->jednostka }})
                                                </span>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                
                                @if($wizyta->uslugi && $wizyta->uslugi->count() > 0)
                                    <div class="mt-2">
                                        <p class="text-gray-600 text-sm">
                                            <strong>Usługi:</strong> {{ $wizyta->uslugi->pluck('nazwa')->join(', ') }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-gray-50 border border-gray-200 text-gray-600 px-6 py-8 rounded-lg text-center">
                        <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <p class="text-lg">Brak historii wizyt.</p>
                        <p class="text-sm text-gray-500 mt-1">Gdy umówisz wizytę, pojawi się tutaj.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
