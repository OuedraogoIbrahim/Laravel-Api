<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function addComment($home, $away, $date, $key, Request $request)
    {

        if (!Auth::check()) {
            abort('403', 'Action impossible');
        }

        $valid = $request->validate(
            [
                'message' => ['required', 'min:3', 'max:60']
            ]
        );

        $comment = new Comment();
        $comment->sender = Auth::user()->pseudo;
        $comment->message = $valid['message'];
        $comment->key_match = $key;
        $comment->save();

        return redirect()->back()->with('succes', 'Commentaire publié avec succes');
    }
}
