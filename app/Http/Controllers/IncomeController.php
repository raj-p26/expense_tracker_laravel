<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        if (!session()->has('username')) {
            return redirect('/login');
        }

        return view('incomes');
    }

    public function store(Request $request)
    {
    }
}
