<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    public function suggestions(Request $request)
    {
        $query = $request->get('query');

        $suggestions = Competition::where('name', 'like', "%$query%")->pluck('name');

        return response()->json($suggestions);
    }

    public function team_suggestions(Request $request)
    {
        $query = $request->get('query');

        $suggestions = Team::where('name', 'like', "%$query%")->pluck('name');

        return response()->json($suggestions);
    }
}
