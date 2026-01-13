@extends('layouts.main')

@section('title', 'Dodaj Użytkownika - VetCare Klinika')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Nagłówek -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Dodaj Nowego Użytkownika
                </h1>
                <p class="text-gray-600 mt-2">Utwórz konto dla nowego użytkownika systemu</p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Powrót do listy
            </a>
        </div>
    </div>

    <!-- Formularz -->
    <div class="bg-white rounded-xl shadow-lg p-8 max-w-2xl mx-auto">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label for="imie" class="block text-sm font-medium text-gray-700 mb-2">Imię *</label>
                    <input type="text" name="imie" id="imie" required value="{{ old('imie') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('imie') border-red-500 @enderror"
                           placeholder="np. Jan">
                    @error('imie')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <div>
                    <label for="nazwisko" class="block text-sm font-medium text-gray-700 mb-2">Nazwisko *</label>
                    <input type="text" name="nazwisko" id="nazwisko" required value="{{ old('nazwisko') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('nazwisko') border-red-500 @enderror"
                           placeholder="np. Kowalski">
                    @error('nazwisko')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                <input type="email" name="email" id="email" required value="{{ old('email') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror"
                       placeholder="np. jan.kowalski@email.pl">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="telefon" class="block text-sm font-medium text-gray-700 mb-2">Telefon</label>
                <input type="text" name="telefon" id="telefon" value="{{ old('telefon') }}"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('telefon') border-red-500 @enderror"
                       placeholder="np. 123456789">
                @error('telefon')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="haslo" class="block text-sm font-medium text-gray-700 mb-2">Hasło *</label>
                <input type="password" name="haslo" id="haslo" required minlength="6"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('haslo') border-red-500 @enderror"
                       placeholder="Minimum 6 znaków">
                @error('haslo')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="rola_id" class="block text-sm font-medium text-gray-700 mb-2">Rola *</label>
                <select name="rola_id" id="rola_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('rola_id') border-red-500 @enderror">
                    <option value="">-- Wybierz rolę --</option>
                    @foreach($role as $rola)
                        <option value="{{ $rola->id }}" {{ old('rola_id') == $rola->id ? 'selected' : '' }}>
                            @if($rola->nazwa == 'admin')
                                Administrator
                            @elseif($rola->nazwa == 'weterynarz')
                                Weterynarz
                            @else
                                Klient
                            @endif
                        </option>
                    @endforeach
                </select>
                @error('rola_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="pt-4">
                <button type="submit" class="w-full bg-green-600 text-white py-3 px-4 rounded-lg font-semibold hover:bg-green-700 transition flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Utwórz użytkownika
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
