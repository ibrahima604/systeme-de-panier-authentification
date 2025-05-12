@extends('layouts.app-admin')

@section('header')
    <h2 class="font-semibold text-xl text-white leading-tight">
        Tableau de bord administrateur
    </h2>
@endsection

@section('content')
    <div class="py-12 px-6 text-black text-center">
        <h3>Bienvenue {{ Auth::user()->prenom }} !</h3>
        <p>Voici votre tableau de bord d'administration.</p>
    </div>
@endsection
