@extends('layouts.main')

@section('title', 'Edytuj Usługę - VetCare Klinika')

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
                    Edytuj Usługę
                </h1>
                <p class="text-gray-600 mt-2">Edycja: <strong>{{ $usluga->nazwa }}</strong></p>
            </div>
            <a href="{{ route('admin.uslugi.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Powrót do listy
            </a>
        </div>
    </div>

    <!-- Formularz -->
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-2xl mx-auto">
        <form action="{{ route('admin.uslugi.update', $usluga->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label for="nazwa" class="block text-sm font-medium text-gray-700 mb-2">Nazwa usługi *</label>
                <input type="text" name="nazwa" id="nazwa" required value="{{ old('nazwa', $usluga->nazwa) }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('nazwa') border-red-500 @enderror"
                       placeholder="np. Badanie krwi">
                @error('nazwa')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="opis" class="block text-sm font-medium text-gray-700 mb-2">Opis</label>
                <textarea name="opis" id="opis" rows="4"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('opis') border-red-500 @enderror"
                          placeholder="Krótki opis usługi...">{{ old('opis', $usluga->opis) }}</textarea>
                @error('opis')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="cena_aktualna" class="block text-sm font-medium text-gray-700 mb-2">Cena (zł) *</label>
                    <input type="number" name="cena_aktualna" id="cena_aktualna" required min="0" step="0.01" value="{{ old('cena_aktualna', $usluga->cena_aktualna) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('cena_aktualna') border-red-500 @enderror"
                           placeholder="np. 150.00">
                    @error('cena_aktualna')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="czas_trwania_minuty" class="block text-sm font-medium text-gray-700 mb-2">Czas trwania (min)</label>
                    <input type="number" name="czas_trwania_minuty" id="czas_trwania_minuty" min="0" value="{{ old('czas_trwania_minuty', $usluga->czas_trwania_minuty) }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('czas_trwania_minuty') border-red-500 @enderror"
                           placeholder="np. 30">
                    @error('czas_trwania_minuty')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
