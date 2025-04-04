<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\TravelsController; // Voeg de TravelsController toe
use App\Http\Controllers\boekenKlantController; // Voeg de boekenKlantController toe
use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/employee-dashboard', function () {
    return view('employee-dashboard');
})->middleware(['auth', 'verified'])->name('employee.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/communications', [CommunicationController::class, 'index'])->name('communications.index');
Route::get('/communications/create', [CommunicationController::class, 'create'])->name('communications.create');
Route::post('/communications', [CommunicationController::class, 'store'])->name('communications.store');

Route::get('/travels', [TravelsController::class, 'index'])->name('travels.index'); // Nieuwe route voor reizenoverzicht
Route::get('/travels/create', [TravelsController::class, 'create'])->name('travels.create');
Route::post('/travels', [TravelsController::class, 'store'])->name('travels.store');
Route::get('/travels/{id}/edit', [TravelsController::class, 'edit'])->name('travels.edit');
Route::put('/travels/{id}', [TravelsController::class, 'update'])->name('travels.update');
Route::delete('/travels/{id}', [TravelsController::class, 'destroy'])->name('travels.destroy');

Route::get('/customers/search', [CommunicationController::class, 'searchCustomers'])->name('customers.search');
Route::get('/employees/search', [CommunicationController::class, 'searchEmployees'])->name('employees.search');

Route::get('/test-log', function () {
    Log::info('Test log message');
    return 'Log message written';
});

require __DIR__.'/wassim_routes.php';
require __DIR__.'/auth.php';
require __DIR__.'/daniel_routes.php';
require __DIR__.'/customers.php';

