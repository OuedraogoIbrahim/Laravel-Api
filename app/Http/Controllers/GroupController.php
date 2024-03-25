<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Group_User;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class GroupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create_form(): View
    {
        return view('group.create');
    }

    public function create(Request $request)
    {

        $valid = $request->validate([
            'name' => ['required', 'unique:groups,name', 'between:2,26'],
            'description' => ['required', 'between:10,248',],
            'select' => ['required', 'in:1,2'],
        ]);

        $group = new Group();
        $group->name = $valid['name'];
        $group->description = $valid['description'];
        $group->admin = Auth::user()->pseudo;

        if ($valid['select'] == '1') {

            $group->authorisation = 'true';
            $group->save();

            $user = User::query()->with('groups')->find(Auth::id());
            $user->groups()->sync($group->id);

            return redirect()->route('dashboard');
        } else {

            $group->authorisation = 'false';
            $group->save();

            $user = User::query()->with('groups')->find(Auth::id());
            $user->groups()->sync($group->id);

            return redirect()->route('dashboard');
        }
    }

    public function msgGroup($name, $id)
    {
        $name = str_replace('-', ' ', $name);
        //Verification si le user fait partie du groupe
        $groupExist = Group::query()->with('users')->findOrFail($id);
        if (!$groupExist->users()->where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        $group = Group::query()->with('messages')->where(['name' => $name, 'id' => $id])->get();
        if ($group->isEmpty()) {
            abort(403, 'Groupe indisponible');
        }

        $messages = $group[0]->messages;

        return view('groupe-messages.messages', ['messages' => $messages]);
    }

    public function write_message($name, $id, Request $request)
    {

        $name = str_replace('-', ' ', $name);
        //Verification si le user fait partie du groupe
        $groupExist = Group::query()->with('users')->findOrFail($id);
        if (!$groupExist->users()->where('user_id', Auth::id())->exists()) {
            abort(403);
        }

        $group = Group::query()->with('messages')->where(['name' => $name, 'id' => $id])->get();
        if ($group->isEmpty()) {
            abort(403, 'Groupe indisponible');
        }

        $valid = $request->validate([
            'message' => ['required', 'string', 'max:200']
        ]);


        $msg = new Message();
        $msg->message = $valid['message'];
        $msg->write_by = Auth::user()->pseudo;
        $msg->group_id = $id;
        $msg->save();

        return redirect()->back();
    }
}
