<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StaffController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Strona główna
Route::get('/', function () {
    return view('welcome');
})->name('home');

// ===== AUTENTYKACJA =====
// Logowanie
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit')->middleware('guest');

// Wylogowanie
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ===== PANEL KLIENTA =====
Route::middleware(['auth', 'role:klient'])->group(function () {
    Route::get('/panel-klienta', [ClientController::class, 'dashboard'])->name('client.dashboard');
});

// ===== PANEL PRACOWNIKA (Admin i Weterynarz) =====
Route::middleware(['auth', 'role:pracownik'])->group(function () {
    Route::get('/panel-pracownika', [StaffController::class, 'dashboard'])->name('staff.dashboard');
});
