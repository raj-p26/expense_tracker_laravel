<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LoginController;
use App\Models\User;

Route::get('/', [DashboardController::class, "index"]);
Route::post('/register', [LoginController::class, "store"])->name('user.register');
Route::get('/register', [LoginController::class, "register"]);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('user.login');
Route::get('/logout', [DashboardController::class, "logout"])->name('user.logout');
Route::get('/incomes', [IncomeController::class, "index"])->name('user.incomes');
// Route::get('/incomes', [IncomeController::class, "index"])->name('user.incomes');


Route::get('/api/users', function () {
    $users = User::all();

    echo "<pre>";
    print_r($users->toArray());
    echo "</pre>";
});
