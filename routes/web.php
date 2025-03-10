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

Route::get('/communications', [CommunicationController::class, 'index']);
Route::get('/travels', [TravelsController::class, 'index'])->name('travels.index'); // Nieuwe route voor reizenoverzicht
Route::get('/travels/create', [TravelsController::class, 'create'])->name('travels.create');
Route::post('/travels', [TravelsController::class, 'store'])->name('travels.store');
Route::get('/travels/{id}/edit', [TravelsController::class, 'edit'])->name('travels.edit');
Route::put('/travels/{id}', [TravelsController::class, 'update'])->name('travels.update');

require __DIR__.'/wassim_routes.php';
require __DIR__.'/auth.php';
require __DIR__.'/daniel_routes.php';
require __DIR__.'/customers.php';

