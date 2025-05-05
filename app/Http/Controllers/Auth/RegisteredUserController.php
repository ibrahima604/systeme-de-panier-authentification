<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation des données d'inscription
        $request->validate([
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'in:M,F'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Création de l'utilisateur
        $user = User::create([
            'nom' => $request->nom,
            'prenom' => $request->prenom,
            'tel' => $request->tel,
            'email' => $request->email,
            'sexe' => $request->sexe,
            'password' => Hash::make($request->password),
        ]);

        // Envoi de la notification de vérification de l'email
        $user->sendEmailVerificationNotification();

        // Authentification automatique après inscription
        Auth::login($user);

        // Vérifier si l'utilisateur a confirmé son email
        if ($user->hasVerifiedEmail()) {
            // Si l'email est déjà vérifié, rediriger vers la page d'accueil ou tableau de bord
            return redirect(RouteServiceProvider::HOME);
        } else {
            // Si l'email n'est pas vérifié, rediriger vers la page de notification de vérification
            return redirect()->route('verification.notice');
        }
    }
}
