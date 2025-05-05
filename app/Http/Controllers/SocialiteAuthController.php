<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Enums\Provider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class SocialiteAuthController extends Controller
{
    public function redirect(Provider $provider)
    {
        return Socialite::driver($provider->value)->redirect();
    }
   
    public function authenticate(Provider $provider)
    {
        try {
            // Obtenir les informations de l'utilisateur à partir du fournisseur OAuth
            $socialiteUser = Socialite::driver($provider->value)->user();
    
            // Vérifier si l'utilisateur existe déjà dans la base de données
            $user = User::firstOrCreate(
                ['email' => $socialiteUser->getEmail()],
                [
                    'nom' => $socialiteUser->getName() ?? 'NomInconnu',
                    'prenom' => $socialiteUser->getNickname() ?? '', // Utiliser le nickname comme prénom si disponible
                    'tel' => $socialiteUser->user['phone'] ?? '', // Utiliser le champ 'phone' si disponible
                    'password' => Hash::make(Str::random(24)), // Générer un mot de passe aléatoire
                    'email' => $socialiteUser->getEmail(),
                    'sexe' => isset($socialiteUser->user['gender']) ? strtoupper(substr($socialiteUser->user['gender'], 0, 1)) : null,
                ]
            );
    
            // Connecter l'utilisateur
            Auth::login($user);
    
            // Rediriger vers le tableau de bord
            return to_route('dashboard');
        } catch (\Exception $exception) {
            // Gérer les exceptions et rediriger vers la page de connexion
            return to_route('route:/')->withErrors(['error' => 'Authentication failed.']);
        }
    }
    
}
