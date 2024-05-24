<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Football\MatchesPlayedTodayConnector;
use App\Http\Integrations\Football\RanKingConnector;
use App\Http\Integrations\Football\Requests\MatchesPlayedTodayRequest;
use App\Http\Integrations\Football\Requests\RankingRequest;
use App\Http\Integrations\Football\Requests\TeamRequest;
use App\Http\Integrations\Football\Requests\TopScorersRequest;
use App\Http\Integrations\Football\TopScorersConnector;
use App\Models\League;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index()
    {
        $leagues_names = Cache::remember('matchs', 60 * 5, function () {
            $leagues_names = [];

            $generatorCallback = function () {
                $api_key = env('API_KEY');

                $leagues = League::with('competitions')->has('competitions')->get();

                foreach ($leagues as $league) {
                    $competitions = $league->competitions;

                    foreach ($competitions as $competition) {
                        yield  new MatchesPlayedTodayRequest($api_key, $competition->number, 1, 1);
                    }
                }
            };

            $forge =  new MatchesPlayedTodayConnector();

            $pool = $forge->pool($generatorCallback);

            $pool->withResponseHandler(function (Response $response) use (&$leagues_names) {
                $response = $response->json();
                if (isset($response['result'])) {
                    $leagues_names[] =  $response['result'];
                }
            });

            $pool->withExceptionHandler(function (FatalRequestException|RequestException $exception) {
                // echo 'Erreur' . $exception->getMessage();
            });

            $promise = $pool->send();
            $promise->wait();

            return $leagues_names;
        });

        if ($leagues_names == []) {
            return view('home.home', ['nothing' => 'Aucun match']);
        }

        if (Auth::check()) {
            $user = User::query()->with('favorites')->has('favorites')->where('id', Auth::id())->get();
            if ($user->isNotEmpty()) {
                $favorites = $user[0]->favorites;
            }
        }


        return view('home.home', ['leagues' => $leagues_names] + (isset($favorites) ? ['favorites' => $favorites] : []));
    }

    public function show($date, Request $request)
    {

        $leagues_names = Cache::remember($date, 36000, function () use ($date) {
            $leagues_names = [];

            $generatorCallback = function () use ($date) {
                $debut = $date;
                $fin = $date;
                $api_key = env('API_KEY');

                $leagues = League::with('competitions')->has('competitions')->get();

                foreach ($leagues as $league) {
                    $competitions = $league->competitions;

                    foreach ($competitions as $competition) {
                        yield  new MatchesPlayedTodayRequest($api_key, $competition->number, $debut, $fin);
                    }
                }
            };

            $forge =  new MatchesPlayedTodayConnector();

            $pool = $forge->pool($generatorCallback);

            $pool->withResponseHandler(function (Response $response) use (&$leagues_names) {
                $response = $response->json();
                if (isset($response['result'])) {
                    $leagues_names[] =  $response['result'];
                }
            });

            $pool->withExceptionHandler(function (FatalRequestException|RequestException $exception) {
                // echo 'Erreur' . $exception->getMessage();
            });

            $promise = $pool->send();
            $promise->wait();

            return $leagues_names;
        });


        if ($leagues_names == []) {
            return view('home.show', ['nothing' => 'Aucun match']);
        }

        return view('home.show', ['leagues' => $leagues_names, 'date' => $date]);
    }
}
