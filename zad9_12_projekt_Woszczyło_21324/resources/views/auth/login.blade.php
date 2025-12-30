@extends('layouts.main')

@section('title', 'Logowanie - Klinika Weterynaryjna')

@section('content')
<div class="min-h-[60vh] flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg p-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">🔐 Logowanie</h1>
            <p class="text-gray-600 mt-2">Zaloguj się do swojego konta</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            
            <div class="mb-6">
                <label for="email" class="block text-gray-700 font-semibold mb-2">
                    Adres e-mail
                </label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="twoj@email.pl"
                    aria-describedby="email-help"
                >
                <p id="email-help" class="text-sm text-gray-500 mt-1">Podaj adres e-mail używany podczas rejestracji</p>
            </div>

            <div class="mb-6">
                <label for="haslo" class="block text-gray-700 font-semibold mb-2">
                    Hasło
                </label>
                <input 
                    type="password" 
                    id="haslo" 
                    name="haslo" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="••••••••"
                >
            </div>

            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox h-5 w-5 text-blue-600 rounded">
                    <span class="ml-2 text-gray-700">Zapamiętaj mnie</span>
                </label>
            </div>

            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-bold text-lg hover:bg-blue-700 transition focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                Zaloguj się
            </button>
        </form>

        <div class="mt-6 text-center text-gray-600">
            <p>Nie masz konta? <a href="#" class="text-blue-600 hover:underline">Skontaktuj się z nami</a></p>
        </div>

        <!-- Informacje testowe -->
        <div class="mt-8 p-4 bg-gray-100 rounded-lg">
            <p class="text-sm text-gray-600 font-semibold mb-2">🧪 Konta testowe:</p>
            <ul class="text-sm text-gray-600 space-y-1">
                <li><strong>Admin:</strong> admin@klinika.pl / haslo123</li>
                <li><strong>Lekarz:</strong> lekarz@klinika.pl / haslo123</li>
                <li><strong>Klient:</strong> klient@klinika.pl / haslo123</li>
            </ul>
        </div>
    </div>
</div>
@endsection
