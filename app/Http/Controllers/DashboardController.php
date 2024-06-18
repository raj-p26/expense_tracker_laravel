<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (!session()->has('username')) {
            return redirect('/login');
        }
        return view('welcome');
    }


    // public function login(Request $request)
    // {
    //     $request->validate([
    //         'userEmail' => 'required|email',
    //         'userPassword' => "required",
    //     ]);

    //     $user = User::where([
    //         'email' => $request['userEmail'],
    //         'password' => md5($request['userPassword']),
    //     ])->first();

    //     if ($user == null) {
    //         $err = "Invalid username/password";
    //         Session::flash('error', $err);

    //         return Redirect::back();
    //     }

    //     session()->put(['username' => $user->name]);
    //     return redirect('/');
    // }

    public function logout()
    {
        session()->forget('username');
        return redirect('/');
    }
}
