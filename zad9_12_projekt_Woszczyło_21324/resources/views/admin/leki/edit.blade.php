@extends('layouts.main')

@section('title', 'Edytuj Lek - VetCare Klinika')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Nagłówek -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edytuj Lek
                </h1>
                <p class="text-gray-600 mt-2">Edycja: <strong>{{ $lek->nazwa }}</strong></p>
            </div>
            <a href="{{ route('admin.leki') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Powrót do magazynu
            </a>
        </div>
    </div>

    <!-- Formularz -->
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-2xl mx-auto">
        <form action="{{ route('admin.leki.update', $lek->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="nazwa" class="block text-sm font-medium text-gray-700 mb-2">Nazwa leku *</label>
                <input type="text" name="nazwa" id="nazwa" required value="{{ old('nazwa', $lek->nazwa) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nazwa') border-red-500 @enderror"
                       placeholder="np. Amoksycylina">
                @error('nazwa')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid md:grid-cols-3 gap-6">
                <div>
                    <label for="ilosc_na_stanie" class="block text-sm font-medium text-gray-700 mb-2">Ilość na stanie *</label>
                    <input type="number" name="ilosc_na_stanie" id="ilosc_na_stanie" required min="0" value="{{ old('ilosc_na_stanie', $lek->ilosc_na_stanie) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('ilosc_na_stanie') border-red-500 @enderror"
                           placeholder="np. 100">
                    @error('ilosc_na_stanie')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="jednostka" class="block text-sm font-medium text-gray-700 mb-2">Jednostka *</label>
                    <input type="text" name="jednostka" id="jednostka" required value="{{ old('jednostka', $lek->jednostka) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('jednostka') border-red-500 @enderror"
                           placeholder="np. ml, tabl.">
                    @error('jednostka')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="cena_jednostkowa" class="block text-sm font-medium text-gray-700 mb-2">Cena jednostkowa (zł) *</label>
                    <input type="number" name="cena_jednostkowa" id="cena_jednostkowa" required min="0" step="0.01" value="{{ old('cena_jednostkowa', $lek->cena_jednostkowa) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('cena_jednostkowa') border-red-500 @enderror"
                           placeholder="np. 15.50">
                    @error('cena_jednostkowa')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Podsumowanie aktualnego stanu -->
            <div class="bg-gray-50 rounded-lg p-4">
                <h3 class="font-semibold text-gray-700 mb-2">Aktualny stan:</h3>
                <div class="grid md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <span class="text-gray-500">Stan magazynowy:</span>
                        <p class="font-bold @if($lek->ilosc_na_stanie == 0) text-red-600 @elseif($lek->ilosc_na_stanie < 10) text-yellow-600 @else text-green-600 @endif">
                            {{ $lek->ilosc_na_stanie }} {{ $lek->jednostka }}
                        </p>
                    </div>
                    <div>
                        <span class="text-gray-500">Cena:</span>
                        <p class="font-bold text-gray-800">{{ number_format($lek->cena_jednostkowa, 2, ',', ' ') }} zł</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Wartość:</span>
                        <p class="font-bold text-gray-800">{{ number_format($lek->cena_jednostkowa * $lek->ilosc_na_stanie, 2, ',', ' ') }} zł</p>
                    </div>
                    <div>
                        <span class="text-gray-500">Status:</span>
                        @if($lek->ilosc_na_stanie == 0)
                            <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-xs font-semibold">Brak</span>
                        @elseif($lek->ilosc_na_stanie < 10)
                            <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-semibold">Niski stan</span>
                        @else
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">Dostępny</span>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="pt-4">
                <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Zapisz zmiany
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
