<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Football\PlayersConnector;
use App\Http\Integrations\Football\Requests\PlayersRequest;
use App\Http\Integrations\Football\Requests\SpecificMatchRequest;
use App\Http\Integrations\Football\SpecificMatchConnector;
use Illuminate\Http\Request;

class CompositionsController extends Controller
{
    public function composition($home = 1, $away = 1, $date, $key)
    {


        $api_key = env('API_KEY');
        $connector = new SpecificMatchConnector();
        $response = $connector->send(new SpecificMatchRequest($api_key, $key, $date));
        $response = $response->json();
        if (!isset($response['result'])) {
            abort('403', 'Aucun match trouvé');
        }
        $match = $response['result'][0];
        // Recuperation de la composition
        if ($match['lineups']['home_team']['starting_lineups'] != [] && $match['lineups']['away_team']['starting_lineups'] != []) {
            $compositions = $match['lineups'];

            //Trie par ordre croissant des joueurs de l'equipe a domicile
            usort($compositions['home_team']['starting_lineups'], function ($c, $d) {
                return $c['player_number'] - $d['player_number'];
            });

            //Trie par ordre croissant des joueurs de l'equipe a l'exterieur
            usort($compositions['away_team']['starting_lineups'], function ($c, $d) {
                return $c['player_number'] - $d['player_number'];
            });

            //Recuperations de la photo de chaque joueur
            $i = 0;
            $j = 0; // variable qui permet d'inserer l'image bon joueur
            $home_players = $compositions['home_team']['starting_lineups'];
            $away_players = $compositions['away_team']['starting_lineups'];

            foreach ($home_players as $home_player) {
                $connector = new PlayersConnector();
                $response = $connector->send(new PlayersRequest($api_key, $home_player['player_key']));
                $response = $response->json();
                $compositions['home_team']['starting_lineups'][$i]['player_image'] = $response['result'][0]['player_image']; // insertion de l'image du joueur
                $i++;
            }

            foreach ($away_players as $away_player) {
                $connector = new PlayersConnector();
                $response = $connector->send(new PlayersRequest($api_key, $away_player['player_key']));
                $response = $response->json();
                $compositions['away_team']['starting_lineups'][$j]['player_image'] = $response['result'][0]['player_image']; // insertion de l'image du joueur
                $j++;
            }
        } else {
            abort('403', 'Les compositions ne sont pas disponibles');
        }

        return view('composition.composition', ['match_infos' => $match, 'compositions' => $compositions]);
    }
}
