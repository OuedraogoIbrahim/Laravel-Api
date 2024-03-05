<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Football\MatchesPlayedTodayConnector;
use App\Http\Integrations\Football\Requests\MatchesPlayedTodayRequest;
use App\Models\League;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        $api_key = env('API_KEY');

        $debut = 1;
        $fin = 1;
        $i = 0;
        $leagues_names = [];
        $leagues = League::with('competitions')->has('competitions')->get();

        $connector = new MatchesPlayedTodayConnector();

        // $leagues = League::query()->where('name', 'Italie')->get();
        foreach ($leagues as $league) {
            $competitions = $league->competitions;

            foreach ($competitions as $competition) {
                $response = $connector->send(new MatchesPlayedTodayRequest($api_key, $competition->number, 1, 1));
                $response = $response->json();
                if (isset($response['result'])) {
                    $leagues_names[$i] =  $response['result'];
                    $i++;
                }
            }
        }

        if ($leagues_names == []) {
            return abort('403', 'Aucun Match pour ce jour');
        }

        if (Auth::check()) {
            $user = User::query()->with('favorites')->has('favorites')->where('id', Auth::id())->get();
            $favorites = $user[0]->favorites;
        }

        return view('home.home', ['leagues' => $leagues_names] + (isset($favorites) ? ['favorites' => $favorites] : []));
    }

    public function show($date, Request $request)
    {

        $api_key = env('API_KEY');

        $debut = $date;
        $fin = $date;
        $i = 0;
        $leagues_names = [];
        $leagues = League::with('competitions')->has('competitions')->get();

        $connector = new MatchesPlayedTodayConnector();

        // $leagues = League::query()->where('name', 'Italie')->get();
        foreach ($leagues as $league) {
            $competitons = $league->competitions;

            foreach ($competitons as $competiton) {
                $response = $connector->send(new MatchesPlayedTodayRequest($api_key, $competiton->number, $debut, $fin));
                $response = $response->json();
                if (isset($response['result'])) {
                    $leagues_names[$i] =  $response['result'];
                    $i++;
                }
            }
        }

        if ($leagues_names == []) {
            return abort('403', 'Aucun Match pour ce jour');
        }

        return view('home.show', ['leagues' => $leagues_names, 'date' => $debut]);
    }
}
