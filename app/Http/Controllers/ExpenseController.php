<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        if (!session()->has('username')) {
            return redirect('/login');
        }
        return view('expenses');
    }

    public function store(Request $request)
    {
    }
}
