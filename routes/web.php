<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\EnsureAuthorized;
use App\Http\Controllers\FinanceController;
use App\Models\User;

Route::get('/', [DashboardController::class, "index"]);
Route::post('/register', [LoginController::class, "store"])->name('user.register');
Route::get('/register', [LoginController::class, "register"]);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('user.login');
Route::get('/logout', [DashboardController::class, "logout"])->name('user.logout');
Route::get('/delete-account/{id}', [LoginController::class, "destroy"])->name('user.delete');

Route::get('/incomes', [IncomeController::class, "index"])
    ->middleware(EnsureAuthorized::class)
    ->name('user.incomes');
Route::post('/incomes', [IncomeController::class, "store"])
    ->middleware(EnsureAuthorized::class)
    ->name('user.income.add');

Route::get('/expenses', [ExpenseController::class, "index"])->name('user.expenses');
Route::post('/expenses', [ExpenseController::class, "store"])
    ->middleware(EnsureAuthorized::class)
    ->name('user.expense.add');

Route::get('/finance/{id}/edit', [FinanceController::class, "index"])
    ->middleware(EnsureAuthorized::class)
    ->name('finance.edit');

Route::get('/finance/{id}/delete', [FinanceController::class, "delete_finance"])
    ->middleware(EnsureAuthorized::class)
    ->name('finance.delete');

Route::post('/finance/update-income', [FinanceController::class, "update_income"])
    ->middleware(EnsureAuthorized::class)
    ->name('update.income');

Route::post('/finance/update-expense', [FinanceController::class, "update_expense"])
    ->middleware(EnsureAuthorized::class)
    ->name('update.expense');

Route::get('/err', function () {
    return view('error');
})->name('err');

Route::get('/api/users', function () {
    $users = User::all();

    return response()->json($users->toArray());
});
