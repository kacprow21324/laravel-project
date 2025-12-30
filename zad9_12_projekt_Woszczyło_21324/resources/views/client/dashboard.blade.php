@extends('layouts.main')

@section('title', 'Panel Klienta - Klinika Weterynaryjna')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Nagłówek panelu -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">
                    👋 Witaj, {{ $user->imie }} {{ $user->nazwisko }}!
                </h1>
                <p class="text-gray-600 mt-2">Panel Klienta - zarządzaj swoimi zwierzętami i wizytami</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-red-600 transition">
                    🚪 Wyloguj się
                </button>
            </form>
        </div>
    </div>

    <!-- Moje Zwierzaki -->
    <section class="mb-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">🐾 Moje Zwierzaki</h2>
        
        @if($zwierzeta->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($zwierzeta as $zwierze)
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                        <div class="flex items-center mb-4">
                            <div class="text-4xl mr-4">
                                @if($zwierze->gatunek->nazwa === 'Pies')
                                    🐕
                                @elseif($zwierze->gatunek->nazwa === 'Kot')
                                    🐈
                                @elseif($zwierze->gatunek->nazwa === 'Królik')
                                    🐰
                                @elseif($zwierze->gatunek->nazwa === 'Chomik')
                                    🐹
                                @elseif($zwierze->gatunek->nazwa === 'Papuga')
                                    🦜
                                @else
                                    🐾
                                @endif
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $zwierze->imie }}</h3>
                                <p class="text-gray-600">{{ $zwierze->gatunek->nazwa }}</p>
                            </div>
                        </div>
                        <div class="space-y-2 text-sm text-gray-600">
                            <p><strong>Płeć:</strong> {{ ucfirst($zwierze->plec) }}</p>
                            <p><strong>Data urodzenia:</strong> {{ $zwierze->data_urodzenia->format('d.m.Y') }}</p>
                            <p><strong>Waga:</strong> {{ number_format($zwierze->waga, 2, ',', ' ') }} kg</p>
                            @if($zwierze->nr_czipa)
                                <p><strong>Nr czipa:</strong> {{ $zwierze->nr_czipa }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-6 py-4 rounded-lg">
                <p>Nie masz jeszcze zarejestrowanych zwierząt. Skontaktuj się z kliniką, aby dodać swojego pupila.</p>
            </div>
        @endif
    </section>

    <!-- Historia Wizyt -->
    <section>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">📅 Historia Wizyt</h2>
        
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
                        @foreach($wizyty->take(10) as $wizyta)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    {{ $wizyta->data_wizyty->format('d.m.Y H:i') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wizyta->zwierze->imie }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $wizyta->lekarz->imie }} {{ $wizyta->lekarz->nazwisko }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($wizyta->status === 'zakończona')
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm">
                                            ✅ Zakończona
                                        </span>
                                    @elseif($wizyta->status === 'umówiona')
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm">
                                            📅 Umówiona
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm">
                                            ❌ Anulowana
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
                <p>Brak historii wizyt.</p>
            </div>
        @endif
    </section>
</div>
@endsection
