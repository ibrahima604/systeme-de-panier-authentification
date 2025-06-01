<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */ public function index()
    {
        // Pour afficher tout le monde, actifs + désactivés
        $users = User::withTrashed()->paginate(10);
        return view('admin.users', compact('users'));
    }

    //a propos
   public function about()
{
    $teamMembers = [
        [
            'name' => 'Jean Dupont',
            'position' => 'CEO & Fondateur',
            'bio' => 'Expert en e-commerce avec 15 ans d\'expérience dans le secteur.',
            'image' => 'images/team/jean.jpg'
        ],
        // Ajoutez d'autres membres de l'équipe
    ];

    $testimonials = [
        [
            'name' => 'Marie Lambert',
            'position' => 'Directrice Marketing',
            'comment' => 'La qualité des produits est exceptionnelle. Livraison rapide et service client réactif.',
            'rating' => 5,
            'avatar' => 'images/avatars/marie.jpg'
        ],
        // Ajoutez d'autres témoignages
    ];

    return view('apropos.about', compact('teamMembers', 'testimonials'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    // Soft delete : désactive l'utilisateur
    public function softDelete(User $user)
    {
        if($user->email === config('admin.email')) {
            // Vérifie si l'utilisateur est admin
            // Si oui, on ne peut pas le désactiver
            return redirect()->back()->with('error', 'Impossible de désactiver l\'utilisateur admin.');
        }
        $user->delete();  // Soft delete grâce au trait SoftDeletes dans le modèle User
        return redirect()->back()->with('success', 'Utilisateur désactivé avec succès.');
    }

    // Restore : réactive l'utilisateur
    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id); // On récupère même les supprimés
        $user->restore();  // Restaure l'utilisateur soft deleted
        return redirect()->back()->with('success', 'Utilisateur réactivé avec succès.');
    }


    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            return view('admin.users.show', compact('user'));
        }
        return redirect()->route('utilisateurs')->with('error', 'Utilisateur non trouvé.');
        
    }

    /**
     * Show the form for editing the specified resource.
     */
   // Afficher le formulaire d'édition avec les infos utilisateur
public function edit(User $user)
{
    return view('admin.users.edit', compact('user'));
}

// Traiter la mise à jour des infos utilisateur
public function update(Request $request, User $user)
{
    // Validation simple (à adapter selon tes besoins)
    $validatedData = $request->validate([
        'prenom' => 'required|string|max:255',
        'nom' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        // ajoute d'autres champs ici si besoin
    ]);

    // Mise à jour de l'utilisateur
    $user->update($validatedData);

    return redirect()->route('admin.users.show', $user->id)->with('success', 'Utilisateur mis à jour avec succès.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->is_active = false;
            $user->save();
            return redirect()->route('utilisateurs')->with('success', 'Utilisateur supprimé avec succès.');
        }
        return redirect()->route('utilisateurs')->with('error', 'Utilisateur non trouvé.');
    }
}
