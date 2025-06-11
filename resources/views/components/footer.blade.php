@props(['author' => 'MonEntreprise'])

<!-- Inclure Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<footer class="bg-gray-900 text-white w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 py-12 border-b border-gray-800">
            <!-- Company Info -->
            <div class="col-span-2">
                <div class="flex items-center space-x-2 mb-4">
                    <svg class="h-8 w-8 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                    <span class="text-xl font-bold">E-Shop</span>
                </div>
                <p class="text-gray-400 text-sm mb-4">
                    Votre destination préférée pour des achats en ligne de qualité. Nous offrons les meilleurs produits avec un service client exceptionnel.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="bi bi-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="bi bi-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="bi bi-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="bi bi-linkedin text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-sm font-semibold text-gray-200 uppercase tracking-wider mb-4">Acheter</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Nouveautés</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Promotions</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Meilleures ventes</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Catégories</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Liste de souhaits</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h3 class="text-sm font-semibold text-gray-200 uppercase tracking-wider mb-4">Service Client</h3>
                <ul class="space-y-3">
                    <li><a href="{{route('support.contact')}}" class="text-gray-400 hover:text-white text-sm">Contactez-nous</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">FAQ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Livraison</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Retours</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white text-sm">Paiements sécurisés</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-sm font-semibold text-gray-200 uppercase tracking-wider mb-4">Newsletter</h3>
                <p class="text-gray-400 text-sm mb-4">
                    Abonnez-vous pour recevoir nos offres exclusives et les dernières nouveautés.
                </p>
                <form class="flex">
                    <input type="email" placeholder="Votre email" class="bg-gray-800 text-white px-4 py-2 text-sm rounded-l-md focus:outline-none focus:ring-1 focus:ring-indigo-500 w-full">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 text-sm rounded-r-md">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </form>
                <div class="mt-4 flex items-center space-x-2">
                    <i class="bi bi-shield-lock text-gray-400"></i>
                    <span class="text-xs text-gray-400">100% sécurisé</span>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="py-6 flex flex-col md:flex-row justify-between items-center">
            <div class="flex space-x-6 mb-4 md:mb-0">
                <a href="#" class="text-gray-400 hover:text-white text-xs">Conditions générales</a>
                <a href="#" class="text-gray-400 hover:text-white text-xs">Politique de confidentialité</a>
                <a href="#" class="text-gray-400 hover:text-white text-xs">Cookies</a>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-gray-400 text-sm">Paiements sécurisés :</span>
                <div class="flex space-x-2">
                    <i class="bi bi-credit-card text-xl text-gray-400"></i>
                    <i class="bi bi-paypal text-xl text-gray-400"></i>
                    <i class="bi bi-currency-bitcoin text-xl text-gray-400"></i>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="py-4 border-t border-gray-800 text-center">
            <p class="text-gray-500 text-xs">
                &copy; {{ date('Y') }} {{ $author }}. Tous droits réservés.
            </p>
        </div>
    </div>
</footer>