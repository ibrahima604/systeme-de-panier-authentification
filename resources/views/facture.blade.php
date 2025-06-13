<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture {{ $numero_facture }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: 13px;
            color: #333;
            line-height: 1.6;
            padding: 30px;
            background-color: #f9fafb;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            border-radius: 10px;
            overflow: hidden;
            padding: 40px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding-bottom: 25px;
            border-bottom: 1px solid #eaeef2;
        }
        .invoice-header {
            flex: 1;
        }
        .invoice-title {
            font-size: 28px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }
        .invoice-number {
            display: inline-block;
            background: #f3f4f6;
            padding: 5px 10px;
            border-radius: 6px;
            font-weight: 500;
            margin-top: 5px;
        }
        .company-info {
            text-align: right;
        }
        .company-logo {
            height: 50px;
            margin-bottom: 15px;
        }
        .company-name {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin-bottom: 5px;
        }
        .company-details {
            color: #6b7280;
            line-height: 1.5;
        }
        .client-payment-container {
            display: flex;
            gap: 30px;
            margin-bottom: 30px;
        }
        .client-info, .payment-info {
            flex: 1;
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
        }
        .section-title {
            font-size: 15px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }
        .section-title:before {
            content: "";
            display: inline-block;
            width: 4px;
            height: 16px;
            background: #4f46e5;
            margin-right: 10px;
            border-radius: 2px;
        }
        .client-name {
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 5px;
        }
        .client-details {
            color: #6b7280;
            line-height: 1.6;
        }
        .payment-method {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .payment-icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            color: #4f46e5;
        }
        .status-badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 500;
        }
        .status-paid {
            background-color: #ecfdf5;
            color: #059669;
        }
        .status-pending {
            background-color: #fffbeb;
            color: #d97706;
        }
        .status-cancelled {
            background-color: #fee2e2;
            color: #dc2626;
        }
        .items-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin: 30px 0;
        }
        .items-table thead th {
            background-color: #f9fafb;
            color: #6b7280;
            text-align: left;
            padding: 12px 15px;
            font-weight: 600;
            border-bottom: 1px solid #eaeef2;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .items-table tbody tr {
            transition: background 0.2s;
        }
        .items-table tbody tr:hover {
            background-color: #f9fafb;
        }
        .items-table td {
            padding: 15px;
            border-bottom: 1px solid #eaeef2;
            vertical-align: middle;
        }
        .product-cell {
            display: flex;
            align-items: center;
        }
        .product-image {
            width: 48px;
            height: 48px;
            object-fit: cover;
            margin-right: 15px;
            border-radius: 6px;
            border: 1px solid #f3f4f6;
        }
        .product-name {
            font-weight: 500;
            margin-bottom: 3px;
        }
        .product-sku {
            color: #9ca3af;
            font-size: 12px;
        }
        .quantity {
            display: inline-block;
            padding: 5px 10px;
            background: #f3f4f6;
            border-radius: 4px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .totals-table {
            width: 280px;
            float: right;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
        }
        .totals-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eaeef2;
        }
        .totals-table tr:last-child td {
            border-bottom: none;
        }
        .grand-total {
            font-weight: 600;
            font-size: 15px;
            color: #111827;
            background: #f9fafb;
            border-radius: 0 0 8px 8px;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #eaeef2;
            font-size: 11px;
            color: #9ca3af;
            text-align: center;
        }
        .notes {
            margin-top: 40px;
            padding: 15px;
            background: #f9fafb;
            border-radius: 8px;
            font-size: 12px;
            color: #6b7280;
        }
        .thank-you {
            text-align: center;
            margin: 30px 0;
            font-size: 14px;
            color: #6b7280;
        }
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #eaeef2, transparent);
            margin: 25px 0;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- En-tête avec logo et info facture -->
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

        <!-- Informations client et paiement -->
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
                <div class="payment-method">
                    <svg class="payment-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
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

        <!-- Détails des articles -->
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
        <div style="clear: both;"></div>
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

        <div class="divider"></div>

        <div class="thank-you">
            Merci pour votre confiance. Pour toute question concernant cette facture, veuillez contacter notre service client.
        </div>

        <div class="notes">
            <strong>Notes:</strong> Paiement attendu sous 30 jours. Paiement par virement bancaire sur le compte IBAN: MA02 0000 0000 0000 0000 0000 000.
        </div>
    </div>
</body>
</html>