<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Klinika Weterynaryjna VetCare')</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* ========== WCAG 2.1 AA - FOCUS INDICATORS ========== */
        *:focus-visible {
            outline: 3px solid #0056b3 !important;
            outline-offset: 2px !important;
            box-shadow: 0 0 0 3px rgba(0, 86, 179, 0.3) !important;
        }

        .skip-link {
            position: absolute;
            top: -40px;
            left: 0;
            background: #0056b3;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            font-weight: bold;
            z-index: 9999;
        }
        .skip-link:focus {
            top: 0;
        }

        /* HIGH CONTRAST MODE */
        body.high-contrast {
            background-color: #000000 !important;
            color: #FFFF00 !important;
        }
        body.high-contrast .bg-white,
        body.high-contrast .bg-gray-50,
        body.high-contrast .bg-gray-100 {
            background-color: #000000 !important;
            color: #FFFF00 !important;
            border: 2px solid #FFFF00 !important;
        }
        body.high-contrast .bg-teal-600,
        body.high-contrast .bg-green-600,
        body.high-contrast .bg-red-600,
        body.high-contrast .bg-yellow-400 {
            background-color: #000000 !important;
            color: #FFFF00 !important;
            border: 2px solid #FFFF00 !important;
        }
        body.high-contrast .text-gray-400,
        body.high-contrast .text-gray-500,
        body.high-contrast .text-gray-600,
        body.high-contrast .text-gray-700,
        body.high-contrast .text-white {
            color: #FFFF00 !important;
        }
        body.high-contrast a {
            color: #00FFFF !important;
            text-decoration: underline !important;
        }
        body.high-contrast button,
        body.high-contrast input,
        body.high-contrast select {
            background-color: #000000 !important;
            color: #FFFF00 !important;
            border: 2px solid #FFFF00 !important;
        }
    </style>
    
    @yield('styles')
</head>
<body class="min-h-screen bg-gray-50 flex flex-col">
    <a href="#main-content" class="skip-link">Przejdź do głównej treści</a>

    <!-- HEADER -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="text-2xl font-bold text-teal-700 flex items-center gap-2">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                    <span>VetCare</span>
                </a>
                
                <!-- Nawigacja środek -->
                <div class="hidden lg:flex items-center gap-6">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-teal-600 font-medium">Strona główna</a>
                    <a href="{{ url('/#o-nas') }}" class="text-gray-700 hover:text-teal-600 font-medium">O nas</a>
                    <a href="{{ url('/#oferta') }}" class="text-gray-700 hover:text-teal-600 font-medium">Oferta</a>
                </div>

                <!-- Narzędzia -->
                <div class="flex items-center gap-2 flex-wrap">
                    <!-- Font Resize Widget -->
                    <div class="flex items-center gap-1 bg-gray-100 rounded p-1">
                        <button onclick="changeFontSize('decrease')" class="px-2 py-1 text-sm font-bold hover:bg-white rounded" title="Zmniejsz czcionkę">A-</button>
                        <button onclick="changeFontSize('reset')" class="px-2 py-1 text-base font-bold hover:bg-white rounded" title="Normalna czcionka">A</button>
                        <button onclick="changeFontSize('increase')" class="px-2 py-1 text-lg font-bold hover:bg-white rounded" title="Powiększ czcionkę">A+</button>
                    </div>

                    <!-- Contrast Toggle -->
                    <button id="contrast-toggle" onclick="toggleContrast()" class="bg-yellow-400 text-black px-3 py-2 rounded text-sm font-semibold hover:bg-yellow-300" title="Wysoki kontrast">
                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    
                    @guest
                        <a href="{{ route('login') }}" class="bg-teal-600 text-white px-4 py-2 rounded font-semibold hover:bg-teal-700">Zaloguj</a>
                        <a href="{{ route('register') }}" class="hidden md:inline-block bg-gray-600 text-white px-4 py-2 rounded font-semibold hover:bg-gray-700">Rejestracja</a>
                    @else
                        <span class="text-sm hidden md:inline">Witaj, <strong>{{ auth()->user()->imie }}</strong>!</span>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-teal-600 hover:text-teal-800">Panel Admina</a>
                        @elseif(auth()->user()->isWeterynarz())
                            <a href="{{ route('staff.dashboard') }}" class="text-teal-600 hover:text-teal-800">Panel Lekarza</a>
                        @else
                            <a href="{{ route('client.dashboard') }}" class="text-teal-600 hover:text-teal-800">Mój Panel</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded font-semibold hover:bg-red-700">Wyloguj</button>
                        </form>
                    @endguest
                </div>
            </div>
        </nav>
    </header>

    <!-- MAIN -->
    <main id="main-content" class="flex-grow" role="main">
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded container mx-auto mt-4" role="alert">
                <strong>Sukces:</strong> {{ session('success') }}
            </div>
        @endif
        
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded container mx-auto mt-4" role="alert">
                <strong>Błąd:</strong> {{ session('error') }}
            </div>
        @endif
        
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-gray-900 text-white py-10 mt-auto">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 mb-6">
                <div>
                    <h3 class="text-lg font-bold mb-4">VetCare Klinika</h3>
                    <p class="text-gray-400">Profesjonalna opieka weterynaryjna od 2010 roku.</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Kontakt</h3>
                    <p class="text-gray-400">14-420 Młynary</p>
                    <p class="text-gray-400">ul. Testownikowa 15</p>
                    <p class="text-gray-400">Tel: +48 123 456 789</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Godziny otwarcia</h3>
                    <p class="text-gray-400">Pon-Pt: 8:00 - 20:00</p>
                    <p class="text-gray-400">Sob: 9:00 - 15:00</p>
                    <p class="text-gray-400">Nd: Zamknięte</p>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-6 text-center text-gray-400 text-sm">
                <p>&copy; 2025 Klinika Weterynaryjna. Projekt: Kacper Woszczyło 21324</p>
            </div>
        </div>
    </footer>

    <!-- JAVASCRIPT -->
    <script>
        // Font Size Control
        function changeFontSize(action) {
            const sizes = [90, 100, 110, 120];
            let current = parseInt(localStorage.getItem('fontSize') || '100');
            let index = sizes.indexOf(current);
            
            if (action === 'increase' && index < sizes.length - 1) index++;
            else if (action === 'decrease' && index > 0) index--;
            else if (action === 'reset') index = 1;
            
            const newSize = sizes[index];
            document.documentElement.style.fontSize = newSize + '%';
            localStorage.setItem('fontSize', newSize);
        }
        
        // Contrast Toggle
        function toggleContrast() {
            document.body.classList.toggle('high-contrast');
            const isHigh = document.body.classList.contains('high-contrast');
            localStorage.setItem('highContrast', isHigh);
            document.getElementById('contrast-toggle').setAttribute('aria-pressed', isHigh);
        }
        
        // Load preferences
        document.addEventListener('DOMContentLoaded', function() {
            const fontSize = localStorage.getItem('fontSize');
            if (fontSize) document.documentElement.style.fontSize = fontSize + '%';
            
            if (localStorage.getItem('highContrast') === 'true') {
                document.body.classList.add('high-contrast');
                document.getElementById('contrast-toggle').setAttribute('aria-pressed', 'true');
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>
