<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Commande;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $NbrCommande=Commande::whereDate('created_at',Carbon::today())->count();
        $NbrCommandeHier=Commande::whereDate('created_at',Carbon::yesterday())->count();
        if($NbrCommandeHier >0){
            $varianteNbrCommande=(($NbrCommande-$NbrCommandeHier)/$NbrCommandeHier)*100;

        }
        else{
             $varianteNbrCommande=$NbrCommande>0?100:0;
        }

        $commandesDuJour=Commande::with(['user','lignes.article'])->whereDate('created_at',Carbon::today())->get();
        $commandesHier=Commande::with(['user','lignes.article'])->whereDate('created_at',Carbon::yesterday())->get();
        $revenuDuJour=0;
        foreach($commandesDuJour as $commande){
                   foreach($commande->lignes as $ligne){
            $revenuDuJour+=$ligne->quantite_commande*$ligne->prix;
}
        }
        // Calcul revenu hier
$revenuHier = 0;
foreach ($commandesHier as $commande) {
    foreach ($commande->lignes as $ligne) {
        $revenuHier += $ligne->quantite_commande * $ligne->prix;
    }
}
// Calcul du pourcentage
if ($revenuHier > 0) {
    $variation = (($revenuDuJour - $revenuHier) / $revenuHier) * 100;
} else {
    $variation = $revenuDuJour > 0 ? 100 : 0; // 100% si revenuDuJour > 0, sinon 0
}
        $articles=Article::with('variantes')->get();
        $stock=0;
        foreach($articles as $article){
            $stock+=$article->quantite;
            foreach($article->variantes as $variante){
                 $stock+=$variante->quantite;

            }

        }
    $clients = User::whereBetween('created_at', [
    Carbon::now()->startOfWeek(), 
    Carbon::now()->endOfWeek()
])->count();
$clientsSemaineDerniere = User::whereBetween('created_at', [
    Carbon::now()->subWeek()->startOfWeek(), 
    Carbon::now()->subWeek()->endOfWeek()
])->count();
if($clientsSemaineDerniere >0){
    $variationClient=(($clients-$clientsSemaineDerniere)/$clientsSemaineDerniere)*100;

}
else{
      $variationClient=$clients>0?100:0;
}
 
$articleEnRupture = Article::where('quantite', '<', 10)
    ->orWhereHas('variantes', function($query) {
        $query->where('quantite', '<', 10);
    })
    ->count();



$dernieresCommandes = Commande::with('user', 'lignes')
    ->latest()
    ->take(2)
    ->get();
$dernieresInscriptions = User::latest()->take(2)->get();
$dernieresCommandesPourActivite = Commande::latest()->take(2)->get();


$topProducts = DB::table('ligne_commandes as lc')
    ->join('articles as a', 'lc.article_id', '=', 'a.id')
    ->select('a.id', 'a.libelle', 'a.image', DB::raw('SUM(lc.quantite_commande) as total_vendu'))
    ->groupBy('a.id', 'a.libelle', 'a.image')
    ->orderByDesc('total_vendu')
    ->limit(2)
    ->get();

    // Ajout de la logique topProducts ici
        $topProduct = DB::table('ligne_commandes as lc')
            ->join('articles as a', 'lc.article_id', '=', 'a.id')
            ->select('a.libelle', DB::raw('SUM(lc.quantite_commande) as total_vendu'))
            ->groupBy('a.libelle')
            ->orderByDesc('total_vendu')
            ->limit(10)
            ->get();

        $labels = $topProduct->pluck('libelle');
        $data = $topProduct->pluck('total_vendu');
 



 
  

        return view('admin.dashboard',compact('NbrCommande','revenuDuJour','stock',
        'variation','varianteNbrCommande','variationClient',
        'clients','articleEnRupture','dernieresCommandes',
        'dernieresInscriptions','dernieresCommandesPourActivite','topProducts','labels','data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}