<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('username')) {
            return redirect('/login');
        }
        return view('welcome');
    }

    public function logout()
    {
        session()->forget(['username', 'id']);
        return redirect('/login');
    }
}
