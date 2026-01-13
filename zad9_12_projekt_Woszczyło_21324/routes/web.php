<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;

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

// Strona oferty/cennika
Route::get('/oferta', [PageController::class, 'oferta'])->name('oferta');

// ===== AUTENTYKACJA =====
// Logowanie
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit')->middleware('guest');

// Rejestracja
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit')->middleware('guest');

// Wylogowanie
Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// ===== PANEL KLIENTA =====
Route::middleware(['auth', 'role:klient'])->group(function () {
    Route::get('/panel-klienta', [ClientController::class, 'dashboard'])->name('client.dashboard');
    Route::post('/panel-klienta/zwierzeta', [ClientController::class, 'storeZwierze'])->name('client.zwierzeta.store');
    Route::post('/panel-klienta/wizyty', [ClientController::class, 'storeWizyta'])->name('client.wizyty.store');
    Route::get('/panel-klienta/zwierze/{id}', [ClientController::class, 'kartaPacjenta'])->name('client.zwierze.karta');
});

// ===== PANEL WETERYNARZA =====
Route::middleware(['auth', 'role:weterynarz'])->group(function () {
    Route::get('/panel-pracownika', [StaffController::class, 'dashboard'])->name('staff.dashboard');
    Route::get('/panel-pracownika/leki', [StaffController::class, 'leki'])->name('staff.leki');
    Route::get('/panel-pracownika/wizyta/{id}', [StaffController::class, 'wizyta'])->name('staff.wizyta');
    Route::post('/panel-pracownika/wizyta/{id}/dokumentacja', [StaffController::class, 'updateDokumentacja'])->name('staff.wizyta.dokumentacja');
    Route::post('/panel-pracownika/wizyta/{id}/przepisz-lek', [StaffController::class, 'przepiszLek'])->name('staff.wizyta.przepisz-lek');
});

// ===== BAZA PACJENTÓW (wspólna dla weterynarza i admina) =====
Route::middleware(['auth', 'role:weterynarz,admin'])->group(function () {
    Route::get('/pacjenci', [StaffController::class, 'pacjenci'])->name('pacjenci.index');
    Route::get('/pacjent/{id}', [StaffController::class, 'pacjent'])->name('pacjenci.show');
});

// ===== PANEL ADMINISTRATORA =====
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/panel-admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/panel-admin/leki', [AdminController::class, 'leki'])->name('admin.leki');
    Route::post('/panel-admin/pracownicy', [AdminController::class, 'storePracownik'])->name('admin.pracownicy.store');
    Route::post('/panel-admin/wizyty/{id}/przydziel', [AdminController::class, 'przydzielLekarza'])->name('admin.wizyty.przydziel');
    Route::delete('/panel-admin/uzytkownicy/{id}', [AdminController::class, 'destroyUser'])->name('admin.uzytkownicy.destroy');
    
    // Zarządzanie użytkownikami
    Route::get('/panel-admin/uzytkownicy', [AdminController::class, 'users'])->name('admin.users.index');
    Route::get('/panel-admin/uzytkownicy/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/panel-admin/uzytkownicy', [AdminController::class, 'storeUser'])->name('admin.users.store');
    
    // Zarządzanie usługami (CRUD)
    Route::get('/panel-admin/uslugi', [AdminController::class, 'uslugi'])->name('admin.uslugi.index');
    Route::get('/panel-admin/uslugi/create', [AdminController::class, 'createUsluga'])->name('admin.uslugi.create');
    Route::post('/panel-admin/uslugi', [AdminController::class, 'storeUsluga'])->name('admin.uslugi.store');
    Route::get('/panel-admin/uslugi/{id}/edit', [AdminController::class, 'editUsluga'])->name('admin.uslugi.edit');
    Route::put('/panel-admin/uslugi/{id}', [AdminController::class, 'updateUsluga'])->name('admin.uslugi.update');
    Route::delete('/panel-admin/uslugi/{id}', [AdminController::class, 'destroyUsluga'])->name('admin.uslugi.destroy');
    
    // Zarządzanie lekami (tylko admin)
    Route::post('/leki', [AdminController::class, 'storeLek'])->name('leki.store');
    Route::get('/panel-admin/leki/{id}/edit', [AdminController::class, 'editLek'])->name('admin.leki.edit');
    Route::put('/panel-admin/leki/{id}', [AdminController::class, 'updateLek'])->name('admin.leki.update');
    

    
    // Anulowanie wizyt
    Route::delete('/panel-admin/wizyty/{id}/anuluj', [AdminController::class, 'anulujWizyte'])->name('admin.wizyty.anuluj');
});
