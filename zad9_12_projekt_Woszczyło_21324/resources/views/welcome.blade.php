@extends('layouts.main')

@section('title', 'VetCare Klinika Weterynaryjna - Strona Główna')

@section('content')
    <!-- Hero Section z lokalnym tłem -->
    <section class="relative min-h-[80vh] flex items-center justify-center" style="background-image: url('{{ asset('image/tlo.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">
        <!-- Overlay z gradientem -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/50 to-black/70"></div>
        
        <div class="container mx-auto px-4 text-center relative z-10 py-20">
            <!-- Ikona serca -->
            <div class="flex justify-center mb-8 animate-pulse">
                <div class="bg-white/10 backdrop-blur-sm rounded-full p-6 shadow-2xl">
                    <svg class="w-20 h-20 text-white drop-shadow-2xl" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
            </div>
            
            <!-- Główny napis -->
            <h1 class="text-5xl md:text-7xl font-extrabold mb-6 text-white drop-shadow-2xl leading-tight">
                Profesjonalna Opieka<br>
                <span class="bg-gradient-to-r from-teal-300 via-cyan-300 to-blue-300 bg-clip-text text-transparent">Weterynaryjna</span>
            </h1>
            
            <p class="text-xl md:text-2xl mb-10 max-w-3xl mx-auto text-white/90 drop-shadow-lg">
                Zapewniamy kompleksową opiekę zdrowotną dla Twoich pupili. 
                Nasi doświadczeni weterynarze są tu dla Ciebie i Twojego zwierzaka.
            </p>
            
            <!-- Przyciski CTA z gradientami i animacjami -->
            <div class="flex justify-center gap-4 flex-wrap">
                @guest
                    <a href="{{ route('login') }}" class="group bg-gradient-to-r from-teal-500 to-cyan-500 text-white px-8 py-4 rounded-2xl font-bold text-xl hover:from-teal-600 hover:to-cyan-600 transition-all duration-300 shadow-2xl transform hover:scale-105 hover:shadow-teal-500/50">
                        <span class="flex items-center gap-2">
                            <svg class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                            </svg>
                            Zaloguj się
                        </span>
                    </a>
                    <a href="{{ route('register') }}" class="bg-white/20 backdrop-blur-sm text-white border-2 border-white px-8 py-4 rounded-2xl font-bold text-xl hover:bg-white hover:text-teal-700 transition-all duration-300 shadow-2xl transform hover:scale-105">
                        Załóż konto
                    </a>
                @else
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-8 py-4 rounded-2xl font-bold text-xl hover:from-purple-600 hover:to-pink-600 transition-all duration-300 shadow-2xl transform hover:scale-105">
                            Panel Administratora
                        </a>
                    @elseif(auth()->user()->isWeterynarz())
                        <a href="{{ route('staff.dashboard') }}" class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-8 py-4 rounded-2xl font-bold text-xl hover:from-blue-600 hover:to-indigo-600 transition-all duration-300 shadow-2xl transform hover:scale-105">
                            Panel Lekarza
                        </a>
                    @else
                        <a href="{{ route('client.dashboard') }}" class="bg-gradient-to-r from-teal-500 to-cyan-500 text-white px-8 py-4 rounded-2xl font-bold text-xl hover:from-teal-600 hover:to-cyan-600 transition-all duration-300 shadow-2xl transform hover:scale-105">
                            Mój Panel
                        </a>
                    @endif
                @endguest
                
                <!-- Przycisk CTA "Umów wizytę" -->
                <a href="{{ route('oferta') }}" class="group bg-gradient-to-r from-yellow-400 to-orange-400 text-black px-8 py-4 rounded-2xl font-bold text-xl hover:from-yellow-500 hover:to-orange-500 transition-all duration-300 shadow-2xl transform hover:scale-105 hover:shadow-yellow-500/50">
                    <span class="flex items-center gap-2">
                        <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Umów wizytę
                    </span>
                </a>
            </div>
            
            <!-- Scroll indicator -->
            <div class="mt-16 animate-bounce">
                <svg class="w-8 h-8 mx-auto text-white/70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>

    <!-- O nas Section -->
    <section id="o-nas" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4 text-gray-800">O Nas</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
                Jesteśmy zespołem pasjonatów, którzy każdego dnia dbają o zdrowie i samopoczucie zwierząt.
            </p>
            
            <div class="grid md:grid-cols-2 gap-12 items-center mb-12">
                <div>
                    <img src="https://images.unsplash.com/photo-1576201836106-db1758fd1c97?w=600&h=400&fit=crop" alt="Weterynarz z psem" class="rounded-xl shadow-xl w-full h-[400px] object-cover">
                </div>
                <div>
                    <h3 class="text-3xl font-bold mb-4 text-gray-800">Doświadczony Zespół</h3>
                    <p class="text-gray-600 text-lg leading-relaxed mb-4">
                        Nasi weterynarze to specjaliści z wieloletnim doświadczeniem w leczeniu zwierząt domowych i egzotycznych. 
                        Każdy członek zespołu przeszedł rygorystyczne szkolenia i posiada aktualne certyfikaty.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Stawiamy na ciągły rozwój i uczestnictwo w konferencjach weterynaryjnych, aby być na bieżąco z najnowszymi metodami leczenia.
                    </p>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="order-2 md:order-1">
                    <h3 class="text-3xl font-bold mb-4 text-gray-800">Nowoczesny Sprzęt</h3>
                    <p class="text-gray-600 text-lg leading-relaxed mb-4">
                        Dysponujemy najnowocześniejszym sprzętem diagnostycznym: USG, RTG, laboratorium analityczne.
                        Nasze gabinety są klimatyzowane i wyposażone w sprzęt najwyższej klasy.
                    </p>
                    <p class="text-gray-600 text-lg leading-relaxed">
                        Zapewniamy pełną sterylizację narzędzi oraz przestrzegamy najwyższych standardów higienicznych.
                    </p>
                </div>
                <div class="order-1 md:order-2">
                    <img src="https://images.unsplash.com/photo-1530126483408-aa533e55bdb2?w=600&h=400&fit=crop" alt="Kot u weterynarza" class="rounded-xl shadow-xl w-full h-[400px] object-cover">
                </div>
            </div>
        </div>
    </section>

    <!-- Oferta Section -->
    <section id="oferta" class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-4 text-gray-800">Nasza Oferta</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">
                Oferujemy szeroki zakres usług weterynaryjnych dostosowanych do potrzeb Twojego pupila.
            </p>
            <div class="grid md:grid-cols-4 gap-6">
                <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-3 hover:scale-105 border border-gray-100">
                    <div class="mb-4 flex justify-center">
                        <div class="bg-gradient-to-r from-teal-500 to-cyan-500 rounded-full p-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800 text-center group-hover:text-teal-600 transition-colors">Konsultacje</h3>
                    <p class="text-gray-600 text-sm mb-3 text-center">Kompleksowe badania i diagnostyka</p>
                    <p class="text-center">
                        <span class="inline-block bg-gradient-to-r from-teal-100 to-cyan-100 text-teal-700 font-bold text-xl px-4 py-2 rounded-xl">od 150 zł</span>
                    </p>
                </div>
                <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-3 hover:scale-105 border border-gray-100">
                    <div class="mb-4 flex justify-center">
                        <div class="bg-gradient-to-r from-green-500 to-emerald-500 rounded-full p-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800 text-center group-hover:text-green-600 transition-colors">Szczepienia</h3>
                    <p class="text-gray-600 text-sm mb-3 text-center">Ochrona przed chorobami zakaźnymi</p>
                    <p class="text-center">
                        <span class="inline-block bg-gradient-to-r from-green-100 to-emerald-100 text-green-700 font-bold text-xl px-4 py-2 rounded-xl">od 120 zł</span>
                    </p>
                </div>
                <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-3 hover:scale-105 border border-gray-100">
                    <div class="mb-4 flex justify-center">
                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 rounded-full p-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800 text-center group-hover:text-purple-600 transition-colors">Badania laboratoryjne</h3>
                    <p class="text-gray-600 text-sm mb-3 text-center">Analiza krwi, moczu i więcej</p>
                    <p class="text-center">
                        <span class="inline-block bg-gradient-to-r from-purple-100 to-pink-100 text-purple-700 font-bold text-xl px-4 py-2 rounded-xl">od 250 zł</span>
                    </p>
                </div>
                <div class="group bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-3 hover:scale-105 border border-gray-100">
                    <div class="mb-4 flex justify-center">
                        <div class="bg-gradient-to-r from-red-500 to-orange-500 rounded-full p-4 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                    </div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800 text-center group-hover:text-red-600 transition-colors">Chirurgia</h3>
                    <p class="text-gray-600 text-sm mb-3 text-center">Zabiegi operacyjne i kastracje</p>
                    <p class="text-center">
                        <span class="inline-block bg-gradient-to-r from-red-100 to-orange-100 text-red-700 font-bold text-xl px-4 py-2 rounded-xl">od 400 zł</span>
                    </p>
                </div>
            </div>
            
            <!-- Link do pełnej oferty -->
            <div class="text-center mt-12">
                <a href="{{ route('oferta') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-teal-500 to-cyan-500 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:from-teal-600 hover:to-cyan-600 transition-all duration-300 shadow-xl transform hover:scale-105">
                    <span>Zobacz pełny cennik</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-teal-600 via-cyan-600 to-blue-600 text-white relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-white/10 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white/5 rounded-full translate-x-1/3 translate-y-1/3"></div>
        
        <div class="container mx-auto px-4 text-center relative z-10">
            <h2 class="text-4xl md:text-5xl font-bold mb-6 drop-shadow-lg">Umów wizytę już dziś!</h2>
            <p class="text-xl mb-10 max-w-2xl mx-auto text-white/90">
                Zadzwoń lub zaloguj się, aby umówić wizytę online. Nasi specjaliści czekają na Ciebie!
            </p>
            <div class="flex justify-center gap-4 flex-wrap">
                <a href="tel:+48123456789" class="group bg-white text-teal-700 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-gray-100 transition-all duration-300 flex items-center gap-2 shadow-2xl transform hover:scale-105">
                    <svg class="w-6 h-6 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    +48 123 456 789
                </a>
                @guest
                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-yellow-400 to-orange-400 text-black px-8 py-4 rounded-2xl font-bold text-lg hover:from-yellow-500 hover:to-orange-500 transition-all duration-300 shadow-2xl transform hover:scale-105">
                        Zaloguj się i umów online
                    </a>
                @endguest
            </div>
        </div>
    </section>
@endsection
