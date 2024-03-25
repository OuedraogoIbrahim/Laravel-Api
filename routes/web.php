<?php

use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\compositionsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LiveController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MatchDetailsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SuggestionController;
use App\Http\Controllers\TeamController;
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

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Matchs a une date precise
Route::get('/matchs/{date}', [HomeController::class, 'show'])->name('specifity.date');

//Detail d'un match
Route::get('/match/{home}-vs-{away}/{date}/{key}', [MatchDetailsController::class, 'show'])->name('match.details');

//Composition des 2 equipes
Route::get('/match/composition/{home}/{away}/{date}/{key}', [CompositionsController::class, 'composition'])->name('match.composition');

//Informations sur une equipe
Route::get('/team', [TeamController::class, 'team'])->name('team');

//Information sur une competition
Route::get('/competition', [CompetitionController::class, 'competition'])->name('competition');

// Afficher les equipes et competions potentiels lors d'une recherche
Route::get('/search/suggestions', [SuggestionController::class, 'suggestions'])->name('suggestions');
Route::get('/search/suggestions/teams', [SuggestionController::class, 'team_suggestions'])->name('team.suggestions');

// Inscription
Route::get('/register', [RegisterController::class, 'register_form'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

//Connexion
Route::get('/login', [LoginController::class, 'login_form'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

//Deconnexion

Route::get('logout', [LogoutController::class, 'logout'])->name('logout');

// Matchs en favoris
Route::get('/favorite', [FavoriteController::class, 'favorite'])->name('favorite');
Route::post('/favorite/{match_key}/{date}', [FavoriteController::class, 'add_favorite'])->name('add_favorite');
Route::delete('/favorite/{match_key}', [FavoriteController::class, 'delete_favorite'])->name('delete_favorite');


// controller utilisé pour recuperer les matchs en direct 
Route::get('live', [LiveController::class, 'index']);


// Dashboard

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');


//groups
Route::get('group/create', [GroupController::class, 'create_form'])->name('group.create');
Route::post('group/create', [GroupController::class, 'create']);

Route::get('group/{name}/{id}', [GroupController::class, 'msgGroup'])->name('msgGroup');
Route::post('group/{name}/{id}', [GroupController::class, 'write_message']);
