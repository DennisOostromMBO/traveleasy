<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AccountOverviewController;

Route::get('/account-overview', [AccountOverviewController::class, 'index'])->name('account.overview');

Route::get('/maintenance', function () {return view('maintenance.index');})->name('maintenance');