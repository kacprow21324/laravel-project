@extends('layouts.main')

@section('title', 'Rejestracja - VetCare Klinika')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <svg class="w-12 h-12 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Rejestracja</h1>
            <p class="text-gray-600 mt-2">Załóż konto i zacznij dbać o swojego pupila</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert" aria-live="assertive">
                <strong class="font-bold">Błędy walidacji:</strong>
                <ul class="list-disc list-inside mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.submit') }}" aria-label="Formularz rejestracji">
            @csrf
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label for="imie" class="block text-gray-700 font-semibold mb-2">
                        Imię <span class="text-red-600" aria-label="pole wymagane">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="imie" 
                        name="imie" 
                        value="{{ old('imie') }}"
                        required
                        autofocus
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                        placeholder="Jan"
                        aria-required="true"
                    >
                    @error('imie')
                        <span class="error-message" role="alert">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="nazwisko" class="block text-gray-700 font-semibold mb-2">
                        Nazwisko <span class="text-red-600" aria-label="pole wymagane">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="nazwisko" 
                        name="nazwisko" 
                        value="{{ old('nazwisko') }}"
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                        placeholder="Kowalski"
                        aria-required="true"
                    >
                    @error('nazwisko')
                        <span class="error-message" role="alert">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 font-semibold mb-2">
                    Adres e-mail <span class="text-red-600" aria-label="pole wymagane">*</span>
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                    placeholder="twoj@email.pl"
                    aria-required="true"
                    aria-describedby="email-help"
                >
                <p id="email-help" class="text-sm text-gray-500 mt-1">Ten adres będzie służył do logowania</p>
                @error('email')
                    <span class="error-message" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="telefon" class="block text-gray-700 font-semibold mb-2">
                    Numer telefonu <span class="text-gray-500 text-sm">(opcjonalne)</span>
                </label>
                <input 
                    type="tel" 
                    id="telefon" 
                    name="telefon" 
                    value="{{ old('telefon') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                    placeholder="+48 123 456 789"
                    aria-describedby="telefon-help"
                >
                <p id="telefon-help" class="text-sm text-gray-500 mt-1">Ułatwi kontakt w sprawie wizyt</p>
                @error('telefon')
                    <span class="error-message" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="haslo" class="block text-gray-700 font-semibold mb-2">
                    Hasło <span class="text-red-600" aria-label="pole wymagane">*</span>
                </label>
                <input 
                    type="password" 
                    id="haslo" 
                    name="haslo" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                    placeholder="Minimum 6 znaków"
                    aria-required="true"
                    aria-describedby="haslo-help"
                >
                <p id="haslo-help" class="text-sm text-gray-500 mt-1">Minimum 6 znaków</p>
                @error('haslo')
                    <span class="error-message" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="haslo_confirmation" class="block text-gray-700 font-semibold mb-2">
                    Potwierdź hasło <span class="text-red-600" aria-label="pole wymagane">*</span>
                </label>
                <input 
                    type="password" 
                    id="haslo_confirmation" 
                    name="haslo_confirmation" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                    placeholder="Powtórz hasło"
                    aria-required="true"
                >
            </div>

            <button 
                type="submit" 
                class="w-full bg-teal-600 text-white py-3 px-4 rounded-lg font-bold text-lg hover:bg-teal-700 transition focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2"
            >
                Zarejestruj się
            </button>
        </form>

        <div class="mt-6 text-center text-gray-600">
            <p>Masz już konto? 
                <a href="{{ route('login') }}" class="text-teal-600 hover:underline font-semibold">
                    Zaloguj się
                </a>
            </p>
        </div>

        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <p class="text-sm text-blue-800">
                <strong>ℹ️ Informacja:</strong> Po rejestracji automatycznie utworzymy dla Ciebie konto klienta. 
                Będziesz mógł dodawać swoje zwierzęta i umawiać wizyty online.
            </p>
        </div>
    </div>
</div>
@endsection
