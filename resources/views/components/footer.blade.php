@props(['author' => 'MonEntreprise'])

<!-- Inclure Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<footer class="bg-gray-900 text-white py-8 w-full rounded-md">
    <div class="w-full px-6 md:px-12 grid grid-cols-1 md:grid-cols-3 gap-8">
        <div>
            <h5 class="text-lg font-bold mb-4">À propos</h5>
            <p class="text-sm text-gray-300">
                Nous sommes une plateforme dédiée à simplifier vos achats en ligne.
            </p>
        </div>
        <div>
            <h5 class="text-lg font-bold mb-4">Liens utiles</h5>
            <ul class="space-y-2">
                <li><a href="#" class="hover:text-blue-400">Accueil</a></li>
                <li><a href="#" class="hover:text-blue-400">Services</a></li>
                <li><a href="#" class="hover:text-blue-400">Contact</a></li>
            </ul>
        </div>
        <div>
            <h5 class="text-lg font-bold mb-4">Suivez-nous</h5>
            <ul class="space-y-2">
                <li>
                    <a href="#" class="flex items-center space-x-2 hover:text-blue-500">
                        <i class="bi bi-facebook"></i><span>Facebook</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center space-x-2 hover:text-blue-400">
                        <i class="bi bi-twitter"></i><span>Twitter</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center space-x-2 hover:text-blue-600">
                        <i class="bi bi-linkedin"></i><span>LinkedIn</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center space-x-2 hover:text-green-500">
                        <i class="bi bi-whatsapp"></i><span>WhatsApp</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="text-center mt-8 text-gray-500 text-sm">
        &copy; {{ date('Y') }} {{ $author }}. Tous droits réservés.
    </div>
</footer>
