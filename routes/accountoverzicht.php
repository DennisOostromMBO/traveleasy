<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


// Account Overzicht routes
Route::get('accountoverzicht', [AccountOverzichtController::class, 'index'])->name('accountoverzicht.index');
Route::get('accountoverzicht', [AccountOverzichtController::class, 'index'])->name('accountoverzicht.index');
Route::get('accountoverzicht/{id}/edit', [AccountOverzichtController::class, 'edit'])->name('accountoverzicht.edit');
Route::put('accountoverzicht/{id}', [AccountOverzichtController::class, 'update'])->name('accountoverzicht.update');
Route::delete('accountoverzicht/{id}', [AccountOverzichtController::class, 'destroy'])->name('accountoverzicht.destroy');