@extends('layouts.main')

@section('title', 'Zarządzanie Użytkownikami - VetCare Klinika')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Nagłówek -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-3">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    Zarządzanie Użytkownikami
                </h1>
                <p class="text-gray-600 mt-2">Lista wszystkich użytkowników systemu</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.users.create') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Dodaj użytkownika
                </a>
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-gray-700 transition flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Powrót do panelu
                </a>
            </div>
        </div>
    </div>

    <!-- Statystyki -->
    <div class="mb-8">
        <div class="grid md:grid-cols-4 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Wszyscy użytkownicy</p>
                        <p class="text-3xl font-bold text-gray-800">{{ $users->total() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            @foreach($role as $rola)
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-500 text-sm">{{ ucfirst($rola->nazwa == 'weterynarz' ? 'Weterynarze' : ($rola->nazwa == 'admin' ? 'Administratorzy' : 'Klienci')) }}</p>
                            <p class="text-3xl font-bold 
                                @if($rola->nazwa == 'admin') text-purple-600 
                                @elseif($rola->nazwa == 'weterynarz') text-teal-600 
                                @else text-green-600 
                                @endif">
                                {{ \App\Models\Uzytkownik::where('rola_id', $rola->id)->count() }}
                            </p>
                        </div>
                        <div class="w-12 h-12 rounded-full flex items-center justify-center
                            @if($rola->nazwa == 'admin') bg-purple-100 
                            @elseif($rola->nazwa == 'weterynarz') bg-teal-100 
                            @else bg-green-100 
                            @endif">
                            <svg class="w-6 h-6 
                                @if($rola->nazwa == 'admin') text-purple-600 
                                @elseif($rola->nazwa == 'weterynarz') text-teal-600 
                                @else text-green-600 
                                @endif" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Lista użytkowników -->
    <section>
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Lista użytkowników</h2>
        
        @if($users->count() > 0)
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-purple-600 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left font-semibold">ID</th>
                            <th class="px-6 py-4 text-left font-semibold">Imię i nazwisko</th>
                            <th class="px-6 py-4 text-left font-semibold">Email</th>
                            <th class="px-6 py-4 text-left font-semibold">Telefon</th>
                            <th class="px-6 py-4 text-left font-semibold">Rola</th>
                            <th class="px-6 py-4 text-left font-semibold">Akcje</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $user->id }}
                                </td>
                                <td class="px-6 py-4 font-semibold text-gray-800">
                                    {{ $user->imie }} {{ $user->nazwisko }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 py-4 text-gray-600">
                                    {{ $user->telefon ?? '-' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->rola_id == 1)
                                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-semibold">Admin</span>
                                    @elseif($user->rola_id == 2)
                                        <span class="bg-teal-100 text-teal-800 px-3 py-1 rounded-full text-sm font-semibold">Weterynarz</span>
                                    @else
                                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">Klient</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.uzytkownicy.destroy', $user->id) }}" method="POST" class="inline"
                                              onsubmit="return confirm('Czy na pewno chcesz usunąć użytkownika {{ $user->imie }} {{ $user->nazwisko }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-100 text-red-600 hover:bg-red-200 px-3 py-1 rounded text-sm transition flex items-center gap-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                                Usuń
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 text-sm">Twoje konto</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Paginacja -->
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        @else
            <div class="bg-gray-50 border border-gray-200 text-gray-600 px-6 py-8 rounded-lg text-center">
                <p class="text-lg">Brak użytkowników w systemie.</p>
            </div>
        @endif
    </section>
</div>
@endsection
