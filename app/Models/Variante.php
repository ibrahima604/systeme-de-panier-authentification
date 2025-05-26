<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variante extends Model
{
    use HasFactory;
    protected $fillable = [
        'article_id',
        'couleur_id',
        'taille_id',
        'quantite',
    ];
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function couleur()
    {
        return $this->belongsTo(Couleur::class);
    }


    public function taille()
    {
        return $this->belongsTo(Taille::class);
    }
}
