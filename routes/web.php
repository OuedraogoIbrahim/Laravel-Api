<?php

use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\compositionsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MatchDetailsController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/matchs/{date}', [HomeController::class, 'show'])->name('specifity.date');
Route::get('/match/{home}-vs-{away}/{date}/{key}', [MatchDetailsController::class, 'show'])->name('match.details');
Route::get('/match/composition/{home}/{away}/{date}/{key}', [CompositionsController::class, 'composition'])->name('match.composition');

Route::get('/team', [TeamController::class, 'team'])->name('team');
Route::get('/competition', [CompetitionController::class, 'competition'])->name('competition');

Route::get('/search/suggestions', [SuggestionController::class, 'suggestions'])->name('suggestions');
Route::get('/search/suggestions/teams', [SuggestionController::class, 'team_suggestions'])->name('team.suggestions');
