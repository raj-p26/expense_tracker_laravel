<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('username') || !session()->has('id')) {
            return redirect('/login');
        }
        $incomes_total = Income::where(['user_id' => session()->get('id')])
            ->sum('amount');
        $expenses_total = Expense::where(['user_id' => session()->get('id')])
            ->sum('amount');
        $balance = $incomes_total - $expenses_total;

        return view('welcome')->with([
            'income_count' => $incomes_total,
            'expense_count' => $expenses_total,
            'balance' => $balance,
        ]);
    }

    public function logout()
    {
        session()->forget(['username', 'id']);
        return redirect('/login');
    }
}
