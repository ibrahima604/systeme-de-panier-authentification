<!DOCTYPE html>
<html>
<head>
    <title>Réactivation de votre commande</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <style type="text/tailwindcss">
        @layer utilities {
            .bg-gradient-green {
                background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            }
        }
    </style>
</head>
<body class="bg-gray-50 font-sans">
    <div class="max-w-2xl mx-auto my-8 bg-white rounded-lg shadow-md overflow-hidden">
        <!-- En-tête -->
        <div class="bg-gradient-green px-6 py-4">
            <h1 class="text-2xl font-bold text-white">Commande réactivée</h1>
        </div>

        <!-- Contenu principal -->
        <div class="px-6 py-8">
            <div class="flex items-center mb-6">
                <div class="bg-green-100 p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">Bonjour {{ $commande->user->prenom ?? 'client' }},</h2>
            </div>

            <div class="space-y-4 text-gray-700">
                <p>Nous vous confirmons que votre commande <strong class="text-green-600">#{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</strong> a bien été réactivée.</p>
                
                <div class="bg-green-50 border-l-4 border-green-500 p-4">
                    <p class="font-medium text-green-700">Votre commande est de nouveau en cours de traitement.</p>
                </div>

                <h3 class="text-lg font-medium mt-6">Détails de votre commande :</h3>
                
                <div class="space-y-6">
                    @foreach($commande->lignes as $ligne)
                    <div class="flex border-b border-gray-100 pb-4">
                        <div class="w-1/4 mr-4">
                            <img src="{{ asset('storage/' . $ligne->image) }}" alt="{{ $ligne->article->libelle }}" class="w-full h-auto rounded-lg object-cover">
                        </div>
                        <div class="w-3/4">
                            <h4 class="font-medium text-gray-800">{{ $ligne->article->libelle }}</h4>
                            <div class="grid grid-cols-2 gap-2 mt-2 text-sm">
                                <div>
                                    <span class="text-gray-500">Quantité :</span>
                                    <span class="font-medium">{{ $ligne->quantite }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500">Prix unitaire :</span>
                                    <span class="font-medium">{{ number_format($ligne->prix, 2, ',', ' ') }} €</span>
                                </div>
                                @if($ligne->taille)
                                <div>
                                    <span class="text-gray-500">Taille :</span>
                                    <span class="font-medium">{{ $ligne->taille }}</span>
                                </div>
                                @endif
                                @if($ligne->couleur)
                                <div>
                                    <span class="text-gray-500">Couleur :</span>
                                    <span class="inline-block w-4 h-4 rounded-full border border-gray-300" style="background-color: {{ $ligne->couleur }}"></span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                <h3 class="font-medium text-gray-800 mb-2">Suivi de commande</h3>
                <p>Vous pouvez suivre l'avancement de votre commande dans votre espace client :</p>
                <a href="{{ route('commandes.show', $commande->id) }}" class="inline-block mt-2 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">Voir ma commande</a>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="bg-gray-100 px-6 py-4 border-t border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-600 text-sm">Merci pour votre confiance.</p>
                <p class="text-gray-600 text-sm mt-2 md:mt-0">L'équipe <strong>{{ config('app.name') }}</strong></p>
            </div>
        </div>
    </div>
</body>
</html>