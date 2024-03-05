<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Football\RanKingConnector;
use App\Http\Integrations\Football\Requests\RankingRequest;
use App\Http\Integrations\Football\Requests\TeamRequest;
use App\Http\Integrations\Football\TeamConnector;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function team(Request $request)
    {


        if (!isset($request->team)) {
            abort('403', 'URL incomplete. Nom de l\'equipe manquant');
        }

        $team = Team::query()->where('name', $request->team)->get();
        if ($team->isEmpty()) {
            abort('403', 'Aucune information disponible pour cette equipe');
        }

        $api_key = env('API_KEY');


        $competition = $team[0]->competition;

        //Recuperation du classement
        $connector = new RanKingConnector();
        $response = $connector->send(new RankingRequest($api_key, $competition->number));
        $response = $response->json();
        $ranking = $response['result'];


        //Recuperation des joueurs blessés et non blessés
        $connector = new TeamConnector();
        $response = $connector->send(new TeamRequest($api_key, $request->team));
        $response = $response->json();
        if (!isset($response['result'])) {
            abort('403', 'Aucune équipe trouvé');
        }
        $team_infos = $response['result'][0];


        //Recuperation des joueurs blessés
        $joueurs = $team_infos['players'];
        $injured_players = [];
        $i = 0;
        foreach ($joueurs as $j) {
            if ($j['player_injured'] == 'Yes') {
                $infos['name'] = $j['player_name'];
                $infos['image'] = $j['player_image'];
                $injured_players[$i] = $infos;
                $i++;
            }
        }


        //Recuperation des joueurs blessés et non blessés
        $players = $team_infos['players'];
        $players = collect($players)->groupBy('player_type'); //Regroupement par poste

        // Trie des joueurs non blessés  de chaque type de poste par ordre croissant en fonction du numero
        $players['Goalkeepers'] = $players['Goalkeepers']->sortBy('player_number');
        $players['Defenders'] = $players['Defenders']->sortBy('player_number');
        $players['Midfielders'] = $players['Midfielders']->sortBy('player_number');
        $players['Forwards'] = $players['Forwards']->sortBy('player_number');


        return view('team.team', ['players' => $players, 'injured_players' => $injured_players, 'ranking' => $ranking, 'team_logo' => $team_infos['team_logo'], 'query' => $request->team]);
    }
}
