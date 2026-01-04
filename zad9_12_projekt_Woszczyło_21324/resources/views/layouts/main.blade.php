<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Klinika Weterynaryjna VetCare')</title>
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    @yield('styles')
</head>
<body class="min-h-screen bg-gray-50 flex flex-col">
    <a href="#main-content" class="skip-link">Przejdź do głównej treści</a>

    <!-- HEADER -->
    <header class="bg-white/95 backdrop-blur-md shadow-lg sticky top-0 z-50 border-b border-gray-100">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="text-2xl font-bold text-transparent bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text flex items-center gap-2 hover:scale-105 transition-transform duration-300">
                    <div class="bg-gradient-to-r from-teal-500 to-cyan-500 rounded-lg p-2">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <span>VetCare</span>
                </a>
                
                <!-- Nawigacja środek -->
                <div class="hidden lg:flex items-center gap-6">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-teal-600 font-medium transition-colors duration-200 relative group">
                        Strona główna
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-teal-500 to-cyan-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ url('/#o-nas') }}" class="text-gray-700 hover:text-teal-600 font-medium transition-colors duration-200 relative group">
                        O nas
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-teal-500 to-cyan-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                    <a href="{{ route('oferta') }}" class="text-gray-700 hover:text-teal-600 font-medium transition-colors duration-200 relative group">
                        Oferta
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-gradient-to-r from-teal-500 to-cyan-500 group-hover:w-full transition-all duration-300"></span>
                    </a>
                </div>

                <!-- Narzędzia -->
                <div class="flex items-center gap-2 flex-wrap">
                    <!-- Font Resize Widget -->
                    <div class="flex items-center gap-1 bg-gray-100 rounded-xl p-1 shadow-inner">
                        <button onclick="changeFontSize('decrease')" class="px-2 py-1 text-sm font-bold hover:bg-white rounded-lg transition-all duration-200" title="Zmniejsz czcionkę" aria-label="Zmniejsz rozmiar czcionki">A-</button>
                        <button onclick="changeFontSize('reset')" class="px-2 py-1 text-base font-bold hover:bg-white rounded-lg transition-all duration-200" title="Normalna czcionka" aria-label="Przywróć domyślny rozmiar czcionki">A</button>
                        <button onclick="changeFontSize('increase')" class="px-2 py-1 text-lg font-bold hover:bg-white rounded-lg transition-all duration-200" title="Powiększ czcionkę" aria-label="Powiększ rozmiar czcionki">A+</button>
                    </div>

                    <!-- Contrast Toggle -->
                    <button id="contrast-toggle" onclick="toggleContrast()" class="bg-gradient-to-r from-yellow-400 to-orange-400 text-black px-3 py-2 rounded-xl text-sm font-semibold hover:from-yellow-500 hover:to-orange-500 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105" title="Wysoki kontrast" aria-label="Przełącz tryb wysokiego kontrastu" aria-pressed="false">
                        <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                    
                    @guest
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-teal-500 to-cyan-500 text-white px-4 py-2 rounded-xl font-semibold hover:from-teal-600 hover:to-cyan-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">Zaloguj</a>
                        <a href="{{ route('register') }}" class="hidden md:inline-block bg-gradient-to-r from-gray-600 to-gray-700 text-white px-4 py-2 rounded-xl font-semibold hover:from-gray-700 hover:to-gray-800 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">Rejestracja</a>
                    @else
                        <span class="text-sm hidden md:inline text-gray-600">Witaj, <strong class="text-teal-600">{{ auth()->user()->imie }}</strong>!</span>
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="text-teal-600 hover:text-teal-800 font-medium">Panel Admina</a>
                        @elseif(auth()->user()->isWeterynarz())
                            <a href="{{ route('staff.dashboard') }}" class="text-teal-600 hover:text-teal-800 font-medium">Panel Lekarza</a>
                        @else
                            <a href="{{ route('client.dashboard') }}" class="text-teal-600 hover:text-teal-800 font-medium">Mój Panel</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="bg-gradient-to-r from-red-500 to-rose-500 text-white px-4 py-2 rounded-xl font-semibold hover:from-red-600 hover:to-rose-600 transition-all duration-300 shadow-md hover:shadow-lg transform hover:scale-105">Wyloguj</button>
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
    <footer class="bg-gradient-to-b from-gray-900 to-gray-950 text-white py-12 mt-auto">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-3 gap-8 mb-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bg-gradient-to-r from-teal-500 to-cyan-500 rounded-lg p-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold bg-gradient-to-r from-teal-400 to-cyan-400 bg-clip-text text-transparent">VetCare Klinika</h3>
                    </div>
                    <p class="text-gray-400 leading-relaxed">Profesjonalna opieka weterynaryjna od 2010 roku. Twój pupil w najlepszych rękach.</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4 text-white">Kontakt</h3>
                    <div class="space-y-2">
                        <p class="text-gray-400 flex items-center gap-2">
                            <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            Młynary 14-420, ul. Testownikowa
                        </p>
                        <p class="text-gray-400 flex items-center gap-2">
                            <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Tel: +48 123 456 789
                        </p>
                        <p class="text-gray-400 flex items-center gap-2">
                            <svg class="w-4 h-4 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            kontakt@vetcare.pl
                        </p>
                    </div>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4 text-white">Godziny otwarcia</h3>
                    <div class="space-y-2 text-gray-400">
                        <p class="flex justify-between"><span>Pon-Pt:</span> <span class="text-white font-medium">8:00 - 20:00</span></p>
                        <p class="flex justify-between"><span>Sob:</span> <span class="text-white font-medium">9:00 - 15:00</span></p>
                        <p class="flex justify-between"><span>Nd:</span> <span class="text-red-400 font-medium">Zamknięte</span></p>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <p class="text-gray-500 text-sm">&copy; 2025 Klinika Weterynaryjna VetCare. Wszelkie prawa zastrzeżone.</p>
                    <p class="text-sm">
                        <span class="text-gray-500">Projekt:</span> 
                        <span class="font-bold bg-gradient-to-r from-teal-400 to-cyan-400 bg-clip-text text-transparent">Kacper Woszczyło 21324</span>
                    </p>
                </div>
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
