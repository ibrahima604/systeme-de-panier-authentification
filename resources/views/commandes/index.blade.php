<x-app-layout>
    <x-slot name="header">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-10">
            <div class="flex items-center justify-between py-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Finalisez votre commande</h1>
                    <nav class="flex mt-2" aria-label="Breadcrumb">
                        <ol class="inline-flex items-center space-x-1 md:space-x-3">
                            <li class="inline-flex items-center">
                                <a href="{{ route('panier.index') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-blue-600">
                                    Panier
                                </a>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <i class="bi bi-chevron-right text-gray-400 mx-2"></i>
                                    <span class="ml-1 text-sm font-medium text-gray-700 md:ml-2">Paiement</span>
                                </div>
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="flex items-center">
                    <span class="text-gray-500 mr-2">Total:</span>
                    <span class="text-xl font-bold text-blue-600">{{ number_format($total, 2) }} MAD</span>
                </div>
            </div>
        </div>
    </x-slot>
    @if (session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif


    <div class="bg-gray-50 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <form action="{{route('valider.panier')}}" method="POST" class="flex flex-col lg:flex-row gap-8">
                @csrf
                
                <!-- Section principale -->
                @if ($errors->any())
                    <div class="fixed top-20 right-4 z-50">
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                            <strong class="font-bold">Erreur !</strong>
                            <span class="block sm:inline">Veuillez corriger les erreurs dans le formulaire.</span>
                        </div>
                    </div>
                @endif

                <div class="lg:w-2/3">
                    <!-- Carte de paiement -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-semibold text-gray-900">Méthode de paiement</h2>
                        </div>
                        <div class="p-6">
                            <!-- Options de paiement -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <input type="radio" name="mode_paiement" id="carte" value="carte" class="hidden peer" checked>
                                    <label for="carte" class="flex items-center justify-between p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300 transition">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                                <i class="bi bi-credit-card text-blue-600 text-xl"></i>
                                            </div>
                                          <div class="flex items-center space-x-3">
                                            <div>
                                                <h3 class="font-medium text-gray-900">Carte bancaire</h3>
                                                <p class="text-sm text-gray-500">Visa, Mastercard, etc.</p>
                                            </div>
                                            <div class="flex space-x-2">
                                                <!-- Visa -->
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/4/41/Visa_Logo.png" alt="Visa" class="h-3">
                                                <!-- Mastercard -->
                                                <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" class="h-3">
                                            </div>
                                            </div>

                                        </div>
                                        <div class="flex space-x-3 text-gray-700">
                                            <i class="fa-brands fa-cc-visa text-2xl" style="color: #1a1f71;"></i>
                                            <i class="fa-brands fa-cc-mastercard text-2xl" style="color: #eb001b;"></i>
                                        </div>
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" name="mode_paiement" id="especes" value="especes" class="hidden peer">
                                    <label for="especes" class="flex items-center justify-between p-4 border-2 border-gray-200 rounded-lg cursor-pointer peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300 transition">
                                        <div class="flex items-center">
                                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                                <i class="bi bi-cash text-green-600 text-xl"></i>
                                            </div>
                                            <div>
                                                <h3 class="font-medium text-gray-900">Paiement à la livraison</h3>
                                                <p class="text-sm text-gray-500">Espèces ou carte</p>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Formulaire carte bancaire -->
                            <div id="carte-info" class="space-y-4">
                                <div>
                                    <label for="nom_carte" class="block text-sm font-medium text-gray-700 mb-1">Nom sur la carte</label>
                                    <div class="relative">
                                        <input type="text" name="nom_carte" id="nom_carte" value="{{ old('nom_carte') }}" class="w-full pl-10 pr-4 py-3 border {{ $errors->has('nom_carte') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Jean Dupont">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-person text-gray-400"></i>
                                        </div>
                                    </div>
                                    @error('nom_carte')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="numero_carte" class="block text-sm font-medium text-gray-700 mb-1">Numéro de carte</label>
                                    <div class="relative">
                                        <input type="text" name="numero_carte" id="numero_carte" maxlength="19" value="{{ old('numero_carte') }}" class="w-full pl-10 pr-4 py-3 border {{ $errors->has('numero_carte') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="1234 5678 9012 3456">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-credit-card text-gray-400"></i>
                                        </div>
                                    </div>
                                    @error('numero_carte')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="expiration" class="block text-sm font-medium text-gray-700 mb-1">Date d'expiration</label>
                                        <div class="relative">
                                            <input type="text" name="expiration" id="expiration" maxlength="5" value="{{ old('expiration') }}" class="w-full pl-10 pr-4 py-3 border {{ $errors->has('expiration') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="MM/AA">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="bi bi-calendar text-gray-400"></i>
                                            </div>
                                        </div>
                                        @error('expiration')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div>
                                        <label for="cvv" class="block text-sm font-medium text-gray-700 mb-1">Code de sécurité</label>
                                        <div class="relative">
                                            <input type="text" name="cvv" id="cvv" maxlength="4" value="{{ old('cvv') }}" class="w-full pl-10 pr-4 py-3 border {{ $errors->has('cvv') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="CVV">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="bi bi-lock text-gray-400"></i>
                                            </div>
                                        </div>
                                        @error('cvv')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Adresse de livraison -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-semibold text-gray-900">Adresse de livraison</h2>
                        </div>
                        <div class="p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="pays" class="block text-sm font-medium text-gray-700 mb-1">Pays</label>
                                    <select name="pays" id="pays" class="w-full p-3 border {{ $errors->has('pays') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                        <option value="Maroc" {{ old('pays', 'Maroc') == 'Maroc' ? 'selected' : '' }}>Maroc</option>
                                        <option value="France" {{ old('pays') == 'France' ? 'selected' : '' }}>France</option>
                                        <option value="Espagne" {{ old('pays') == 'Espagne' ? 'selected' : '' }}>Espagne</option>
                                    </select>
                                    @error('pays')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="ville" class="block text-sm font-medium text-gray-700 mb-1">Ville</label>
                                    <input type="text" name="ville" id="ville" value="{{ old('ville') }}" class="w-full p-3 border {{ $errors->has('ville') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Casablanca">
                                    @error('ville')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="adresse" class="block text-sm font-medium text-gray-700 mb-1">Adresse complète</label>
                                <input type="text" name="adresse" id="adresse" value="{{ old('adresse') }}" class="w-full p-3 border {{ $errors->has('adresse') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="123 Rue Mohamed V">
                                @error('adresse')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                                <div>
                                    <label for="code_postal" class="block text-sm font-medium text-gray-700 mb-1">Code postal</label>
                                    <input type="text" name="code_postal" id="code_postal" value="{{ old('code_postal') }}" class="w-full p-3 border {{ $errors->has('code_postal') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="20000">
                                    @error('code_postal')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="telephone" class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                                    <input type="tel" name="telephone" id="telephone" value="{{ old('telephone') }}" class="w-full p-3 border {{ $errors->has('telephone') ? 'border-red-500' : 'border-gray-300' }} rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="+212 6 00 00 00 00">
                                    @error('telephone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Récapitulatif de commande -->
                <aside class="lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-lg font-semibold mb-4 text-gray-900">Résumé de la commande</h2>
                        
                        <div class="border-t border-gray-200 mt-4 pt-4">
                            <div class="flex justify-between text-gray-700 mb-2">
                                <span>Sous-total</span>
                                <span>{{ number_format($total, 2) }} MAD</span>
                            </div>
                            <div class="flex justify-between text-gray-700 mb-2">
                                <span>Frais de livraison</span>
                                <span>Gratuit</span>
                            </div>
                            <div class="flex justify-between font-semibold text-lg text-gray-900 border-t pt-2">
                                <span>Total</span>
                                <span>{{ number_format($total, 2) }} MAD</span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="mt-6 w-full bg-blue-600 text-white font-semibold py-3 px-4 rounded-lg hover:bg-blue-700 transition">
                        Valider et Payer
                    </button>
                </aside>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const carteRadio = document.getElementById('carte');
            const especesRadio = document.getElementById('especes');
            const carteInfo = document.getElementById('carte-info');

            function toggleCardForm() {
                carteInfo.style.display = carteRadio.checked ? 'block' : 'none';
            }

            carteRadio.addEventListener('change', toggleCardForm);
            especesRadio.addEventListener('change', toggleCardForm);

            toggleCardForm();
        });
    </script>
</x-app-layout>