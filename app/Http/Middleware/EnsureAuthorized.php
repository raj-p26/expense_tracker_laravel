<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\User;

class EnsureAuthorized
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session()->has('id')) {
            return redirect('/err')->with([
                'error_code' => 401,
                'error_message' => "Unauthorized"
            ]);
        }

        $user = User::where([
            'user_id' => session()->get('id'),
        ])->first();

        if ($user == null) {
            session()->forget('id', 'username');
            return redirect('/err')->with([
                'error_code' => 401,
                'error_message' => "Unauthorized"
            ]);
        }

        $request['user_id'] = session()->get('id');

        return $next($request);
    }
}
