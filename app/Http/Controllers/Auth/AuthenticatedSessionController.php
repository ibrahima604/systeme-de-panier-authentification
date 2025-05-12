<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginCodeMail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authentifie l'utilisateur via la méthode LoginRequest
        $request->authenticate();
    
        // Régénère la session après l'authentification
        $request->session()->regenerate();
    
        // Récupère l'utilisateur authentifié
        $user = Auth::user();
    
        // Vérifie si l'email correspond à celui de l'administrateur
        if ($user->email === env('ADMIN_EMAIL')) {
            // Redirige immédiatement l'admin vers son dashboard
            return redirect()->route('admin.dashboard')->with('success', 'Bienvenue administrateur.');
        }
    
        // Sinon, continue avec la vérification par code
        // Génère un code de vérification aléatoire
        $code = Str::random(6);
    
        // Enregistre le code et l'ID de l'utilisateur dans la session
        Session::put('login_code', $code);
        Session::put('auth_user_id', $user->id);
    
        // Envoie du code par email
        Mail::to($user->email)->send(new LoginCodeMail($code));
    
        // Déconnecte temporairement l'utilisateur
        Auth::logout();
    
        // Redirige vers la page de saisie du code
        return redirect()->route('verify.code.form')->with('success', 'Un code vous a été envoyé par email.');
    }
    
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
