<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Uzytkownik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    /**
     * Wyświetl formularz rejestracji.
     */
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Obsługa rejestracji nowego użytkownika.
     */
    public function register(Request $request)
    {
        $request->validate([
            'imie' => ['required', 'string', 'max:100'],
            'nazwisko' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:uzytkownicy,email'],
            'telefon' => ['nullable', 'string', 'max:20'],
            'haslo' => ['required', 'confirmed', Password::min(6)],
        ], [
            'imie.required' => 'Imię jest wymagane.',
            'nazwisko.required' => 'Nazwisko jest wymagane.',
            'email.required' => 'Adres e-mail jest wymagany.',
            'email.email' => 'Podaj poprawny adres e-mail.',
            'email.unique' => 'Ten adres e-mail jest już zarejestrowany.',
            'haslo.required' => 'Hasło jest wymagane.',
            'haslo.confirmed' => 'Hasła nie są identyczne.',
            'haslo.min' => 'Hasło musi mieć minimum 6 znaków.',
        ]);

        // Utworzenie nowego użytkownika z automatycznym przypisaniem roli "Klient" (ID = 3)
        $user = Uzytkownik::create([
            'imie' => $request->imie,
            'nazwisko' => $request->nazwisko,
            'email' => $request->email,
            'telefon' => $request->telefon,
            'haslo' => Hash::make($request->haslo),
            'rola_id' => 3, // KLIENT - automatyczne przypisanie
        ]);

        // Automatyczne zalogowanie po rejestracji
        Auth::login($user);

        return redirect()
            ->route('client.dashboard')
            ->with('success', 'Witaj, ' . $user->imie . '! Twoje konto zostało utworzone pomyślnie.');
    }
}
