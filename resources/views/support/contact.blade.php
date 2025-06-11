@php 
use Illuminate\Support\Facades\Auth;
@endphp
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Support</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen flex items-center">
    <div class="w-full max-w-4xl mx-auto p-4">
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Header avec logo et navigation optionnelle -->
            <div class="bg-blue-600 px-6 py-4 flex justify-between items-center">
                @if(auth()->check())
                
                <a href="/" class="text-white font-bold text-xl flex items-center">
                    <i class="fas fa-store mr-2"></i> MonEcommerce
                </a>

                <a href="/" class="text-white hover:text-blue-100 transition">
                    <i class="fas fa-arrow-left mr-1"></i> Retour à l'accueil
                </a>
                @else
                 <a href="{{route('dashboard')}}" class="text-white font-bold text-xl flex items-center">
                    <i class="fas fa-store mr-2"></i> MonEcommerce
                </a>

                <a href="{{route('dashboard')}}" class="text-white hover:text-blue-100 transition">
                    <i class="fas fa-arrow-left mr-1"></i> Retour à l'accueil
                </a>
                @endif

            </div>

            <!-- Contenu principal -->
            <div class="md:flex">
                <!-- Illustration côté gauche (visible sur desktop) -->
                <div class="hidden md:block md:w-1/3 bg-blue-50 p-8 flex items-center">
                    <div class="text-center">
                        <i class="fas fa-headset text-blue-400 text-6xl mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-800">Support Client</h3>
                        <p class="text-gray-600 mt-2">Nous sommes là pour vous aider 24h/24</p>
                    </div>
                </div>

                <!-- Formulaire de contact -->
                <div class="md:w-2/3 p-8">
                    <h2 class="text-2xl font-bold text-gray-800 mb-1">Contactez notre équipe</h2>
                    <p class="text-gray-600 mb-6">Remplissez ce formulaire pour nous faire part de votre demande</p>

                    @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    </div>
                    @endif

                    <form action="{{ route('support.message') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Champ message -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">
                                Votre message <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                name="message" 
                                id="message" 
                                rows="5"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Décrivez en détail votre problème ou question..."
                                required
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-1"></i> {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Informations supplémentaires -->
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                            <h4 class="font-medium text-blue-800 mb-2 flex items-center">
                                <i class="fas fa-info-circle mr-2"></i> À savoir
                            </h4>
                            <ul class="text-sm text-blue-700 space-y-1">
                                <li class="flex items-start">
                                    <i class="fas fa-clock mt-1 mr-2 text-blue-500"></i>
                                    <span>Réponse sous 24h en semaine</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-phone-alt mt-1 mr-2 text-blue-500"></i>
                                    <span>Service téléphonique : 0632684091</span>
                                </li>
                            </ul>
                        </div>

                        <!-- Bouton de soumission -->
                        <div class="pt-2">
                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-6 rounded-lg font-medium transition flex items-center justify-center">
                                <i class="fas fa-paper-plane mr-2"></i> Envoyer la demande
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200 text-center text-sm text-gray-500">
                <p>© {{ date('Y') }} MonEcommerce - Tous droits réservés</p>
            </div>
        </div>
    </div>
</body>
</html>