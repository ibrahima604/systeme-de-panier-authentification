<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{

    public function index(){
        return view('support.contact');
    }
    public function envoyerMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        $email = $user->email;
        $nom = $user->prenom.' '.$user->nom?? 'Utilisateur';

        $message = $request->input('message');

      Mail::send('support.message', [
    'nom' => $nom,
    'email' => $email,
    'messageContent' => $message,
], function ($mail) use ($email) {
    $mail->to(config('admin.email'))
         ->subject('Nouveau message utilisateur')
         ->replyTo($email);
});

        return redirect()->back()->with('success', 'Votre message a été envoyé au support.');
    }
    public function showReponseForm($email)
{
    return view('repondre-message', ['email' => $email]);
}
public function repondreMessage(Request $request)
{
    // Validation des champs
    $request->validate([
        'email' => 'required|email',
        'objet' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // Envoi de l'email (exemple simple)
    Mail::to($request->email)->send(new \App\Mail\ReponseSupport($request->objet, $request->message));

    return back()->with('success', 'Réponse envoyée avec succès !');
}


}
