<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class CodeVerificationController extends Controller
{
    // Affiche le formulaire de saisie du code
    public function showForm()
    {
        // Si aucun code n'est en session, on redirige vers la page de login
        if (!Session::has('login_code') || !Session::has('auth_user_id')) {
            return redirect()->route('login')->withErrors(['session' => 'Session expirée. Veuillez vous reconnecter.']);
        }

        return view('auth.verify-code');
    }

    // Vérifie le code saisi par l'utilisateur
    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        $sessionCode = Session::get('login_code');
        $userId = Session::get('auth_user_id');

        // Vérifie le code de la session
        if ($request->code === $sessionCode && $userId) {
            $user = User::find($userId);

            if ($user) {
                // Connexion de l'utilisateur
                Auth::login($user);

                // Nettoyage des données de session
                Session::forget(['login_code', 'auth_user_id']);

                // Redirection dynamique selon l'utilisateur
                if ($user->email === config('admin.email')) {
                    return redirect()->route('admin.dashboard')->with('success', 'Bienvenue administrateur.');
                }

                return redirect()->route('dashboard')->with('success', 'Connexion réussie.');
            }
        }

        return back()->withErrors(['code' => 'Code incorrect ou expiré.']);
    }
}
