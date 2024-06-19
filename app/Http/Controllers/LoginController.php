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
            session()->put(['username' => $name, 'id' => $user->user_id]);

            return redirect('/');
        } catch (Exception) {
            return redirect()
                ->back()
                ->with(['error' => 'Account with this email already exists.']);
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
            return redirect()
                ->back()
                ->with(['error' => "Invalid Credentials."]);
        }

        session()->put(['username' => $user->name, 'id' => $user->user_id]);
        return redirect('/');
    }

    public function destroy($id)
    {
        $user = User::where([
            'user_id' => $id,
        ])->first();

        if ($user == null) return redirect('/err');

        User::where([
            'user_id' => $id,
        ])->delete();

        session()->forget(['username', 'id']);

        return redirect('/login');
    }

    public function register()
    {
        return view('login')->with(['type' => 'register']);
    }
}
