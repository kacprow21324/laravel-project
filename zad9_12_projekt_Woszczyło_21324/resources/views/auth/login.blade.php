@extends('layouts.main')

@section('title', 'Logowanie - VetCare Klinika')

@section('content')
<section class="min-h-[70vh] flex items-center justify-center py-12 px-4 bg-gradient-to-b from-gray-50 to-white" aria-labelledby="login-heading">
    <div class="max-w-md w-full bg-white rounded-2xl shadow-2xl p-8 border border-gray-100 transform hover:scale-[1.01] transition-all duration-300">
        <div class="text-center mb-8">
            <div class="flex justify-center mb-4">
                <div class="bg-gradient-to-r from-teal-500 to-cyan-500 rounded-2xl p-4 shadow-lg">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
            </div>
            <h1 id="login-heading" class="text-3xl font-bold bg-gradient-to-r from-gray-800 to-gray-600 bg-clip-text text-transparent">Logowanie</h1>
            <p class="text-gray-600 mt-2">Zaloguj się do swojego konta</p>
        </div>

        @if($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 px-4 py-3 rounded-r-lg mb-6" role="alert" aria-live="assertive">
                <strong class="font-bold">Błędy walidacji:</strong>
                <ul class="list-disc list-inside mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}" aria-label="Formularz logowania">
            @csrf
            
            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-semibold mb-2">
                    Adres e-mail <span class="text-red-600" aria-hidden="true">*</span><span class="sr-only">(pole wymagane)</span>
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required
                    autofocus
                    autocomplete="email"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow"
                    placeholder="twoj@email.pl"
                    aria-describedby="email-help"
                >
                <p id="email-help" class="text-sm text-gray-500 mt-1">Podaj adres e-mail używany podczas rejestracji</p>
                @error('email')
                    <span class="text-red-500 text-sm mt-1 block" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-6">
                <label for="haslo" class="block text-gray-700 font-semibold mb-2">
                    Hasło <span class="text-red-600" aria-hidden="true">*</span><span class="sr-only">(pole wymagane)</span>
                </label>
                <input 
                    type="password" 
                    id="haslo" 
                    name="haslo" 
                    required
                    autocomplete="current-password"
                    class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all duration-200 shadow-sm hover:shadow"
                    placeholder="********"
                >
                @error('haslo')
                    <span class="text-red-500 text-sm mt-1 block" role="alert">{{ $message }}</span>
                @enderror
            </div>

            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-teal-500 to-cyan-500 text-white py-3 px-4 rounded-xl font-bold text-lg hover:from-teal-600 hover:to-cyan-600 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2"
            >
                Zaloguj się
            </button>
        </form>

        <!-- Separator -->
        <div class="flex items-center my-6" role="separator">
            <div class="flex-grow border-t border-gray-200"></div>
            <span class="px-4 text-gray-500 text-sm">lub</span>
            <div class="flex-grow border-t border-gray-200"></div>
        </div>

        <!-- Przycisk rejestracji -->
        <a href="{{ route('register') }}" class="block w-full text-center bg-gradient-to-r from-gray-100 to-gray-200 text-gray-800 py-3 px-4 rounded-xl font-bold text-lg hover:from-gray-200 hover:to-gray-300 transition-all duration-300 shadow-md hover:shadow-lg border border-gray-200">
            <span class="flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
                Zarejestruj się
            </span>
        </a>

        <!-- Informacje testowe -->
        <aside class="mt-8 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200" aria-label="Konta testowe">
            <p class="text-sm text-gray-600 font-semibold mb-2">Konta testowe:</p>
            <ul class="text-sm text-gray-600 space-y-1">
                <li><strong>Admin:</strong> admin@klinika.pl / haslo123</li>
                <li><strong>Lekarz:</strong> lekarz@klinika.pl / haslo123</li>
                <li><strong>Klient:</strong> klient@klinika.pl / haslo123</li>
            </ul>
        </aside>
    </div>
</section>
@endsection
