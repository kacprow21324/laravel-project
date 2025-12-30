<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Klinika Weterynaryjna')</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* Wersja kontrastowa - wysokie kontrasty dla WCAG */
        body.high-contrast {
            background-color: #000 !important;
            color: #fff !important;
        }
        body.high-contrast .bg-white {
            background-color: #000 !important;
            border: 2px solid #fff !important;
        }
        body.high-contrast .bg-blue-600,
        body.high-contrast .bg-green-600,
        body.high-contrast .bg-indigo-600 {
            background-color: #000 !important;
            border: 2px solid #ffff00 !important;
            color: #ffff00 !important;
        }
        body.high-contrast .text-gray-600,
        body.high-contrast .text-gray-700,
        body.high-contrast .text-gray-800,
        body.high-contrast .text-gray-900 {
            color: #fff !important;
        }
        body.high-contrast a {
            color: #ffff00 !important;
        }
        body.high-contrast .bg-gray-100,
        body.high-contrast .bg-gray-50 {
            background-color: #1a1a1a !important;
        }
        body.high-contrast th,
        body.high-contrast td {
            border: 1px solid #fff !important;
        }
    </style>
    
    @yield('styles')
</head>
<body class="min-h-screen bg-gray-50 flex flex-col">
    <!-- Nagłówek -->
    <header class="bg-blue-600 text-white shadow-lg">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <a href="{{ url('/') }}" class="text-2xl font-bold flex items-center gap-2">
                    🐾 Klinika Weterynaryjna
                </a>
                
                <div class="flex items-center gap-4">
                    <!-- Przycisk Wersji Kontrastowej -->
                    <button 
                        id="contrast-toggle" 
                        onclick="toggleContrast()"
                        class="bg-yellow-400 text-black px-3 py-1 rounded text-sm font-semibold hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        aria-label="Przełącz wersję kontrastową"
                    >
                        ◐ Kontrast
                    </button>
                    
                    @guest
                        <a href="{{ route('login') }}" class="bg-white text-blue-600 px-4 py-2 rounded font-semibold hover:bg-gray-100 transition">
                            Zaloguj się
                        </a>
                    @else
                        <span class="text-sm">Witaj, {{ auth()->user()->imie }}!</span>
                        @if(auth()->user()->isPracownik())
                            <a href="{{ route('staff.dashboard') }}" class="text-white hover:text-yellow-200">Panel</a>
                        @else
                            <a href="{{ route('client.dashboard') }}" class="text-white hover:text-yellow-200">Panel</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded font-semibold hover:bg-red-600 transition">
                                Wyloguj
                            </button>
                        </form>
                    @endguest
                </div>
            </div>
        </nav>
    </header>

    <!-- Główna treść -->
    <main class="flex-grow">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative container mx-auto mt-4" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative container mx-auto mt-4" role="alert">
                {{ session('error') }}
            </div>
        @endif
        
        @yield('content')
    </main>

    <!-- Stopka -->
    <footer class="bg-gray-800 text-white py-8 mt-auto">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">🐾 Klinika Weterynaryjna</h3>
                    <p class="text-gray-400">Profesjonalna opieka dla Twoich pupili od 2010 roku.</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Kontakt</h3>
                    <p class="text-gray-400">ul. Zwierzęca 15, 00-001 Warszawa</p>
                    <p class="text-gray-400">Tel: +48 123 456 789</p>
                    <p class="text-gray-400">Email: kontakt@klinika.pl</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Godziny otwarcia</h3>
                    <p class="text-gray-400">Pon-Pt: 8:00 - 20:00</p>
                    <p class="text-gray-400">Sob: 9:00 - 15:00</p>
                    <p class="text-gray-400">Nd: Zamknięte</p>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-4 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} Klinika Weterynaryjna. Wszelkie prawa zastrzeżone.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript dla wersji kontrastowej -->
    <script>
        function toggleContrast() {
            document.body.classList.toggle('high-contrast');
            const isHighContrast = document.body.classList.contains('high-contrast');
            localStorage.setItem('highContrast', isHighContrast);
        }
        
        // Przywróć ustawienia z localStorage
        document.addEventListener('DOMContentLoaded', function() {
            if (localStorage.getItem('highContrast') === 'true') {
                document.body.classList.add('high-contrast');
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>
