<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Football\AllTeamsOfCompetitionConnector;
use App\Http\Integrations\Football\RanKingConnector;
use App\Http\Integrations\Football\Requests\AllTeamsOfCompetitionRequest;
use App\Http\Integrations\Football\Requests\RankingRequest;
use App\Http\Integrations\Football\Requests\TopScorersRequest;
use App\Http\Integrations\Football\TopScorersConnector;
use App\Models\Competition;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function competition(Request $request)
    {

        if (!isset($request->competition)) {
            abort('403', 'Url incomplete. Absence du nom de la competition');
        }

        $competition = Competition::query()->where('name', $request->competition)->first();
        if (!$competition) {
            abort('403', 'Aucune correspondance trouvé');
        }

        $api_key = env('API_KEY');

        $connector = new AllTeamsOfCompetitionConnector();
        $response = $connector->send(new AllTeamsOfCompetitionRequest($api_key, $competition->number));
        $response = $response->json();
        if (!isset($response['result'])) {
            abort('403', 'Une erreur est survenue . Veuillez réessayer');
        }
        $teams_found = $response['result'];

        // Recuperation de tous les TopScorers
        $connector = new TopScorersConnector();
        $response = $connector->send(new TopScorersRequest($api_key, $competition->number));
        $response = $response->json();
        if (!isset($response['result'])) {
            abort('403', 'Une erreur est survenue . Veuillez réessayer');
        }
        $all_scorers = collect($response['result']);
        $all_scorers = $all_scorers->sortBy('player_place');

        //Recuperation des 10 topscorers buteurs si possible
        $i = 0;
        foreach ($all_scorers as $a) {
            $top_scorers[$i] = $a;
            $i++;
            if ($i == 10) {
                break;
            }
        }

        //Classement
        $connector = new RanKingConnector();
        $response = $connector->send(new RankingRequest($api_key, $competition->number));
        $response = $response->json();
        $ranking = $response['result'];

        return view('competition.competition', ['teams' => $teams_found, 'scorers' => $top_scorers, 'ranking' => $ranking]);
    }
}
