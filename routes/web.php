<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AvatarController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\FriendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TopUpController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'register'])->name('auth.register');
Route::post('/register', [AuthController::class, 'store'])->name('auth.store');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'auth'])->name('auth.login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home.index');
    Route::get('/profile', [HomeController::class, 'profile'])->name('home.profile');
    Route::get('/top-up', [HomeController::class, 'topUp'])->name('home.topup');
    Route::get('/settings', [SettingController::class, 'index'])->name('home.settings');
    Route::get('/detail/{user}', [HomeController::class, 'detail'])->name('home.detail');
    Route::get('/filter', [FilterController::class, 'index'])->name('home.filter');
    Route::get('/avatar', [HomeController::class, 'avatar'])->name('home.avatar');

    Route::post('/settings', [SettingController::class, 'setAccountVisible'])->name('settings.visible');
    Route::post('/update-password', [SettingController::class, 'updatePassword'])->name('password.update');
    Route::post('/update-profile', [SettingController::class, 'updateProfile'])->name('profile.update');
    Route::post('/filter', [FilterController::class, 'search'])->name('filter.search');
    Route::get('/top-up/{amount}', [TopUpController::class, 'add'])->name('topup.add');
    Route::post('/avatars/buy/{avatar}', [AvatarController::class, 'buyAvatar'])->name('avatars.buy');
    
    Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/friend-request/{friend}/{user}', [FriendController::class, 'sendRequest'])->name('friend.sendRequest');
    Route::get('accept-request/{user}/{friend}', [FriendController::class, 'acceptRequest'])->name('friend.acceptRequest');
    Route::get('remove-friend/{user}/{friend}', [FriendController::class, 'removeFriend'])->name('friend.removeFriend');
});
