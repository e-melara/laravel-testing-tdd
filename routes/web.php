<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StatusesController;

Auth::routes();

Route::view('/', 'welcome');

Route::group(['middleware' => 'auth'], function () {
    Route::post('statuses', [StatusesController::class, 'store'])->name('statuses.store');
    Route::get('statuses', [StatusesController::class, 'index'])->name('statuses.index');
});