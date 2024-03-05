<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function login_form()
    {
        return view('login.login_form');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'pseudo' => ['required', 'min:3', 'max:16'],
            'password' => ['required', 'string', 'min:8', 'max:16'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home'))->with('status', 'Vous avez été authentifié avec succès');
        }

        return back()->withErrors([
            'pseudo' => 'Informations Eronées',
        ])->onlyInput('pseudo');
    }
}
