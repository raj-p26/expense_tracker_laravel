<?php

namespace App\Http\Controllers;

use App\Models\Income;
use App\Models\Expense;
use Illuminate\Http\Request;

class FinanceController extends Controller
{
    public function index($id, Request $request)
    {
        if ($request->query('finance_type') == null) {
            return redirect('/err')->with([
                'error_code' => 400, 'error_message' => 'Bad Request'
            ]);
        }

        if ($request->query('finance_type') == 'income') {
            $finance = Income::where([
                'id' => $id,
            ])->first();
        } else {
            $finance = Expense::where([
                'id' => $id,
            ])->first();
        }

        if ($finance == null) return redirect('/err')->with(['error_code' => 404, 'error_message' => "Not Found"]);

        return view('edit')->with([
            'type' => $request->query('finance_type'),
            'finance' => $finance,
        ]);
    }

    public function update_income(Request $request)
    {
        $request->validate([
            'income_id' => 'required|integer',
            'income_type' => 'required|string',
            'income_amount' => 'required',
            'income_description' => 'string|nullable',
            'income_date' => 'date|required',
            'user_id' => 'required',
        ]);

        $income = Income::find($request->input('income_id'));

        if ($income == null) {
            return redirect('/err')
                ->with(['error_code' => 404, 'error_message' => "Not Found"]);
        }
        $income->type_ = $request->input('income_type');
        $income->amount = $request->input('income_amount');
        $income->date_ = $request->input('income_date');
        $income->description = $request->input('income_description');

        $income->save();

        return redirect('/incomes')
            ->with('success', 'Income updated!');
    }

    public function update_expense(Request $request)
    {
        $request->validate([
            'expense_id' => 'required|integer',
            'expense_type' => 'required|string',
            'expense_amount' => 'required',
            'expense_description' => 'string|nullable',
            'expense_date' => 'date|required',
            'user_id' => 'required',
        ]);

        $expense = Expense::find($request->input('expense_id'));

        if ($expense == null) {
            return redirect('/err')
                ->with(['error_code' => 404, 'error_message' => "Not Found"]);
        }
        $expense->type_ = $request->input('expense_type');
        $expense->amount = $request->input('expense_amount');
        $expense->date_ = $request->input('expense_date');
        $expense->description = $request->input('expense_description');

        $expense->save();

        return redirect('/expenses')
            ->with('success', 'Income updated!');
    }

    public function delete_finance(int $id, Request $request)
    {
        if ($request->query('finance_type') == null) {
            return redirect('/err')
                ->with(['error_code' => 400, 'error_messge' => 'Bad Request, Finance Type not provided.']);
        }

        $finance_type = $request->query('finance_type');

        if ($finance_type == 'income') {
            Income::where(['id' => $id])->delete();
        } else {
            Expense::where(['id' => $id])->delete();
        }

        return redirect()
            ->back()
            ->with('success', ucwords($finance_type) . ' Deleted.');
    }
}
