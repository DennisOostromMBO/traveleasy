<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ManagerController;

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
Route::get('/invoices/{id}', [InvoiceController::class, 'show'])->name('invoices.show');
Route::get('/invoices/{id}/edit', [InvoiceController::class, 'edit'])->name('invoices.edit');
Route::patch('/invoices/{id}', [InvoiceController::class, 'update'])->name('invoices.update');
Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
Route::get('/invoices/generate/{booking_id}', [InvoiceController::class, 'generate'])->name('invoices.generate');
Route::get('/invoices/pdf/{id}', [PdfController::class, 'generateInvoicePdf'])->name('invoices.pdf');

Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/bookings/create', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
Route::get('/bookings/{id}', [BookingController::class, 'show'])->name('bookings.show');
Route::get('/bookings/{id}/edit', [BookingController::class, 'edit'])->name('bookings.edit');
Route::patch('/bookings/{id}', [BookingController::class, 'update'])->name('bookings.update');
Route::delete('/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
Route::get('/bookings/purchase/{id}', [BookingController::class, 'purchase'])->name('bookings.purchase');
Route::post('/bookings/{id}/book-now', [BookingController::class, 'bookNow'])->name('bookings.bookNow');
Route::get('/bookings/{id}/payment', [BookingController::class, 'payment'])->name('bookings.payment');
Route::post('/bookings/{id}/complete-payment', [BookingController::class, 'completePayment'])->name('bookings.completePayment');

Route::get('/manager/bookings', [ManagerController::class, 'bookings'])->name('manager.bookings');

