<?php

namespace App\Http\Controllers;

use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::where(['user_id' => session()->get('id')])
            ->orderBy('date_')
            ->get();

        return view('incomes')->with(compact('incomes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'income_type' => 'required|string',
            'income_amount' => 'required',
            'income_description' => 'string|nullable',
            'income_date' => 'date|required',
            'user_id' => 'required',
        ]);

        $income = new Income();
        $income->type_ = $request['income_type'];
        $income->amount = $request['income_amount'];
        $income->description = $request['income_description'];
        $income->date_ = $request['income_date'];
        $income->user_id = $request['user_id'];
        $income->save();

        return redirect()
            ->back()
            ->with("success", "Income successfully added.");
    }
}
