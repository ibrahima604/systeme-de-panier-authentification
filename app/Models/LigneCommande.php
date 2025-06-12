<?php
// app/Models/LigneCommande.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LigneCommande extends Model
{
    use HasFactory;

   protected $fillable = [
    'commande_id',
    'article_id',
    'quantite_commande',
    'taille',
    'couleur',
    'prix',
    'image',
    'variante_id'
];


    // Une ligne de commande appartient à une commande
    public function commande()
    {
        return $this->belongsTo(Commande::class);
    }

    // Une ligne de commande appartient à un article
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}

