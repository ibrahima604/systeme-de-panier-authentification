<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Couleur extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom',
        'code_hex', // ou 'code_rgb' selon ce que tu préfères
        
        
    ];
    public function articleImages()
{
    return $this->hasMany(ArticleCouleurImage::class);
}

public function articlesAvecImages()
{
    return $this->belongsToMany(Article::class, 'article_couleur_images')
                ->withPivot('image')
                ->withTimestamps();
}
}
