<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth'])->name('auth.login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home.index');
    Route::get('/profile', [HomeController::class, 'profile'])->name('home.profile');

    Route::get('/settings', function () {
        return view('home.settings');
    })->name('home.settings');

    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/friend-request/{friend}/{user}', [FriendController::class, 'sendRequest'])->name('friend.sendRequest');
    Route::get('accept-request/{user}/{friend}', [FriendController::class, 'acceptRequest'])->name('friend.acceptRequest');
    Route::get('remove-friend/{user}/{friend}', [FriendController::class, 'removeFriend'])->name('friend.removeFriend');
});
