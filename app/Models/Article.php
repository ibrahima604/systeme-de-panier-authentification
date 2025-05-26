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
    
    public function variantes()
{
    return $this->hasMany(Variante::class);
}
// App\Models\Article.php



public function couleurImages()
{
    return $this->hasMany(ArticleCouleurImage::class);
}

// Optionnel : pour récupérer directement les couleurs avec leurs images associées
public function couleursAvecImages()
{
    return $this->belongsToMany(Couleur::class, 'article_couleur_images')
                ->withPivot('image')
                ->withTimestamps();
}

}
