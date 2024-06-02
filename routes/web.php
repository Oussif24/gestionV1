<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;


// Route::get('/', function () {
//     return view('welcome');
// });

// Route pour l'accueil


Route::get('/', function () {
  return view('accueil');
})->name('accueil');

Route::get('login/{role}', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register/{role}', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('register/{role}', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('check-email', [AuthController::class, 'checkEmail'])->name('check-email');

Route::middleware('auth')->group(function () {
  Route::get('admin/dashboard', function () {
      return view('admin.dashboard');
  })->name('admin.dashboard');

  Route::get('respo/dashboard', function () {
      return view('respo.dashboard');
  })->name('respo.dashboard');

  Route::get('client/dashboard', function () {
      return view('client.dashboard');
  })->name('client.dashboard');
});

Route::get('/about', function(){
  return view('about');
})->name('about');