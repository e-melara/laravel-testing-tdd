<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StatusesController;
use App\Http\Controllers\StatusesLikesController;
use App\Http\Controllers\CommentLikesController;

Auth::routes();

Route::view('/', 'welcome');

Route::get('statuses', [StatusesController::class, 'index'])->name('statuses.index');

Route::group(['middleware' => 'auth'], function () {
    Route::post('statuses', [StatusesController::class, 'store'])->name('statuses.store');
    Route::post('statuses/{status}/likes', [StatusesLikesController::class, 'store'])->name('statuses.likes.store');
    Route::delete('statuses/{status}/likes', [StatusesLikesController::class, 'destroy'])->name('statuses.likes.destroy');

    // comments
    Route::post('statuses/{status}/comments', [StatusCommentController::class, 'store'])->name('statuses.comments.store');

    // comments likes
    Route::post('comments/{comment}/likes', [CommentLikesController::class, 'store'])->name('comments.likes.store');
    Route::delete('comments/{comment}/likes', [CommentLikesController::class, 'destroy'])->name('comments.likes.destroy');
});
