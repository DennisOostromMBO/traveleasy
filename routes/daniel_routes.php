<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AccountOverviewController;
use App\Http\Controllers\BookingController;

Route::get('/account-overview', [AccountOverviewController::class, 'index'])->name('account.overview');

Route::get('/account-overview/{id}/edit', [AccountOverviewController::class, 'edit'])->name('account.overview.edit');
Route::put('/account-overview/{id}', [AccountOverviewController::class, 'update'])->name('account.overview.update');
Route::delete('/account-overview/{id}', [AccountOverviewController::class, 'destroy'])->name('account.overview.destroy');

Route::get('/sales', [BookingController::class, 'sales'])->name('bookings.sales');
Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');

Route::get('/maintenance', function () {
    return view('maintenance.index');
})->name('maintenance');