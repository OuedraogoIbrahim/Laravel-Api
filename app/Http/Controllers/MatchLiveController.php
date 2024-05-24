<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Football\LiveConnector;
use App\Http\Integrations\Football\Requests\LiveRequest;
use App\Models\League;
use Illuminate\Http\Request;
use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\Response;

class MatchLiveController extends Controller
{
    public function live()
    {


        $leagues_names = [];

        $generatorCallback = function () {

            $api_key = env('API_KEY');

            $leagues = League::with('competitions')->has('competitions')->get();

            foreach ($leagues as $league) {
                $competitions = $league->competitions;

                foreach ($competitions as $competition) {
                    yield  new LiveRequest($api_key, $competition->number);
                }
            }
        };

        $forge =  new LiveConnector();

        $pool = $forge->pool($generatorCallback);

        $pool->withResponseHandler(function (Response $response) use (&$leagues_names) {
            $response = $response->json();
            if (isset($response['result'])) {
                $leagues_names[] =  $response['result'];
            }
        });

        $pool->withExceptionHandler(function (FatalRequestException|RequestException $exception) {
        });

        $promise = $pool->send();
        $promise->wait();

        if ($leagues_names == []) {
            return view('live.live', ['message' => 'Aucun match en direct']);
        }

        return view('live.live', ['leagues' => $leagues_names] + (isset($favorites) ? ['favorites' => $favorites] : []));
    }
}
