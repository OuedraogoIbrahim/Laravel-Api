<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Football\LiveConnector;
use App\Http\Integrations\Football\Requests\LiveRequest;
use App\Models\League;
use Illuminate\Http\Request;


// Using for the asynchron request
class LiveController extends Controller
{

    public function index()
    {
        $api_key = env('API_KEY');

        $leagues = League::with('competitions')->has('competitions')->get();

        $i = 0;
        $connector = new LiveConnector();

        // $leagues = League::query()->where('name', 'Italie')->get();
        foreach ($leagues as $league) {
            $competitions = $league->competitions;

            foreach ($competitions as $competition) {
                $response = $connector->send(new LiveRequest($api_key, $competition->number));
                $response = $response->json();
                if (isset($response['result'])) {
                    $live_matches[$i] =  $response['result'];
                    $i++;
                }
            }
        }

        // return response()->json(isset($live_matches) ? $live_matches : ['erreur' => 'Aucun match trouvé']);

        return response()->json($live_matches ?? ['erreur' => 'Aucun match en direct']);
    }
}
