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
        // S'il n'y a pas de code en session, rediriger vers la page de login
        if (!Session::has('login_code')) {
            return redirect()->route('login');
        }

        return view('auth.verify-code');
    }

    // Vérifie le code saisi
    public function verify(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string'],
        ]);

        if ($request->code === Session::get('login_code')) {
            // Authentifier l'utilisateur avec son ID enregistré en session
            $userId = Session::get('auth_user_id');
            $user = User::find($userId);

            if ($user) {
                Auth::login($user);

                // Nettoyer les données de session
                Session::forget(['login_code', 'auth_user_id']);

                return redirect()->route('dashboard'); // <== Est-ce bien ici ?
            }
        }

        return back()->withErrors(['code' => 'Code incorrect.']);
    }
}
