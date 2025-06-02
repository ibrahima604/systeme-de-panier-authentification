<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation de commande</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-xl text-center max-w-lg w-full">
        <h2 class="text-2xl font-bold text-green-600">🎉 Merci pour votre commande !</h2>
        <p class="mt-4 text-gray-700">Nous vous enverrons un e-mail de confirmation dès que votre commande sera prête.</p>
        <a href="{{ route('dashboard') }}" class="inline-block mt-6 px-6 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
            Retour à l'accueil
        </a>
    </div>
</body>
</html>
