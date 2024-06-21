<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        if (!session()->has('username') || !session()->has('id')) {
            return redirect('/login');
        }
        $incomes_total = Income::where(['user_id' => session()->get('id')])
            ->sum('amount');
        $income_records = Income::where(['user_id' => session()->get('id')])
            ->count();

        $current_month_income = Income::where(['user_id' => session()->get('id')])
            ->whereBetween(DB::raw('DATE(date_)'), [date('Y-m-01'), date('Y-m-t')])
            ->sum('amount');

        $expenses_total = Expense::where(['user_id' => session()->get('id')])
            ->sum('amount');
        $expense_records = Expense::where(['user_id' => session()->get('id')])
            ->count();

        $current_month_expense = Expense::where(['user_id' => session()->get('id')])
            ->whereBetween(DB::raw('DATE(date_)'), [date('Y-m-01'), date('Y-m-t')])
            ->sum('amount');

        $balance = $incomes_total - $expenses_total;

        $data = [
            'income_count' => 'Total Income: ' . $incomes_total,
            'expense_count' => 'Total Expense: ' . $expenses_total,
            'balance' => 'Total Balance: ' . $balance,
            'average_income' => 'Average Balance: ' . $incomes_total / $income_records,
            'average_expense' => 'Average Expense: ' . $expenses_total / $expense_records,
            'current_month_income' => 'Current Month Incomes: ' . $current_month_income,
            'current_month_expense' => 'Current Month Expenses: ' . $current_month_expense,
        ];

        return view('welcome')->with(['data' => $data]);
    }

    public function logout()
    {
        session()->forget(['username', 'id']);
        return redirect('/login');
    }
}
