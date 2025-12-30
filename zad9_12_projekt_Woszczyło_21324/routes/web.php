<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AdminController;

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
    Route::post('/panel-klienta/zwierzeta', [ClientController::class, 'storeZwierze'])->name('client.zwierzeta.store');
    Route::post('/panel-klienta/wizyty', [ClientController::class, 'storeWizyta'])->name('client.wizyty.store');
});

// ===== PANEL WETERYNARZA =====
Route::middleware(['auth', 'role:weterynarz'])->group(function () {
    Route::get('/panel-pracownika', [StaffController::class, 'dashboard'])->name('staff.dashboard');
    Route::get('/panel-pracownika/leki', [StaffController::class, 'leki'])->name('staff.leki');
    Route::get('/panel-pracownika/pacjent/{id}', [StaffController::class, 'pacjent'])->name('staff.pacjent');
});

// ===== PANEL ADMINISTRATORA =====
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/panel-admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/panel-admin/leki', [AdminController::class, 'leki'])->name('admin.leki');
    Route::post('/panel-admin/pracownicy', [AdminController::class, 'storePracownik'])->name('admin.pracownicy.store');
    Route::post('/panel-admin/wizyty/{id}/przydziel', [AdminController::class, 'przydzielLekarza'])->name('admin.wizyty.przydziel');
});
