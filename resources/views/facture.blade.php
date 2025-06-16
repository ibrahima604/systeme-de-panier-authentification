<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture {{ $numero_facture }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            font-size: 12px;
            color: #333;
            background-color: #f4f4f5;
            padding: 20px;
        }

        .invoice-container {
            max-width: 720px;
            margin: auto;
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 24px 32px;
            box-shadow: 0 1px 6px rgba(0,0,0,0.06);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 20px;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 16px;
            margin-bottom: 20px;
        }

        .invoice-header, .company-info {
            width: 48%;
        }

        .invoice-title {
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 4px;
            color: #1f2937;
        }

        .invoice-number {
            background: #f3f4f6;
            font-weight: 500;
            font-size: 12px;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .company-logo {
            height: 40px;
            margin-bottom: 8px;
        }

        .company-details,
        .client-details,
        .payment-info,
        .notes {
            font-size: 12px;
            color: #6b7280;
            line-height: 1.4;
        }

        .section-title {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #374151;
        }

        .client-payment-container {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 30px;
        }

        .client-info, .payment-info {
            width: 48%;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table thead th,
        .items-table td {
            font-size: 12px;
            padding: 10px 8px;
            border-bottom: 1px solid #e5e7eb;
        }

        .product-image {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        .product-cell {
            display: flex;
            align-items: center;
        }

        .quantity {
            padding: 3px 8px;
            font-size: 12px;
        }

        .totals-table {
            width: 100%;
        }

        .totals-table td {
            padding: 8px;
            font-size: 13px;
        }

        .totals-table .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .grand-total {
            font-size: 14px;
            font-weight: 700;
        }

        .footer, .thank-you {
            font-size: 11px;
            color: #9ca3af;
            text-align: center;
            margin-top: 30px;
        }

        .status-badge {
            font-weight: 600;
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 4px;
        }

        .status-paid {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- En-tête -->
        <div class="header">
            <div class="invoice-header">
                <div class="invoice-title">Facture</div>
                <div style="margin-top: 15px;">
                    <div style="margin-bottom: 8px;">
                        <span style="color: #6b7280;">N°:</span> 
                        <span class="invoice-number">{{ $numero_facture }}</span>
                    </div>
                    <div style="margin-bottom: 8px;">
                        <span style="color: #6b7280;">Date:</span> 
                        <span style="font-weight: 500;">{{ $date }}</span>
                    </div>
                    <div>
                        <span style="color: #6b7280;">Commande:</span> 
                        <span style="font-weight: 500;">#{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                </div>
            </div>
            <div class="company-info">
                <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="company-logo">
                <div class="company-name">D2Market (Diallo&Diaby)</div>
                <div class="company-details">
                    123 Rue de Commerce, Casablanca<br>
                    Tél: 06 32 68 40 91<br>
                    Email: contact@d2market.com<br>
                    SIRET: 123 456 789 00010
                </div>
            </div>
        </div>

        <!-- Infos client & paiement -->
        <div class="client-payment-container">
            <div class="client-info">
                <div class="section-title">Client</div>
                <div class="client-name">{{ $commande->user->prenom }} {{ $commande->user->nom }}</div>
                <div class="client-details">
                    {{ $commande->adresse }}<br>
                    {{ $commande->user->email }}<br>
                    Tél: {{ $commande->user->telephone }}
                </div>
            </div>
            <div class="payment-info">
                <div class="section-title">Paiement</div>
                <div class="payment-method" style="display: flex; align-items: center; gap: 10px;">
                    <svg class="payment-icon" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                    </svg>
                    <div>
                        <div style="font-weight: 500;">{{ ucfirst($commande->mode_paiement) }}</div>
                        <div style="font-size: 12px; color: #6b7280;">Méthode de paiement</div>
                    </div>
                </div>
                <div style="margin: 15px 0;">
                    <span class="status-badge 
                        @if($commande->status === 'livré') status-paid
                        @elseif($commande->status === 'annulé') status-cancelled
                        @else status-pending @endif">
                        {{ ucfirst($commande->status) }}
                    </span>
                </div>
                <div style="color: #6b7280; font-size: 12px;">
                    <div style="margin-bottom: 5px;">
                        <span>Date commande:</span> 
                        <span style="font-weight: 500;">{{ $commande->created_at->format('d/m/Y') }}</span>
                    </div>
                    @if($commande->status === 'livré')
                    <div>
                        <span>Livré le:</span> 
                        <span style="font-weight: 500;">{{ $commande->updated_at->format('d/m/Y') }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Table des produits -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 50%;">Produit</th>
                    <th style="width: 15%;">Prix unitaire</th>
                    <th style="width: 10%;">Qté</th>
                    <th style="width: 20%;" class="text-right">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($commande->lignes as $index => $ligne)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <div class="product-cell">
                            @if($ligne->image)
                            <img src="{{ public_path('storage/' . $ligne->image) }}" class="product-image" alt="{{ $ligne->article->libelle }}">
                            @endif
                            <div>
                                <div class="product-name">{{ $ligne->article->libelle }}</div>
                                <div class="product-sku">Réf: {{ $ligne->article->id }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ number_format($ligne->prix, 2, ',', ' ') }} MAD</td>
                    <td class="text-center">
                        <span class="quantity">{{ $ligne->quantite_commande }}</span>
                    </td>
                    <td class="text-right">{{ number_format($ligne->prix * $ligne->quantite_commande, 2, ',', ' ') }} MAD</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totaux -->
        <table class="totals-table">
            <tr>
                <td>Sous-total:</td>
                <td class="text-right">{{ number_format($total, 2, ',', ' ') }} MAD</td>
            </tr>
            <tr>
                <td>Livraison:</td>
                <td class="text-right">0,00 MAD</td>
            </tr>
            <tr>
                <td>Remise:</td>
                <td class="text-right">0,00 MAD</td>
            </tr>
            <tr class="grand-total">
                <td>Total TTC:</td>
                <td class="text-right">{{ number_format($total, 2, ',', ' ') }} MAD</td>
            </tr>
        </table>

        <div class="thank-you">
            Merci pour votre confiance. Pour toute question concernant cette facture, veuillez contacter notre service client.
        </div>

        <div class="notes">
            <strong>Notes:</strong> Paiement attendu sous 30 jours. Paiement par virement bancaire sur le compte IBAN: MA02 0000 0000 0000 0000 0000 000.
        </div>
    </div>
</body>
</html>
