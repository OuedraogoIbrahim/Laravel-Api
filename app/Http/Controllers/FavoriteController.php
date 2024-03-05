<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Integrations\Football\Requests\SpecificMatchRequest;
use App\Http\Integrations\Football\SpecificMatchConnector;
use App\Models\Favorite;
use App\Models\Favorite_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function favorite()
    {
        $favorites = Auth::user()->favorites()->orderBy('id', 'Desc')->get();

        /* ****************Autre methode*************/
        // $id_auth = Auth::id();
        // $user = User::query()->where('id', $id_auth)->with('favorites')->get();
        // $favorites = $user[0]->favorites()->orderBy('id', 'desc')->get();

        if ($favorites->isEmpty()) {
            return view('favorite.favorite', ['no_success' => 'Aucun favori trouvé']);
        } else {
            $api_key = env('API_KEY');
            $i = 0;
            $connector = new SpecificMatchConnector();
            foreach ($favorites as $f) {
                $response = $connector->send(new SpecificMatchRequest($api_key, $f->match_key, $f->match_date));
                $response = $response->json();
                if (isset($response['result'])) {
                    $match[$i] = $response['result'][0];
                    $i++;
                }
            }

            return isset($match) ? view('favorite.favorite', ['match' => $match]) : die('Aucun favori');
        }
    }

    public function add_favorite($match_key, $date)
    {

        $all_favorites = Favorite::all();
        // Verification pour savoir si le match est deja dans la BDD
        foreach ($all_favorites as $f) {
            if ($f->match_key == $match_key) {
                $i = 1;
                $chosen_favorite = $f;
            }
        }

        if (!isset($i)) {
            $favorite = new Favorite();
            $favorite->match_key = $match_key;
            $favorite->match_date = $date;
            $favorite->save();

            $favorite->users()->attach(Auth::id());
            return response()->json(['succes' => 'operation reussi']);
        } else {

            /* On verifie si dans la table Favorite_user il existe une entrée avec le favori choisi par l'utilisateur ainsi que l'id de l'utilisateur */

            $verify = Favorite_User::query()->where('favorite_id', $chosen_favorite->id)->where('user_id', Auth::id())->get();
            if ($verify->isEmpty()) {
                $chosen_favorite->users()->attach(Auth::id());
                return response()->json(['succes' => 'operation reussi']);
            } else {
                return response()->json(['echec' => 'operation echoue']);
            }
        }
    }

    public function delete_favorite($match_key)
    {
        $favorite_delete = Favorite::query()->where('match_key', $match_key)->get();
        if ($favorite_delete->isEmpty()) {
            return response()->json(['erreur' => 'Une erreur est survenue']);
        } else {
            $favorite_delete = $favorite_delete[0];
            $favorite_delete->delete();
            return response()->json(['succes' => 'Suppression reussi']);
        }
    }
}
