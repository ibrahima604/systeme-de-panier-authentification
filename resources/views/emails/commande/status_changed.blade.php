@component('mail::message')
{{-- En-tête avec logo centré et espacement --}}
<div style="text-align:center; margin-bottom: 2rem;">
    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" style="height: 56px; width: auto; margin: 0 auto;">
</div>

{{-- Titre principal --}}
<h1 style="font-weight: 700; font-size: 1.5rem; color: #1F2937; margin-bottom: 1rem; text-align:center;">
    Bonjour {{ $commande->user->prenom }},
</h1>

<p style="font-size: 1.125rem; color: #4B5563; text-align:center; margin-bottom: 2rem;">
    Le statut de votre commande <strong>#{{ $commande->id }}</strong> a été mis à jour.
</p>

@php
    $statusColors = [
        'en attente' => '#FBBF24',  // jaune
        'en cours' => '#3B82F6',    // bleu
        'expédiée' => '#6B7280',    // gris
        'livrée' => '#10B981',      // vert
    ];
    $color = $statusColors[$commande->status] ?? '#6B7280';
@endphp

<div style="background-color: {{ $color }}; color: white; font-weight: 600; border-radius: 8px; max-width: 200px; margin: 0 auto 3rem auto; padding: 12px 24px; text-align: center; font-size: 1.125rem;">
    Nouveau statut : {{ ucfirst($commande->status) }}
</div>

{{-- Tableau des détails --}}
<table style="width: 100%; max-width: 600px; margin: 0 auto 3rem auto; border-collapse: collapse; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <thead>
        <tr style="background-color: #F3F4F6; color: #374151; font-weight: 600; text-align: left;">
            <th style="padding: 0.75rem; border-bottom: 2px solid #E5E7EB;">Image</th>
            <th style="padding: 0.75rem; border-bottom: 2px solid #E5E7EB;">Produit</th>
            <th style="padding: 0.75rem; border-bottom: 2px solid #E5E7EB; text-align:center;">Quantité</th>
            <th style="padding: 0.75rem; border-bottom: 2px solid #E5E7EB; text-align:right;">Prix unitaire</th>
            <th style="padding: 0.75rem; border-bottom: 2px solid #E5E7EB; text-align:right;">Sous-total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($commande->lignes as $ligne)
        <tr style="border-bottom: 1px solid #E5E7EB;">
            <td style="padding: 0.75rem; vertical-align: middle; text-align:center;">
                <img src="{{ asset('storage/' . $ligne->image) }}" alt="{{ $ligne->article->nom }}" style="height: 48px; width: auto; border-radius: 6px; object-fit: cover;">
            </td>
            <td style="padding: 0.75rem; vertical-align: middle;">
                <strong style="color: #1F2937;">{{ $ligne->article->nom }}</strong><br>
                <small style="color: #6B7280;">Taille : {{ $ligne->taille ?? '-' }}, Couleur : {{ $ligne->couleur ?? '-' }}</small>
            </td>
            <td style="padding: 0.75rem; vertical-align: middle; text-align:center; color: #374151;">{{ $ligne->quantite_commande }}</td>
            <td style="padding: 0.75rem; vertical-align: middle; text-align:right; color: #374151;">
                {{ number_format($ligne->prix, 2, ',', ' ') }} MAD
            </td>
            <td style="padding: 0.75rem; vertical-align: middle; text-align:right; font-weight: 600; color: #111827;">
                {{ number_format($ligne->prix * $ligne->quantite_commande, 2, ',', ' ') }} MAD
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr style="background-color: #F9FAFB; font-weight: 700; font-size: 1.125rem; color: #111827;">
            <td colspan="4" style="padding: 1rem; text-align:right; border-top: 2px solid #E5E7EB;">Total :</td>
            <td style="padding: 1rem; text-align:right; border-top: 2px solid #E5E7EB;">
                {{ number_format($total, 2, ',', ' ') }} MAD
            </td>
        </tr>
    </tfoot>
</table>

{{-- Bouton --}}
@component('mail::button', ['url' => route('commandes.show', $commande->id), 'color' => 'primary'])
Voir votre commande
@endcomponent

{{-- Footer --}}
<p style="text-align: center; color: #6B7280; font-size: 0.875rem; margin-top: 3rem;">
    Merci de votre confiance,<br>
   
</p>
@endcomponent
