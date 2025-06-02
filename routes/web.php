<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\VarianteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Auth\CodeVerificationController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SocialiteAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'isUser'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});


Route::middleware(['auth', 'isUser'])->group(function () {
    Route::get('/checkout', [CommandeController::class, 'index'])->name('checkout.process');
    Route::get('/checkout/success', [CommandeController::class, 'success'])->name('checkout.success');
    Route::post('/valider-panier',[CommandeController::class,'store'])->name('valider.panier');
    Route::get('/commande/success', function () {
    return view('commandes.success');
})->name('commande.success');

});

Route::get('email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

Route::get('email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::get('/verify-code', [CodeVerificationController::class, 'showForm'])->name('verify.code.form');
Route::post('/verify-code', [CodeVerificationController::class, 'verify'])->name('verify.code');

Route::controller(SocialiteAuthController::class)->group(function () {
    Route::get('/auth/{provider}', 'redirect')->name('oauth.redirect');
    Route::get('/auth/{provider}/callback', 'authenticate')->name('auth.callback');
});

Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [UserController::class, 'index'])->name('utilisateurs');
    Route::delete('admin/users/{user}', [UserController::class, 'softDelete'])->name('admin.users.softDelete');
    Route::patch('admin/users/{user}/restore', [UserController::class, 'restore'])->name('admin.users.restore');
    Route::get('admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('admin/users/{user}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::patch('admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');

    Route::get('/articles', [AdminArticleController::class, 'index'])->name('admin.articles.index');
    Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('admin.articles.create');
    Route::post('/articles', [AdminArticleController::class, 'store'])->name('admin.articles.store');
    Route::get('/articles/{article}', [AdminArticleController::class, 'show'])->name('admin.articles.show');
    Route::delete('admin/articles/{article}', [AdminArticleController::class, 'softDelete'])->name('admin.articles.softDelete');
    Route::patch('admin/articles/{article}/restore', [AdminArticleController::class, 'restore'])->name('admin.articles.restore');
    Route::get('/articles/{article}/edit', [AdminArticleController::class, 'edit'])->name('admin.articles.edit');
    Route::patch('/articles/{article}', [AdminArticleController::class, 'update'])->name('admin.articles.update');

    Route::get('/admin/articles/{article}/variantes/create', [VarianteController::class, 'create'])->name('admin.articles.variantes.create');
    Route::post('/admin/articles/{article}/variantes', [VarianteController::class, 'store'])->name('admin.articles.variantes.store');
});

Route::get('/panier', [CartController::class, 'index'])->name('panier.index');
Route::get('/panier/ajouter/{id}', [CartController::class, 'ajouter'])->name('panier.ajouter');
Route::match(['get', 'post'], '/panier/ajouter/{id}', [CartController::class, 'ajouter'])->name('articles.ajouter-au-panier');
Route::patch('/panier/update/{id}', [CartController::class, 'update'])->name('panier.article.update');
Route::delete('/panier/supprimer/{id}', [CartController::class, 'supprimer'])->name('panier.supprimer');
Route::delete('/panier/vider', [CartController::class, 'vider'])->name('panier.vider');
Route::post('/panier/changer-taille', [CartController::class, 'changerTaille'])->name('panier.changerTaille');
Route::post('/panier/changer-couleur', [CartController::class, 'changerCouleur'])->name('panier.changerCouleur');

Route::get('/articles/generer-ia', [AdminArticleController::class, 'generateWithAI'])->name('articles.generate.ia');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/recherche-ajax', [ArticleController::class, 'rechercheAjax'])->name('recherche-ajax');

Route::get('/about', [UserController::class, 'about'])->name('about');

require __DIR__ . '/auth.php';
