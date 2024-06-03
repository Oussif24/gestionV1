<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Page d'accueil
Route::get('/', function () {
    return view('accueil');
})->name('accueil');

// Authentification et gestion des rôles
// Afficher le formulaire de connexion, gestion optionnelle des rôles
Route::get('login/{role?}', [AuthController::class, 'showLoginForm'])
    ->name('login')
    ->where('role', 'admin|respo|client'); // Contrainte sur le rôle

// Traitement de la connexion
Route::post('login', [AuthController::class, 'login']);

// Afficher le formulaire d'inscription
Route::get('register/{role}', [AuthController::class, 'showRegisterForm'])->name('register');

// Traitement de l'inscription
Route::post('register/{role}', [AuthController::class, 'register']);

// Déconnexion
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Vérification d'email utilisée dans les formulaires AJAX pour vérifier la disponibilité des emails
Route::get('check-email', [AuthController::class, 'checkEmail'])->name('check-email');

// Routes pour les tableaux de bord spécifiques aux rôles, sécurisées par le middleware 'auth'
Route::middleware(['auth'])->group(function () {
    Route::get('admin/users/manage-users', function () {
        return view('admin.users.manage-users');
    })->name('admin.users.manage-users');

    Route::get('respo/dashboard', function () {
        return view('respo.dashboard');
    })->name('respo.dashboard');

    Route::get('client/dashboard', function () {
        return view('client.dashboard');
    })->name('client.dashboard');
});

// Page À propos
Route::get('/about', function () {
    return view('about');
})->name('about');
