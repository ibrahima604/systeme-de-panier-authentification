<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->email !== config('admin.email')) {
            return $next($request);
        }

        // Redirection si l'utilisateur est l'admin
        return redirect()->route('admin.dashboard')->with('error', 'Accès refusé.');
    }
}
