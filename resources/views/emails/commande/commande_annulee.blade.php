<!DOCTYPE html>
<html>
<head>
    <title>Commande annulée</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans">
    <div class="max-w-2xl mx-auto my-8 bg-white rounded-lg shadow-md overflow-hidden">
        <!-- En-tête -->
        <div class="bg-red-600 px-6 py-4">
            <h1 class="text-2xl font-bold text-white">Commande annulée</h1>
        </div>

        <!-- Contenu principal -->
        <div class="px-6 py-8">
            <div class="flex items-center mb-6">
                <div class="bg-red-100 p-3 rounded-full mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">Bonjour {{ $commande->user->prenom ?? 'client' }},</h2>
            </div>

            <div class="space-y-4 text-gray-700">
                <p>Nous vous confirmons que votre commande <strong class="text-red-600">#{{ str_pad($commande->id, 6, '0', STR_PAD_LEFT) }}</strong> a bien été annulée.</p>
                
                <div class="bg-red-50 border-l-4 border-red-500 p-4">
                    <p class="font-medium text-red-700">Cette commande ne sera plus traitée par notre service.</p>
                </div>

                <p>Si cette annulation est une erreur, vous pouvez :</p>
                <ul class="list-disc pl-5 space-y-2">
                    <li>Recréer une nouvelle commande identique</li>
                    <li>Nous contacter dans les 24h pour réactiver cette commande</li>
                </ul>
            </div>

            <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                <h3 class="font-medium text-gray-800 mb-2">Besoin d'aide ?</h3>
                <p>Notre équipe est disponible pour répondre à vos questions :</p>
                <a href="mailto:contact@votreboutique.com" class="inline-block mt-2 text-blue-600 hover:underline">contact@votreboutique.com</a>
            </div>
        </div>

        <!-- Pied de page -->
        <div class="bg-gray-100 px-6 py-4 border-t border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-600 text-sm">Merci de votre confiance.</p>
                <p class="text-gray-600 text-sm mt-2 md:mt-0">L'équipe <strong>{{ config('app.name') }}</strong></p>
            </div>
        </div>
    </div>
</body>
</html>