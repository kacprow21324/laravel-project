@extends('layouts.main')

@section('title', 'VetCare Klinika Weterynaryjna - Strona Główna')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-teal-600 to-teal-800 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <div class="flex justify-center mb-6">
                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
            <h1 class="text-5xl font-bold mb-6">
                Profesjonalna Opieka Weterynaryjna
            </h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Zapewniamy kompleksową opiekę zdrowotną dla Twoich pupili. 
                Nasi doświadczeni weterynarze są tu dla Ciebie i Twojego zwierzaka.
            </p>
            <div class="flex justify-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="bg-white text-teal-700 px-8 py-3 rounded-lg font-bold text-lg hover:bg-gray-100 transition shadow-lg">
                        Zaloguj się
                    </a>
                @else
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="bg-white text-teal-700 px-8 py-3 rounded-lg font-bold text-lg hover:bg-gray-100 transition shadow-lg">
                            Panel Administratora
                        </a>
                    @elseif(auth()->user()->isWeterynarz())
                        <a href="{{ route('staff.dashboard') }}" class="bg-white text-teal-700 px-8 py-3 rounded-lg font-bold text-lg hover:bg-gray-100 transition shadow-lg">
                            Panel Lekarza
                        </a>
                    @else
                        <a href="{{ route('client.dashboard') }}" class="bg-white text-teal-700 px-8 py-3 rounded-lg font-bold text-lg hover:bg-gray-100 transition shadow-lg">
                            Mój Panel
                        </a>
                    @endif
                @endguest
                <a href="#oferta" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-white hover:text-teal-700 transition">
                    Nasza Oferta
                </a>
            </div>
        </div>
    </section>

    <!-- O nas Section -->
    <section id="o-nas" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">O Nas</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-gray-50 rounded-lg shadow">
                    <div class="mb-4 flex justify-center">
                        <svg class="w-12 h-12 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Doświadczony Zespół</h3>
                    <p class="text-gray-600">
                        Nasi weterynarze to specjaliści z wieloletnim doświadczeniem w leczeniu zwierząt domowych i egzotycznych.
                    </p>
                </div>
                <div class="text-center p-6 bg-gray-50 rounded-lg shadow">
                    <div class="mb-4 flex justify-center">
                        <svg class="w-12 h-12 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Nowoczesny Sprzęt</h3>
                    <p class="text-gray-600">
                        Dysponujemy najnowocześniejszym sprzętem diagnostycznym: USG, RTG, laboratorium analityczne.
                    </p>
                </div>
                <div class="text-center p-6 bg-gray-50 rounded-lg shadow">
                    <div class="mb-4 flex justify-center">
                        <svg class="w-12 h-12 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Miłość do Zwierząt</h3>
                    <p class="text-gray-600">
                        Każde zwierzę traktujemy jak własne. Zapewniamy ciepłą atmosferę i indywidualne podejście.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Oferta Section -->
    <section id="oferta" class="py-16 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12 text-gray-800">Nasza Oferta</h2>
            <div class="grid md:grid-cols-4 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="mb-4 flex justify-center">
                        <svg class="w-10 h-10 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">Konsultacje</h3>
                    <p class="text-gray-600 text-sm mb-3">Kompleksowe badania i diagnostyka</p>
                    <p class="text-teal-600 font-bold">od 150 zł</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="mb-4 flex justify-center">
                        <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">Szczepienia</h3>
                    <p class="text-gray-600 text-sm mb-3">Ochrona przed chorobami zakaźnymi</p>
                    <p class="text-teal-600 font-bold">od 120 zł</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="mb-4 flex justify-center">
                        <svg class="w-10 h-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">Badania laboratoryjne</h3>
                    <p class="text-gray-600 text-sm mb-3">Analiza krwi, moczu i więcej</p>
                    <p class="text-teal-600 font-bold">od 250 zł</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="mb-4 flex justify-center">
                        <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">Chirurgia</h3>
                    <p class="text-gray-600 text-sm mb-3">Zabiegi operacyjne i kastracje</p>
                    <p class="text-teal-600 font-bold">od 400 zł</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-teal-700 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Umów wizytę już dziś!</h2>
            <p class="text-xl mb-8">Zadzwoń lub zaloguj się, aby umówić wizytę online</p>
            <div class="flex justify-center gap-4 flex-wrap">
                <a href="tel:+48123456789" class="bg-white text-teal-700 px-8 py-3 rounded-lg font-bold text-lg hover:bg-gray-100 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    +48 123 456 789
                </a>
                @guest
                    <a href="{{ route('login') }}" class="bg-yellow-400 text-black px-8 py-3 rounded-lg font-bold text-lg hover:bg-yellow-300 transition">
                        Zaloguj się
                    </a>
                @endguest
            </div>
        </div>
    </section>
@endsection
