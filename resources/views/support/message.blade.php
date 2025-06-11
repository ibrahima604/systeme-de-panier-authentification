<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Répondre à un message</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white w-full max-w-3xl rounded-lg shadow-lg p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            📬 Répondre à l'utilisateur
        </h1>

        {{-- Informations sur le message initial --}}
        <div class="mb-8 bg-gray-50 border border-gray-200 rounded p-5">
            <h2 class="text-lg font-semibold text-gray-700 mb-3">📨 Message reçu</h2>
            <p><strong>👤 Nom :</strong> {{ $nom }}</p>
            <p><strong>✉️ Email :</strong> {{ $email }}</p>
            <div class="mt-4">
                <p class="font-medium text-gray-700 mb-1">💬 Contenu :</p>
                <div class="bg-white border border-gray-200 p-4 rounded text-gray-800 whitespace-pre-line">
                    {{ $messageContent }}
                </div>
            </div>
        </div>

        {{-- Messages flash --}}
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulaire de réponse --}}
        <form action="{{ route('admin.repondre-message') }}" method="POST" class="space-y-5">
            @csrf
    
            <input type="hidden" name="email" value="{{ $email }}">

            <div>
                <label for="objet" class="block text-sm font-medium text-gray-700">Objet de la réponse</label>
                <input type="text" id="objet" name="objet" placeholder="Objet du mail" 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="message" class="block text-sm font-medium text-gray-700">Message de réponse</label>
                <textarea name="message" id="message" rows="6" placeholder="Votre réponse..." 
                    class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-3 focus:ring-blue-500 focus:border-blue-500 resize-none" required></textarea>
            </div>

            <button type="submit" 
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-md transition duration-200">
                ✅ Envoyer la réponse
            </button>
        </form>

        <div class="text-center text-sm text-gray-400 mt-6">
            © {{ date('Y') }} MonEcommerce — Tous droits réservés.
        </div>
    </div>
</body>
</html>
