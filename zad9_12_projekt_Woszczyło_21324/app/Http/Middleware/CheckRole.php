<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Musisz być zalogowany.');
        }

        $user = auth()->user();

        foreach ($roles as $role) {
            switch ($role) {
                case 'admin':
                    if ($user->isAdmin()) {
                        return $next($request);
                    }
                    break;
                case 'weterynarz':
                    if ($user->isWeterynarz()) {
                        return $next($request);
                    }
                    break;
                case 'klient':
                    if ($user->isKlient()) {
                        return $next($request);
                    }
                    break;
                case 'pracownik':
                    if ($user->isPracownik()) {
                        return $next($request);
                    }
                    break;
            }
        }

        // Jeśli użytkownik nie ma odpowiedniej roli
        return redirect('/')->with('error', 'Nie masz uprawnień do wyświetlenia tej strony.');
    }
}
