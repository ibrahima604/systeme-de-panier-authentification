<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['author' => 'D2Market']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['author' => 'D2Market']); ?>
<?php foreach (array_filter((['author' => 'D2Market']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<!-- Inclure Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<footer class="bg-gray-900 text-white w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 py-12 border-b border-amber-800">
            <!-- Company Info -->
            <div class="col-span-2">
                <div class="flex items-center space-x-2 mb-4">
                    <svg class="h-8 w-8 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-xl font-bold">D2Market</span>
                </div>
                <p class="text-gray-300 text-sm mb-4">
                    Votre marché sécurisé pour les objets rares de Diablo 2. Échangez en toute confiance avec notre système de sécurisation des transactions.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-white hover:text-amber-400">
                        <i class="bi bi-discord text-xl"></i>
                    </a>
                    <a href="#" class="text-white hover:text-amber-400">
                        <i class="bi bi-twitter text-xl"></i>
                    </a>
                    <a href="#" class="text-white hover:text-amber-400">
                        <i class="bi bi-reddit text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Acheter</h3>
                <ul class="space-y-3">
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm">Objets légendaires</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm">Runes</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm">Sets</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm">Objets uniques</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm">Objets craftés</a></li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Assistance</h3>
                <ul class="space-y-3">
                    <li><a href="<?php echo e(route('support.contact')); ?>" class="text-gray-300 hover:text-white text-sm">Contactez-nous</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm">FAQ</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm">Sécurité des échanges</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm">Guide du débutant</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-white text-sm">Rapport de bug</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Nouvelles</h3>
                <p class="text-gray-300 text-sm mb-4">
                    Restez informé des mises à jour et des événements spéciaux.
                </p>
                <form class="flex">
                    <input type="email" placeholder="Votre email" class="bg-gray-800 text-white placeholder-gray-400 px-4 py-2 text-sm rounded-l-md focus:outline-none focus:ring-1 focus:ring-amber-500 w-full">
                    <button type="submit" class="bg-amber-600 hover:bg-amber-700 text-white px-4 py-2 text-sm rounded-r-md">
                        <i class="bi bi-send-fill"></i>
                    </button>
                </form>
                <div class="mt-4 flex items-center space-x-2">
                    <i class="bi bi-shield-lock text-amber-500"></i>
                    <span class="text-xs text-gray-300">Transactions sécurisées</span>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="py-6 flex flex-col md:flex-row justify-between items-center">
            <div class="flex space-x-6 mb-4 md:mb-0">
                <a href="#" class="text-gray-300 hover:text-white text-xs">Conditions d'utilisation</a>
                <a href="#" class="text-gray-300 hover:text-white text-xs">Politique de confidentialité</a>
                <a href="#" class="text-gray-300 hover:text-white text-xs">Règles du marché</a>
            </div>
            <div class="flex items-center space-x-2">
                <span class="text-gray-300 text-sm">Modes de paiement :</span>
                <div class="flex space-x-2">
                    <i class="bi bi-currency-euro text-xl text-white"></i>
                    <i class="bi bi-currency-dollar text-xl text-white"></i>
                    <i class="bi bi-currency-bitcoin text-xl text-white"></i>
                    <span class="text-xs text-gray-300">PG</span>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="py-4 border-t border-amber-800 text-center">
            <p class="text-gray-400 text-xs">
                &copy; <?php echo e(date('Y')); ?> <?php echo e($author); ?>. D2Market n'est pas affilié à Blizzard Entertainment.
            </p>
        </div>
    </div>
</footer><?php /**PATH C:\Users\pc\Desktop\Projet\pfe\authentification\resources\views/components/footer.blade.php ENDPATH**/ ?>