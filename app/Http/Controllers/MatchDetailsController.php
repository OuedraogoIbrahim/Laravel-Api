<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Football\DirectConfrontationConnector;
use App\Http\Integrations\Football\RanKingConnector;
use App\Http\Integrations\Football\Requests\DirectConfrontationRequest;
use App\Http\Integrations\Football\Requests\RankingRequest;
use App\Http\Integrations\Football\Requests\SpecificMatchRequest;
use App\Http\Integrations\Football\SpecificMatchConnector;
use Illuminate\Http\Request;

class MatchDetailsController extends Controller
{
    public function show($home, $away, $date, int|string $key, Request $request)
    {

        if (!isset($request->home_team) || !isset($request->away_team)) {
            abort('403', 'URL incomplete');
        }

        $api_key = env('API_KEY');
        $connector = new SpecificMatchConnector();
        $response = $connector->send(new SpecificMatchRequest($api_key, $key, $date));
        $response = $response->json();
        if (!isset($response['result'])) {
            abort('403', 'Aucun match trouvé');
        }
        $match = $response['result'][0];
        // dd($match);
        $i = 0;
        $events = []; /* Variable qui va contenir les infos sur les evenements(cartons , remplacements , vars ...)*/

        /* Voici sa structure
             $events = 
             [
                [ les infos sur le 1er remplacement]
                [ les infos sur le 2eme remplacement]...

                [ les infos sur le 1er carton]
                [ les infos sur le 2eme carton].....
                
                [ les infos sur le 1er but]
                [ les infos sur le 2eme but]....

                [ les infos sur le 1ere intervention de la var]
                [ les infos sur le 2eme intervention de la var]...
                

             ]
            
            */

        if ($match['substitutes'] != []) {
            $substitutions = $match['substitutes'];
            // Ajout des remplacements dans le tableau $events
            foreach ($substitutions as $s) {
                if ($s['home_scorer'] != []) {
                    $s['type'] = 'remplacement'; // Ajout d'une cle pour identifier le type d'evenement
                    $s['home_scorer']['time'] = $s['time'];
                    $s['home_scorer']['category_team'] = 'home';
                    $s['home_scorer']['type'] = 'Remplacement';
                    $events[$i] = $s['home_scorer'];
                    $i++;
                } else {
                    $s['type'] = 'remplacement'; // Ajout d'une cle pour identifier le type d'evenement
                    $s['away_scorer']['time'] = $s['time'];
                    $s['away_scorer']['category_team'] = 'away';
                    $s['away_scorer']['type'] = 'Remplacement';
                    $events[$i] = $s['away_scorer'];
                    $i++;
                }
            }
        } else {
            $substitutions = [];
        }

        //Recuperations des buts
        if ($match['goalscorers'] != []) {
            $goals = $match['goalscorers'];
            $i = count($events);

            // Ajout des buts dans le tableau $events
            foreach ($goals as $g) {
                $g['type'] = 'But'; // Ajout d'une cle pour identifier le type d'evenement
                $events[$i] = $g;
                $i++;
            }
        } else {
            $goals = [];
        }

        //recuperation des cartons
        if ($match['cards'] != []) {
            $cards = $match['cards'];
            $i = count($events);

            // Ajout des cartons dans le tableau $events
            foreach ($cards as $c) {
                $c['type'] = 'Carton'; // Ajout d'une cle pour identifier le type d'evenement
                $events[$i] = $c;
                $i++;
            }
        } else {
            $cards = [];
        }

        //Recuperation des interventions de la var
        // if ($match['vars']['home_team'] != [] || $match['vars']['away_team'] != []) {
        //     $vars = $match['vars'];

        //     $i = count($events);
        //     $i = $i - 1;

        //     // Ajout des interventions de la var dans le tableau $events
        //     foreach ($vars as $v) {
        //         $v['type'] = 'Var'; // Ajout d'une cle pour identifier le type d'evenement
        //         $events[$i] = $v;
        //         $i++;
        //     }
        // } else {
        //     $vars = [];
        // }

        if ($events != []) {

            // trier le tableau par ordre croissant par rapport a la cle time
            usort($events, function ($a, $b) {
                return intval($a['time']) - intval($b['time']);
            });
        }

        // Recuperations des stats lorsque le match est termine
        if ($match['statistics'] != [] && $match['event_status'] == 'Finished') {
            //verification pour voir si le match est fini
            $i = 0;
            if (isset($match['statistics'][1])) {
                $statistiques[$i] = $match['statistics'][1]; //Attacks
                $i++;
            }

            if (isset($match['statistics'][2])) {
                $statistiques[$i] = $match['statistics'][2]; //Dangerous Attacks
                $i++;
            }

            if (isset($match['statistics'][17])) {
                $statistiques[$i] = $match['statistics'][17]; //Passes total
                $i++;
            }

            if (isset($match['statistics'][18])) {
                $statistiques[$i] = $match['statistics'][18]; //Passes accurate
                $i++;
            }

            if (isset($match['statistics'][14])) {
                $statistiques[$i] = $match['statistics'][14]; //Possession
                $i++;
            }

            if (isset($match['statistics'][5])) {
                $statistiques[$i] = $match['statistics'][5]; //total shots
                $i++;
            }

            if (isset($match['statistics'][3])) {
                $statistiques[$i] = $match['statistics'][3]; //On target
                $i++;
            }

            if (isset($match['statistics'][4])) {
                $statistiques[$i] = $match['statistics'][4]; //Off target

                $i++;
            }

            if (isset($match['statistics'][9])) {
                $statistiques[$i] = $match['statistics'][9]; //Inside the box
                $i++;
            }

            if (isset($match['statistics'][10])) {
                $statistiques[$i] = $match['statistics'][10]; //Outside the box
                $i++;
            }

            if (isset($match['statistics'][12])) {
                $statistiques[$i] = $match['statistics'][12]; //Corners
                $i++;
            }

            if (isset($match['statistics'][11])) {
                $statistiques[$i] = $match['statistics'][11]; //Fouls
                $i++;
            }

            if (isset($match['statistics'][15])) {
                $statistiques[$i] = $match['statistics'][15]; //yellow cards
                $i++;
            }

            if (isset($match['statistics'][0])) {
                $statistiques[$i] = $match['statistics'][0]; //susbstitutions
                $i++;
            }

            $statistiques_during_match = [];
        } elseif (($match['statistics'] != []) && $match['event_status'] != 'Finished') {
            //Recuperations des Statistiques lorsque le match est en cours
            $statistiques_during_match = $match['statistics'];
            $statistiques = [];
        } else {
            $statistiques = [];
            $statistiques_during_match = [];
        }


        // Recuperation du classement
        $connector = new RanKingConnector();
        $response = $connector->send(new RankingRequest($api_key, $match['league_key']));
        $response = $response->json();
        $ranking = $response['result'];

        // Confrontation directe entre les 2 equipes
        $connector = new DirectConfrontationConnector();
        $response = $connector->send(new DirectConfrontationRequest($api_key, $request->home_team, $request->away_team));
        $response = $response->json();
        if (isset($response['result'])) {
            $face_to_face = $response['result'];
        } else {
            $face_to_face = [];
        }

        return view('match.match', ['match_key' => $key, 'match_infos' => $match, 'events' => $events, 'statistiques' => $statistiques, 'ranking' => $ranking, 'stats_during_match' => $statistiques_during_match, 'face_to_face' => $face_to_face, 'request' => $request]);
    }
}
