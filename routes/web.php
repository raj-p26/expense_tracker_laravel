<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Models\User;

Route::get('/', [DashboardController::class, "index"]);
Route::post('/register', [DashboardController::class, "register"])->name('user.register');
Route::post('/login', [DashboardController::class, "login"])->name('user.login');
Route::get('/logout', [DashboardController::class, "logout"])->name('user.logout');


Route::get('/api/users', function () {
    $users = User::all();

    echo "<pre>";
    print_r($users->toArray());
    echo "</pre>";
});
