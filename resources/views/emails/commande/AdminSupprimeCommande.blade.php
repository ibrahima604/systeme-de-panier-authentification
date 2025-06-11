@component('mail::message')
{{-- Logo --}}
<div style="text-align: center; margin-bottom: 24px;">
    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" style="height: 56px; margin: 0 auto;">
</div>

# Bonjour {{ $commande->user->prenom }},

Nous vous informons que votre commande **#{{ $commande->id }}** a été **supprimée**.

<div style="padding: 16px; background-color: #fef3c7; color: #92400e; border-radius: 8px; font-weight: 600; margin: 20px 0;">
    Si vous avez des questions ou besoin d’assistance, notre équipe reste à votre écoute.
</div>

## 🧾 Détails de la commande supprimée

<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr style="background-color: #f3f4f6; text-align: left; font-weight: bold;">
            <th style="padding: 8px; border: 1px solid #e5e7eb;">Image</th>
            <th style="padding: 8px; border: 1px solid #e5e7eb;">Produit</th>
            <th style="padding: 8px; border: 1px solid #e5e7eb; text-align: center;">Qté</th>
            <th style="padding: 8px; border: 1px solid #e5e7eb;">Taille</th>
            <th style="padding: 8px; border: 1px solid #e5e7eb;">Couleur</th>
            <th style="padding: 8px; border: 1px solid #e5e7eb; text-align: right;">Prix</th>
            <th style="padding: 8px; border: 1px solid #e5e7eb; text-align: right;">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($commande->lignes as $ligne)
        <tr style="border-bottom: 1px solid #e5e7eb;">
            <td style="padding: 8px; border: 1px solid #e5e7eb; text-align: center;">
                <img src="{{ asset('storage/' . $ligne->image) }}" alt="Produit" style="height: 50px; border-radius: 6px;">
            </td>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">
                <strong>{{ $ligne->article->nom }}</strong>
            </td>
            <td style="padding: 8px; border: 1px solid #e5e7eb; text-align: center;">
                {{ $ligne->quantite_commande }}
            </td>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">
                {{ $ligne->taille ?? '-' }}
            </td>
            <td style="padding: 8px; border: 1px solid #e5e7eb;">
                {{ $ligne->couleur ?? '-' }}
            </td>
            <td style="padding: 8px; border: 1px solid #e5e7eb; text-align: right;">
                {{ number_format($ligne->prix, 2, ',', ' ') }} MAD
            </td>
            <td style="padding: 8px; border: 1px solid #e5e7eb; text-align: right;">
                {{ number_format($ligne->prix * $ligne->quantite_commande, 2, ',', ' ') }} MAD
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr style="background-color: #f3f4f6; font-weight: bold;">
            <td colspan="6" style="padding: 12px; text-align: right; border: 1px solid #e5e7eb;">Total :</td>
            <td style="padding: 12px; text-align: right; border: 1px solid #e5e7eb;">
                {{ number_format($total, 2, ',', ' ') }} MAD
            </td>
        </tr>
    </tfoot>
</table>

<div style="text-align: center; margin: 32px 0;">
    @component('mail::button', ['url' => route('support.contact')])
        Contacter le support
    @endcomponent
</div>

Merci pour votre confiance,<br>
**{{ config('app.name') }}**
@endcomponent
