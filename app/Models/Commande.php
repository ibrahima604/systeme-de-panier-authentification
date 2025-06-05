<?php
// app/Models/Commande.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Commande extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'adresse',
        'status',
        'mode_paiement',
        'user_id'
    ];

    // Une commande a plusieurs lignes de commande
    public function lignes()
    {
        return $this->hasMany(LigneCommande::class);
    }

    // ✅ Correction ici : belongsTo au lieu de belongTo
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
