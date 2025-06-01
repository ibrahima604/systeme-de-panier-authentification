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

    <div class="bg-gray-50 py-8">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Section principale -->
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
                                            <div>
                                                <h3 class="font-medium text-gray-900">Carte bancaire</h3>
                                                <p class="text-sm text-gray-500">Visa, Mastercard, etc.</p>
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
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Nom sur la carte</label>
                                    <div class="relative">
                                        <input type="text" name="nom_carte" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Jean Dupont">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-person text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Numéro de carte</label>
                                    <div class="relative">
                                        <input type="text" name="numero_carte" maxlength="19" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="1234 5678 9012 3456">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-credit-card text-gray-400"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Date d'expiration</label>
                                        <div class="relative">
                                            <input type="text" name="expiration" maxlength="5" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="MM/AA">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="bi bi-calendar text-gray-400"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Code de sécurité</label>
                                        <div class="relative">
                                            <input type="text" name="cvv" maxlength="4" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="CVV">
                                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <i class="bi bi-lock text-gray-400"></i>
                                            </div>
                                        </div>
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
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Rechercher une adresse</label>
                                <div class="relative">
                                    <input id="adresse_livraison" name="adresse_livraison" class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Saisissez votre adresse">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-geo-alt text-gray-400"></i>
                                    </div>
                                </div>
                            </div>

                            <div id="map" class="rounded-lg border border-gray-300" style="height: 300px;"></div>

                            <input type="hidden" name="latitude" id="latitude">
                            <input type="hidden" name="longitude" id="longitude">

                            <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Complément d'adresse</label>
                                    <input type="text" name="complement" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="Appartement, étage...">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                                    <input type="tel" name="telephone" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="+212 6 12 34 56 78">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Récapitulatif -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 sticky top-8">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h2 class="text-lg font-semibold text-gray-900">Votre commande</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4 mb-6">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Sous-total</span>
                                    <span class="font-medium">{{ number_format($total, 2) }} MAD</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Livraison</span>
                                    <span class="font-medium">Gratuite</span>
                                </div>
                                <div class="flex justify-between border-t border-gray-200 pt-4">
                                    <span class="text-lg font-semibold">Total</span>
                                    <span class="text-lg font-bold text-blue-600">{{ number_format($total, 2) }} MAD</span>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="flex items-start">
                                    <input type="checkbox" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1">
                                    <span class="ml-2 block text-sm text-gray-700">
                                        J'accepte les <a href="#" class="text-blue-600 hover:underline">conditions générales</a> et la <a href="#" class="text-blue-600 hover:underline">politique de confidentialité</a>
                                    </span>
                                </label>
                            </div>

                            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg shadow-md transition duration-200 flex items-center justify-center">
                                <i class="bi bi-lock-fill mr-2"></i> Payer maintenant
                            </button>

                            <div class="mt-4 flex items-center justify-center text-sm text-gray-500">
                                <i class="bi bi-shield-lock mr-2 text-green-500"></i> Paiement 100% sécurisé
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Gestion des modes de paiement
        document.querySelectorAll('input[name="mode_paiement"]').forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('carte-info').style.display = this.value === 'carte' ? 'block' : 'none';
            });
        });

        // Initialisation de la carte Google Maps
        let map, marker, geocoder, autocomplete;

        function initMap() {
            const defaultLocation = { lat: 31.6300, lng: -8.0089 };

            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 13,
                styles: [
                    {
                        "featureType": "poi",
                        "stylers": [{ "visibility": "off" }]
                    }
                ]
            });

            geocoder = new google.maps.Geocoder();
            autocomplete = new google.maps.places.Autocomplete(
                document.getElementById("adresse_livraison"),
                { 
                    componentRestrictions: { country: "ma" },
                    fields: ["address_components", "geometry", "formatted_address"]
                }
            );

            autocomplete.addListener("place_changed", () => {
                const place = autocomplete.getPlace();
                if (!place.geometry) return;

                map.setCenter(place.geometry.location);
                setMarker(place.geometry.location);
                updateLatLng(place.geometry.location);
            });

            map.addListener("click", (e) => {
                setMarker(e.latLng);
                geocoder.geocode({ location: e.latLng }, (results, status) => {
                    if (status === "OK" && results[0]) {
                        document.getElementById("adresse_livraison").value = results[0].formatted_address;
                        updateLatLng(e.latLng);
                    }
                });
            });

            // Style du marqueur
            marker = new google.maps.Marker({
                map,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 8,
                    fillColor: "#4285F4",
                    fillOpacity: 1,
                    strokeWeight: 2,
                    strokeColor: "#FFFFFF"
                },
                draggable: true
            });

            marker.addListener("dragend", (e) => {
                geocoder.geocode({ location: e.latLng }, (results, status) => {
                    if (status === "OK" && results[0]) {
                        document.getElementById("adresse_livraison").value = results[0].formatted_address;
                        updateLatLng(e.latLng);
                    }
                });
            });
        }

        function updateLatLng(position) {
            document.getElementById("latitude").value = position.lat();
            document.getElementById("longitude").value = position.lng();
        }
    </script>

    <!-- Font Awesome pour les icônes de cartes bancaires -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Maps API -->
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYql3tBNe8HECpp8at7UzuoS_Xfx9VZe0&libraries=places&callback=initMap">
    </script>
</x-app-layout>