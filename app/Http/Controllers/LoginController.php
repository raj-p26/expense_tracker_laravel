<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login')->with(['type' => 'login']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'userEmail' => 'required|email',
            'userPassword' => "required",
        ]);
        $name = $request['username'];
        $email = $request['userEmail'];
        $password = md5($request['userPassword']);

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = $password;
        try {
            $user->save();
            session()->put(['username' => $name]);

            return redirect('/');
        } catch (Exception $e) {
            session()->put(['error' => $e->getMessage()]);

            return redirect()->back();
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'userEmail' => 'required|email',
            'userPassword' => "required",
        ]);

        $user = User::where([
            'email' => $request['userEmail'],
            'password' => md5($request['userPassword']),
        ])->first();

        if ($user == null) {
            return redirect()->back()->with(['error' => "Invalid Credentials."]);
        }

        session()->put(['username' => $user->name]);
        return redirect('/');
    }

    public function register()
    {
        return view('login')->with(['type' => 'register']);
    }
}
