<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\TravelsController; // Voeg de TravelsController toe
use App\Http\Controllers\boekenKlantController; // Voeg de boekenKlantController toe

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

<<<<<<< HEAD

require __DIR__.'/accountoverzicht.php';
require __DIR__.'/wassim_routes.php';
=======
Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoices.show');
Route::get('/invoices/generate/{booking_id}', [InvoiceController::class, 'generate'])->name('invoices.generate');

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/communications', [CommunicationController::class, 'index']);
Route::get('/travels', [TravelsController::class, 'index']); // Nieuwe route voor reizenoverzicht
>>>>>>> 5c615bb1e1b698bd03b6d44acdb2fe0ac4cdf23c
require __DIR__.'/auth.php';
require __DIR__.'/accountoverzicht.php';