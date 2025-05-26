<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleCouleurImage extends Model
{
    protected $fillable = [
        'article_id',
        'couleur_id',
        'image',
        
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function couleur()
    {
        return $this->belongsTo(Couleur::class);
    }
}
