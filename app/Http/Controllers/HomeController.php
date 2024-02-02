<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Football\MatchesPlayedTodayConnector;
use App\Http\Integrations\Football\Requests\MatchesPlayedTodayRequest;
use App\Models\League;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class HomeController extends Controller
{
    public function index()
    {

        $api_key = 'b9c9431bb75650273c8c04b429b2c64eae4f6f1098105bb577c5c44a5e25400e';

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

        return view('home.home', ['leagues' => $leagues_names]);
    }

    public function show($date, Request $request)
    {

        $api_key = '3978dd186dc788e39e07860b92ec988e239b45ff45f8883ebedfd78c0734884b';

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

        // return view('home.show');
        return view('home.show', ['leagues' => $leagues_names, 'date' => $debut]);
    }
}
