@extends('layouts.main')

@section('title', 'Klinika Weterynaryjna - Strona Główna')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6">
                🐕 Profesjonalna Opieka Weterynaryjna 🐈
            </h1>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Zapewniamy kompleksową opiekę zdrowotną dla Twoich pupili. 
                Nasi doświadczeni weterynarze są tu dla Ciebie i Twojego zwierzaka.
            </p>
            <div class="flex justify-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold text-lg hover:bg-gray-100 transition shadow-lg">
                        Zaloguj się
                    </a>
                @else
                    @if(auth()->user()->isPracownik())
                        <a href="{{ route('staff.dashboard') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold text-lg hover:bg-gray-100 transition shadow-lg">
                            Przejdź do Panelu
                        </a>
                    @else
                        <a href="{{ route('client.dashboard') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold text-lg hover:bg-gray-100 transition shadow-lg">
                            Mój Panel
                        </a>
                    @endif
                @endguest
                <a href="#oferta" class="bg-transparent border-2 border-white text-white px-8 py-3 rounded-lg font-bold text-lg hover:bg-white hover:text-blue-600 transition">
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
                    <div class="text-5xl mb-4">👨‍⚕️</div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Doświadczony Zespół</h3>
                    <p class="text-gray-600">
                        Nasi weterynarze to specjaliści z wieloletnim doświadczeniem w leczeniu zwierząt domowych i egzotycznych.
                    </p>
                </div>
                <div class="text-center p-6 bg-gray-50 rounded-lg shadow">
                    <div class="text-5xl mb-4">🏥</div>
                    <h3 class="text-xl font-bold mb-2 text-gray-800">Nowoczesny Sprzęt</h3>
                    <p class="text-gray-600">
                        Dysponujemy najnowocześniejszym sprzętem diagnostycznym: USG, RTG, laboratorium analityczne.
                    </p>
                </div>
                <div class="text-center p-6 bg-gray-50 rounded-lg shadow">
                    <div class="text-5xl mb-4">❤️</div>
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
                    <div class="text-4xl mb-4 text-blue-600">🩺</div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">Konsultacje</h3>
                    <p class="text-gray-600 text-sm mb-3">Kompleksowe badania i diagnostyka</p>
                    <p class="text-blue-600 font-bold">od 150 zł</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="text-4xl mb-4 text-green-600">💉</div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">Szczepienia</h3>
                    <p class="text-gray-600 text-sm mb-3">Ochrona przed chorobami zakaźnymi</p>
                    <p class="text-blue-600 font-bold">od 120 zł</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="text-4xl mb-4 text-purple-600">🔬</div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">Badania laboratoryjne</h3>
                    <p class="text-gray-600 text-sm mb-3">Analiza krwi, moczu i więcej</p>
                    <p class="text-blue-600 font-bold">od 250 zł</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                    <div class="text-4xl mb-4 text-red-600">🏥</div>
                    <h3 class="text-lg font-bold mb-2 text-gray-800">Chirurgia</h3>
                    <p class="text-gray-600 text-sm mb-3">Zabiegi operacyjne i kastracje</p>
                    <p class="text-blue-600 font-bold">od 400 zł</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-6">Umów wizytę już dziś!</h2>
            <p class="text-xl mb-8">Zadzwoń lub zaloguj się, aby umówić wizytę online</p>
            <div class="flex justify-center gap-4 flex-wrap">
                <a href="tel:+48123456789" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-bold text-lg hover:bg-gray-100 transition">
                    📞 +48 123 456 789
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
