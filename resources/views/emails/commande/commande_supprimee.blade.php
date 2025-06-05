<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Commande supprimée</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 font-sans">
    <div class="max-w-2xl mx-auto my-10 bg-white shadow-md rounded-lg overflow-hidden">
        <!-- Header -->
        <div class="bg-red-600 px-6 py-4">
            <div class="flex items-center justify-between">
                <h1 class="text-2xl font-bold text-white">
                    <i class="fas fa-exclamation-triangle mr-2"></i> Commande annulée
                </h1>
                <div class="bg-white p-2 rounded-full">
                    <i class="fas fa-trash-alt text-red-600 text-xl"></i>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-8 py-6">
            <div class="mb-6">
                <p class="text-gray-700 mb-2">Bonjour <span class="font-semibold text-gray-900">{{ $commande->user->name }}</span>,</p>
                <p class="text-gray-700">Nous vous confirmons que votre commande a bien été annulée.</p>
            </div>

            <div class="border border-gray-200 rounded-lg p-4 mb-6">
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-lg font-semibold text-gray-900">
                        <i class="fas fa-receipt mr-2 text-red-500"></i> Commande #{{ $commande->id }}
                    </h2>
                    <span class="px-3 py-1 rounded-full text-sm font-medium 
                        @if($commande->status === 'annulé') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800 @endif">
                        {{ ucfirst($commande->status) }}
                    </span>
                </div>
                <p class="text-gray-600 text-sm">
                    <i class="far fa-calendar-alt mr-1"></i> Date de création : 
                    {{ $commande->created_at->format('d/m/Y à H:i') }}
                </p>
            </div>

            <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <i class="fas fa-exclamation-circle text-red-500 mt-1"></i>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Action requise</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <p>Si vous n'êtes pas à l'origine de cette annulation, veuillez nous contacter immédiatement.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-blue-50 rounded-lg p-4 mb-6">
                <h3 class="text-sm font-medium text-blue-800 mb-2">
                    <i class="fas fa-headset mr-1"></i> Service client
                </h3>
                <p class="text-sm text-blue-700">
                    <i class="fas fa-phone-alt mr-2"></i> 06 32 68 40 91<br>
                    <i class="fas fa-envelope mr-2 mt-2"></i> contact@entreprise.com
                </p>
            </div>

            <div class="border-t border-gray-200 pt-4">
                <p class="text-gray-600 text-sm">Merci pour votre confiance.</p>
                <p class="text-gray-600 text-sm mt-1">L'équipe {{ config('app.name') }}</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="bg-gray-100 px-8 py-4 text-center text-xs text-gray-500">
            <p>© {{ date('Y') }} {{ config('app.name') }} - Tous droits réservés</p>
            <p class="mt-1">Cet email a été envoyé automatiquement, merci de ne pas y répondre.</p>
        </div>
    </div>
</body>
</html>