<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmation de votre commande</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 1px solid #f0f0f0;
            margin-bottom: 30px;
        }
        .logo {
            max-height: 50px;
            margin-bottom: 15px;
        }
        .order-number {
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
            margin: 15px 0;
        }
        .status-badge {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 4px;
            font-weight: bold;
            background-color: #e3f9f8;
            color: #0a8278;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2c3e50;
            color: white !important;
            text-decoration: none;
            border-radius: 4px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
            font-size: 12px;
            color: #7f8c8d;
            text-align: center;
        }
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 15px;
        }
        .product-row {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f5f5f5;
        }
        .product-info {
            flex: 1;
        }
        .product-name {
            font-weight: bold;
            margin-bottom: 5px;
        }
        .product-price {
            color: #2c3e50;
        }
        .total-amount {
            font-size: 18px;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ $message->embed(public_path('images/logo.png')) }}" alt="Logo" class="logo">
        <h1>Confirmation de commande</h1>
    </div>

    <p>Bonjour {{ $commande->user->prenom }},</p>
    <p>Nous vous remercions pour votre commande sur notre boutique en ligne.</p>

    <div class="order-number">
        Commande #{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}
    </div>

    <div>
        <span class="status-badge">Statut : {{ ucfirst($commande->status) }}</span>
        <p>Date de commande : {{ $commande->created_at->format('d/m/Y à H\hi') }}</p>
    </div>

    <h3>Récapitulatif de votre commande :</h3>

    @foreach($commande->lignes as $ligne)
    <div class="product-row">
        @if($ligne->image)
        <img src="{{ $message->embed(storage_path('app/public/' . $ligne->image)) }}" class="product-image" alt="{{ $ligne->article->libelle }}">
        @endif
        <div class="product-info">
            <div class="product-name">{{ $ligne->article->libelle }}</div>
            <div>Quantité : {{ $ligne->quantite_commande }}</div>
            <div class="product-price">{{ number_format($ligne->prix, 2, ',', ' ') }} MAD</div>
        </div>
        <div>{{ number_format($ligne->prix * $ligne->quantite_commande, 2, ',', ' ') }} MAD</div>
    </div>
    @endforeach

    <div class="total-amount">
        Total : {{ number_format($total, 2, ',', ' ') }} MAD
    </div>

    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ route('commandes.show', $commande->id) }}" class="button">Suivre ma commande</a>
    </div>

    <p>Vous recevrez une notification lorsque votre commande sera expédiée.</p>
    <p>Pour toute question concernant votre commande, notre service client est à votre disposition.</p>

    <div class="footer">
        <p>{{ config('app.name') }} - 123 Rue de Commerce, Casablanca</p>
        <p>Tél : 06 32 68 40 91 | Email : contact@entreprise.com</p>
        <p>© {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</p>
    </div>
</body>
</html>