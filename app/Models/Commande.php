<?php
// app/Models/Commande.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'adresse',
        'status',
        'mode_paiement',
    ];

    // Une commande a plusieurs lignes de commande
    public function lignes()
    {
        return $this->hasMany(LigneCommande::class);
    }
}
