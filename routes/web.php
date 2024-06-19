<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LoginController;
use App\Models\User;

Route::get('/', [DashboardController::class, "index"]);
Route::post('/register', [LoginController::class, "store"])->name('user.register');
Route::get('/register', [LoginController::class, "register"]);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('user.login');
Route::get('/logout', [DashboardController::class, "logout"])->name('user.logout');
Route::get('/delete-account/{id}', [LoginController::class, "destroy"])->name('user.delete');
Route::get('/incomes', [IncomeController::class, "index"])->name('user.incomes');
Route::post('/incomes', [IncomeController::class, "index"])->name('user.income');
Route::get('/expenses', [ExpenseController::class, "index"])->name('user.expenses');
Route::post('/expenses', [ExpenseController::class, "store"])->name('user.expense');
Route::get('/err', function () {
    return view('error');
});

Route::get('/api/users', function () {
    $users = User::all();

    return response()->json($users->toArray());
});
