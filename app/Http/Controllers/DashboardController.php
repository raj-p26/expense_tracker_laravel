<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function register(Request $request)
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
        } catch (Exception) {
            $msg = [
                "errormsg" => "Could not create user.",
            ];

            $data = compact('msg');
            return redirect('/')->with($data);
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
            $err = "Invalid username/password";
            Session::flash('error', $err);

            return Redirect::back();
        }

        session()->put(['username' => $user->name]);
        return redirect('/');
    }

    public function logout()
    {
        session()->forget('username');
        return redirect('/');
    }
}
