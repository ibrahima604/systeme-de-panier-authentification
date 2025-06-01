<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notre Histoire | NomEntreprise</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .team-card:hover .team-img {
            transform: scale(1.05);
        }
        .testimonial-card {
            box-shadow: 0 10px 30px -10px rgba(0, 0, 0, 0.1);
        }
        .star-rating {
            color: #fbbf24;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800">

<!-- Navigation (à inclure depuis un layout) -->
<nav class="bg-white shadow-lg">
    <div class="container mx-auto px-6 py-3">
        <div class="flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-indigo-600">NomEntreprise</a>
            <div class="hidden md:flex space-x-8">
                <a href="/" class="hover:text-indigo-600">Accueil</a>
                <a href="/boutique" class="hover:text-indigo-600">Boutique</a>
                <a href="/apropos" class="text-indigo-600 font-medium">À propos</a>
                <a href="/contact" class="hover:text-indigo-600">Contact</a>
            </div>
            <div class="flex items-center space-x-4">
                <a href="#" class="hover:text-indigo-600"><i class="fas fa-shopping-cart"></i></a>
                <a href="#" class="hover:text-indigo-600"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section améliorée -->
<section class="gradient-bg text-white py-24">
    <div class="container mx-auto px-6 text-center">
        <h1 class="text-5xl md:text-6xl font-bold mb-6">Notre histoire</h1>
        <p class="text-xl md:text-2xl max-w-3xl mx-auto mb-8 opacity-90">
            Depuis 2010, nous révolutionnons l'expérience d'achat en ligne avec des produits d'exception et un service client hors pair.
        </p>
        <div class="flex justify-center space-x-4">
            <a href="/boutique" class="bg-white text-indigo-700 hover:bg-gray-100 font-semibold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                Découvrir nos produits
            </a>
            <a href="#contact" class="border-2 border-white text-white hover:bg-white hover:text-indigo-700 font-semibold py-3 px-8 rounded-full transition duration-300 transform hover:scale-105">
                Nous contacter
            </a>
        </div>
    </div>
</section>

<!-- Valeurs de l'entreprise -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Nos valeurs fondamentales</h2>
            <div class="w-24 h-1 bg-indigo-600 mx-auto mb-6"></div>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Ces principes guident chacune de nos décisions et interactions avec nos clients.
            </p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-12">
            <div class="bg-gray-50 p-8 rounded-xl hover:shadow-xl transition duration-300">
                <div class="bg-indigo-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-lightbulb text-indigo-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-center mb-4">Innovation constante</h3>
                <p class="text-gray-600 text-center">
                    Nous repoussons les limites pour vous offrir des produits avant-gardistes qui répondent à vos besoins futurs.
                </p>
            </div>
            
            <div class="bg-gray-50 p-8 rounded-xl hover:shadow-xl transition duration-300">
                <div class="bg-indigo-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-heart text-indigo-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-center mb-4">Passion client</h3>
                <p class="text-gray-600 text-center">
                    Votre satisfaction est notre priorité absolue. Chaque interaction compte et nous nous engageons à vous surprendre.
                </p>
            </div>
            
            <div class="bg-gray-50 p-8 rounded-xl hover:shadow-xl transition duration-300">
                <div class="bg-indigo-100 w-16 h-16 mx-auto rounded-full flex items-center justify-center mb-6">
                    <i class="fas fa-leaf text-indigo-600 text-2xl"></i>
                </div>
                <h3 class="text-2xl font-semibold text-center mb-4">Responsabilité écologique</h3>
                <p class="text-gray-600 text-center">
                    Nous nous engageons pour un commerce plus vert avec des emballages recyclables et une logistique optimisée.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Timeline de l'entreprise -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Notre parcours</h2>
            <div class="w-24 h-1 bg-indigo-600 mx-auto mb-6"></div>
        </div>
        
        <div class="relative">
            <!-- Ligne centrale -->
            <div class="hidden md:block absolute left-1/2 top-0 bottom-0 w-1 bg-indigo-200 transform -translate-x-1/2"></div>
            
            <!-- Événement 1 -->
            <div class="relative mb-12 md:flex items-center">
                <div class="md:w-1/2 md:pr-12 mb-6 md:mb-0 text-right">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-2xl font-bold text-indigo-600 mb-2">2010</h3>
                        <h4 class="text-xl font-semibold mb-2">Fondation de l'entreprise</h4>
                        <p class="text-gray-600">Création avec une petite équipe passionnée et une vision claire : révolutionner le e-commerce.</p>
                    </div>
                </div>
                <div class="hidden md:block md:w-1/2"></div>
                <div class="absolute left-1/2 transform -translate-x-1/2 md:translate-x-0 md:left-auto md:right-1/2 md:mr-6 bg-indigo-600 rounded-full w-6 h-6 top-8"></div>
            </div>
            
            <!-- Événement 2 -->
            <div class="relative mb-12 md:flex items-center">
                <div class="hidden md:block md:w-1/2 md:pr-12"></div>
                <div class="md:w-1/2 md:pl-12">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <h3 class="text-2xl font-bold text-indigo-600 mb-2">2014</h3>
                        <h4 class="text-xl font-semibold mb-2">Premier million de clients</h4>
                        <p class="text-gray-600">Atteinte d'un jalon important grâce à la qualité de nos produits et à notre service client exceptionnel.</p>
                    </div>
                </div>
                <div class="absolute left-1/2 transform -translate-x-1/2 md:translate-x-0 md:left-1/2 md:ml-6 bg-indigo-600 rounded-full w-6 h-6 top-8"></div>
            </div>
            
            <!-- Ajoutez d'autres événements ici -->
        </div>
    </div>
</section>

<!-- Section Équipe dynamique -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Rencontrez notre équipe</h2>
            <div class="w-24 h-1 bg-indigo-600 mx-auto mb-6"></div>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Une équipe passionnée et experte dédiée à votre satisfaction.
            </p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            @foreach($teamMembers as $member)
            <div class="team-card bg-white rounded-xl overflow-hidden shadow-lg transition duration-300 hover:shadow-xl">
                <div class="overflow-hidden">
                    <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="team-img w-full h-80 object-cover transition duration-500">
                </div>
                <div class="p-6 text-center">
                    <h3 class="text-2xl font-bold mb-1">{{ $member['name'] }}</h3>
                    <p class="text-indigo-600 font-medium mb-4">{{ $member['position'] }}</p>
                    <p class="text-gray-600 mb-4">{{ $member['bio'] }}</p>
                    <div class="flex justify-center space-x-4">
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition duration-300">
                            <i class="fab fa-linkedin-in text-lg"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition duration-300">
                            <i class="fab fa-twitter text-lg"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-indigo-600 transition duration-300">
                            <i class="fas fa-envelope text-lg"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Témoignages clients -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-4">Ce que disent nos clients</h2>
            <div class="w-24 h-1 bg-indigo-600 mx-auto mb-6"></div>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Des milliers de clients satisfaits à travers le monde.
            </p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
            <div class="testimonial-card bg-white p-8 rounded-xl">
                <div class="flex items-center mb-6">
                    <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['name'] }}" class="w-16 h-16 rounded-full object-cover mr-4">
                    <div>
                        <h4 class="font-bold text-lg">{{ $testimonial['name'] }}</h4>
                        <p class="text-gray-600 text-sm">{{ $testimonial['position'] }}</p>
                    </div>
                </div>
                <p class="text-gray-700 mb-4 italic">"{{ $testimonial['comment'] }}"</p>
                <div class="star-rating">
                    @for($i = 0; $i < $testimonial['rating']; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Statistiques impressionnantes -->
<section class="py-20 gradient-bg text-white">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="p-6 transform hover:scale-105 transition duration-300">
                <div class="text-5xl font-bold mb-2">10+</div>
                <div class="text-xl font-medium">Années d'expertise</div>
                <div class="w-16 h-1 bg-white mx-auto mt-4 opacity-50"></div>
            </div>
            <div class="p-6 transform hover:scale-105 transition duration-300">
                <div class="text-5xl font-bold mb-2">500K+</div>
                <div class="text-xl font-medium">Clients satisfaits</div>
                <div class="w-16 h-1 bg-white mx-auto mt-4 opacity-50"></div>
            </div>
            <div class="p-6 transform hover:scale-105 transition duration-300">
                <div class="text-5xl font-bold mb-2">50+</div>
                <div class="text-xl font-medium">Pays desservis</div>
                <div class="w-16 h-1 bg-white mx-auto mt-4 opacity-50"></div>
            </div>
            <div class="p-6 transform hover:scale-105 transition duration-300">
                <div class="text-5xl font-bold mb-2">200+</div>
                <div class="text-xl font-medium">Experts dévoués</div>
                <div class="w-16 h-1 bg-white mx-auto mt-4 opacity-50"></div>
            </div>
        </div>
    </div>
</section>

<!-- CTA final -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Prêt à vivre l'expérience NomEntreprise ?</h2>
        <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-8">
            Découvrez nos produits phares et rejoignez notre communauté de clients satisfaits.
        </p>
        <a href="/boutique" class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-4 px-12 rounded-full transition duration-300 transform hover:scale-105 shadow-lg">
            Voir la collection
        </a>
    </div>
</section>

<!-- Footer (à inclure depuis un layout) -->
<footer class="bg-gray-900 text-white py-12">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">NomEntreprise</h3>
                <p class="text-gray-400">Le leader du e-commerce depuis 2010, offrant des produits de qualité supérieure avec un service client exceptionnel.</p>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Liens utiles</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Mon compte</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Suivi de commande</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">FAQ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Mentions légales</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Service client</h4>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Contactez-nous</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Retours & échanges</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Livraison</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Paiement sécurisé</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-semibold mb-4">Newsletter</h4>
                <p class="text-gray-400 mb-4">Abonnez-vous pour recevoir nos offres exclusives.</p>
                <form class="flex">
                    <input type="email" placeholder="Votre email" class="px-4 py-2 w-full rounded-l focus:outline-none text-gray-800">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-r">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
        <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
            <p>&copy; 2023 NomEntreprise. Tous droits réservés.</p>
        </div>
    </div>
</footer>

</body>
</html>