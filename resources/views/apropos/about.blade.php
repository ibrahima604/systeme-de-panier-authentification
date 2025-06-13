@php
    use Illuminate\Support\Facades\Auth;
@endphp

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À propos - {{ config('app.name') }}</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-400 text-gray-800">

    <!-- Breadcrumbs -->
    <nav class="flex mb-8 p-4" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                @if (!Auth::check())
                    <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-white hover:text-blue-600">
                        <i class="fas fa-house mr-2"></i> Accueil
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-white hover:text-blue-600">
                        <i class="fas fa-house mr-2"></i> Dashboard
                    </a>
                @endif
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-white mx-2"></i>
                    <span class="text-sm font-medium text-white">À propos</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-8">
        <!-- Section: Notre Histoire -->
        <section class="mb-12 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-4">Notre histoire</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                {{ config('app.name') }} réinvente l'expérience d'achat en ligne depuis 2015 avec une sélection premium.
            </p>
        </section>

        <!-- Section: Qui sommes-nous -->
        <section class="grid md:grid-cols-2 gap-8 mb-12">
            <div>
                <img src="https://images.unsplash.com/photo-1556740738-b6a63e27c4df?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80" 
                     alt="Notre équipe" class="rounded-lg shadow-md w-full">
            </div>
            <div class="flex flex-col justify-center">
                <h2 class="text-2xl font-bold mb-4">Qui sommes-nous ?</h2>
                <p class="text-gray-600 mb-4">
                    Fondé en 2015, {{ config('app.name') }} est né d'une vision simple : offrir une expérience d'achat en ligne exceptionnelle.
                </p>
                <p class="text-gray-600 mb-6">
                    Aujourd'hui leader dans notre secteur, nous collaborons avec des centaines de marques premium pour vous offrir le meilleur.
                </p>
                <a href="{{Auth::check()?route('dashboard'):url('/')}}" class="bg-indigo-600 text-white px-6 py-2 rounded-md hover:bg-indigo-700 transition">
                    Découvrir nos produits
                </a>
            </div>
        </section>

        <!-- Section: Nos valeurs -->
        <section class="mb-12">
            <h2 class="text-2xl font-bold mb-6 text-center">Nos valeurs</h2>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                    <div class="text-indigo-600 text-3xl mb-3">
                        <i class="fas fa-gem"></i>
                    </div>
                    <h3 class="font-bold mb-2">Qualité premium</h3>
                    <p class="text-gray-600">Sélection rigoureuse de chaque produit pour excellence et durabilité.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                    <div class="text-indigo-600 text-3xl mb-3">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="font-bold mb-2">Service client</h3>
                    <p class="text-gray-600">Équipe dédiée disponible pour vous accompagner.</p>
                </div>

                <div class="bg-white p-6 rounded-lg shadow-sm text-center">
                    <div class="text-indigo-600 text-3xl mb-3">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3 class="font-bold mb-2">Éco-responsabilité</h3>
                    <p class="text-gray-600">Emballages recyclables et logistique optimisée.</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
   <x-footer></x-footer>
</body>
</html>
