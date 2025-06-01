<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-gray-800">Paiement sécurisé</h2>
    </x-slot>

    <div class="max-w-2xl mx-auto mt-10 p-8 bg-white border border-gray-200 rounded-2xl shadow-lg">
        {{-- Message de session --}}
        @if (session('message'))
        <div class="mb-4 px-4 py-2 bg-green-100 text-green-800 rounded">
            {{ session('message') }}
        </div>
        @endif

        <form method="POST" action="">
            @csrf

            {{-- Mode de paiement --}}
            <div class="mb-6">
                <label for="mode_paiement" class="block text-gray-700 font-semibold mb-2">Mode de paiement</label>
                <select name="mode_paiement" id="mode_paiement"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-300">
                    <option value="carte">Carte bancaire</option>
                    <option value="especes">Espèces à la livraison</option>
                </select>
            </div>

            {{-- Infos carte bancaire --}}
            <div id="carte-info" class="space-y-4 hidden">
                <div>
                    <label class="block text-gray-700 font-medium mb-1">Nom sur la carte</label>
                    <input type="text" name="nom_carte"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        placeholder="Jean Dupont">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium mb-1">Numéro de carte</label>
                    <input type="text" name="numero_carte" maxlength="19"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                        placeholder="1234 5678 9012 3456">
                </div>

                <div class="flex gap-4">
                    <div class="w-1/2">
                        <label class="block text-gray-700 font-medium mb-1">Expiration</label>
                        <input type="text" name="expiration" maxlength="5"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                            placeholder="MM/AA">
                    </div>
                    <div class="w-1/2">
                        <label class="block text-gray-700 font-medium mb-1">CVV</label>
                        <input type="text" name="cvv" maxlength="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg"
                            placeholder="123">
                    </div>
                </div>
            </div>

            {{-- Adresse de livraison avec autocomplétion et carte --}}
            <div id="livraison-section" class="mb-6">
                <label for="adresse_livraison" class="block text-gray-700 font-semibold mb-2">Adresse de livraison</label>
                <input id="adresse_livraison" name="adresse_livraison"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg mb-3"
                    placeholder="Saisissez ou cliquez sur la carte" />

                <div id="map" class="rounded-lg border border-gray-300" style="height: 400px;"></div>

                <input type="hidden" name="latitude" id="latitude">
                <input type="hidden" name="longitude" id="longitude">
            </div>

            {{-- Montant total --}}
            <div class="mt-6 mb-6">
                <div class="flex items-center justify-between">
                    <span class="text-gray-700 text-lg font-medium">Total à payer :</span>
                    <span class="text-2xl font-bold text-green-600">
                        {{ $total ?? '0.00' }} MAD
                    </span>
                </div>
            </div>

            {{-- Bouton de confirmation --}}
            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                🔒 Confirmer le paiement
            </button>
        </form>
    </div>

    {{-- Script --}}
    <script>
        const modeSelect = document.getElementById('mode_paiement');
        const carteInfo = document.getElementById('carte-info');
        const livraisonSection = document.getElementById('livraison-section');

        function updateSections() {
            const isCarte = modeSelect.value === 'carte';
            carteInfo.classList.toggle('hidden', !isCarte);
            livraisonSection.classList.toggle('hidden', isCarte);
        }

        modeSelect.addEventListener('change', updateSections);
        window.addEventListener('DOMContentLoaded', updateSections);

        let map, marker, geocoder, autocomplete;

        function initMap() {
            const defaultLocation = { lat: 31.6300, lng: -8.0089 };

            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 13,
            });

            geocoder = new google.maps.Geocoder();
            autocomplete = new google.maps.places.Autocomplete(
                document.getElementById("adresse_livraison"),
                { componentRestrictions: { country: "ma" } }
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
        }

        function setMarker(position) {
            if (!marker) {
                marker = new google.maps.Marker({ map });
            }
            marker.setPosition(position);
        }

        function updateLatLng(position) {
            document.getElementById("latitude").value = position.lat();
            document.getElementById("longitude").value = position.lng();
        }
    </script>

    {{-- Clé Google Maps JS API (remplacez par la vôtre si nécessaire) --}}
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBYql3tBNe8HECpp8at7UzuoS_Xfx9VZe0&libraries=places&callback=initMap">
    </script>
</x-app-layout>
