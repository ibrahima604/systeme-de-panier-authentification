<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\Auth\VerifyEmailController;

Route::get('email/verify', function () {
    return view('auth.verify-email');
})->name('verification.notice');

Route::get('email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

use App\Http\Controllers\Auth\CodeVerificationController;

Route::get('/verify-code', [CodeVerificationController::class, 'showForm'])->name('verify.code.form');
Route::post('/verify-code', [CodeVerificationController::class, 'verify'])->name('verify.code');

Route::controller(\App\Http\Controllers\SocialiteAuthController::class)->group(function () {
    route::get('/auth/{provider}', 'redirect')->name('oauth.redirect');
    route::get('/auth/{provider}/callback', 'authenticate')->name('auth.callback');
});
Route::get('/panier', [\App\Http\Controllers\CartController::class, 'index'])->name('panier.index');
Route::middleware(['auth', 'isAdmin'])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users', [\App\Http\Controllers\UserController::class, 'index'])->name('utilisateurs');
    Route::delete('admin/users/{user}', [\App\Http\Controllers\UserController::class, 'softDelete'])->name('admin.users.softDelete');
    Route::patch('admin/users/{user}/restore', [\App\Http\Controllers\UserController::class, 'restore'])->name('admin.users.restore');
    Route::get('admin/users/{user}', [\App\Http\Controllers\UserController::class, 'show'])->name('admin.users.show');
    // Afficher le formulaire d'édition
    Route::get('admin/users/{user}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('admin.users.edit');

    // Traiter la mise à jour
    Route::patch('admin/users/{user}', [\App\Http\Controllers\UserController::class, 'update'])->name('admin.users.update');
});

require __DIR__ . '/auth.php';
