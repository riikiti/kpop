<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function show($id)
    {
        $group = Group::find($id);
        // лучше указывать кратное 5 так как верстка красиво размещает 5 картинок 6 идет в новую строку
        return view('group', ['group' => $group, 'albums' => Album::where('group_id', $group->id)->paginate(1)]);
    }

    public function filter(Request $request)
    {
        match ($request->input('status')) {
            'Все' => $group = Group::all(),
            default => $group = Group::query()->where('status', $request->input('status'))->get()
        };
        return view('welcome', ['group' => $group, 'select' => $request->input('status')]);
    }

}
