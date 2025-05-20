<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // si tu veux le soft delete

class Article extends Model
{
    use HasFactory, SoftDeletes; // ajoute SoftDeletes si tu utilises $table->softDeletes()


    // Pour autoriser l'assignement de masse sur ces colonnes
    protected $fillable = [
        'libelle',
        'prix',
        'description',
        'quantite',
        'image',
    ];
    
}
