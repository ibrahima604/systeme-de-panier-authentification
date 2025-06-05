<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class FactureController extends Controller
{
    public function generate()
    {
        $data = [
            'client' => 'Jean Dupont',
            'date' => date('d/m/Y'),
            'items' => [
                ['nom' => 'Pizza Margherita', 'quantite' => 2, 'prix' => 12],
                ['nom' => 'Coca-Cola', 'quantite' => 3, 'prix' => 3],
            ],
        ];

        $pdf = PDF::loadView('facture', $data);
        return $pdf->download('facture.pdf');
    }
}
