<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function register_form()
    {
        return view('register.register_form');
    }

    public function register(Request $request)
    {
        $data = $request->validate(
            [
                'pseudo' => ['required', 'min:3', 'max:16'],
                'password' => ['required', 'string', 'min:8', 'max:16', 'confirmed'],
            ]
        );

        $user = new User();
        $user->pseudo = $data['pseudo'];
        $user->password = Hash::make($data['password']);
        $user->save();
        Auth::login($user);
        return redirect('/')->with('status', 'Compte créé avec succes');
    }
}
