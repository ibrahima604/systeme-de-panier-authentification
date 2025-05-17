<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Vérifie si l'utilisateur est connecté et est admin
        if (Auth::check() && Auth::user()->email==config('admin.email')) {
            return $next($request);
        }

       
        // Redirection si l'utilisateur est l'admin
        return redirect()->route('dashboard')->with('error', 'Accès refusé.');
    }
}
