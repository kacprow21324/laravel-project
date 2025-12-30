<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Wyświetl formularz logowania.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Obsługa logowania użytkownika.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'haslo' => ['required'],
        ], [
            'email.required' => 'Adres e-mail jest wymagany.',
            'email.email' => 'Podaj poprawny adres e-mail.',
            'haslo.required' => 'Hasło jest wymagane.',
        ]);

        // Laravel Auth używa 'password' jako nazwy pola, ale my mamy 'haslo'
        // Musimy przekształcić dane
        $authCredentials = [
            'email' => $credentials['email'],
            'password' => $credentials['haslo'],
        ];

        if (Auth::attempt($authCredentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Przekierowanie zależne od roli
            if ($user->isAdmin()) {
                return redirect()->intended(route('admin.dashboard'))
                    ->with('success', 'Witaj, ' . $user->imie . '! Zalogowano jako Administrator.');
            } elseif ($user->isWeterynarz()) {
                return redirect()->intended(route('staff.dashboard'))
                    ->with('success', 'Witaj, dr ' . $user->imie . '! Zalogowano jako Weterynarz.');
            } else {
                return redirect()->intended(route('client.dashboard'))
                    ->with('success', 'Witaj, ' . $user->imie . '! Zalogowano pomyślnie.');
            }
        }

        return back()->withErrors([
            'email' => 'Podane dane logowania są nieprawidłowe.',
        ])->onlyInput('email');
    }

    /**
     * Wylogowanie użytkownika.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Zostałeś wylogowany.');
    }
}
