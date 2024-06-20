<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::where(['user_id' => session()->get('id')])
            ->orderBy('date_')
            ->get();

        return view('expenses')->with(compact('expenses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'expense_type' => 'required|string',
            'expense_amount' => 'required',
            'expense_description' => 'string|nullable',
            'expense_date' => 'date|required',
            'user_id' => 'required',
        ]);

        $expense = new Expense();
        $expense->type_ = $request['expense_type'];
        $expense->amount = $request['expense_amount'];
        $expense->description = $request['expense_description'];
        $expense->date_ = $request['expense_date'];
        $expense->user_id = $request['user_id'];
        $expense->save();

        return redirect()
            ->back()
            ->with("success", "Income successfully added.");
    }
}
