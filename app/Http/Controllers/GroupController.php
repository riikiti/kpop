<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function show($id)
    {
        $group = Group::find($id);
        return view('group',['group'=>$group]);
    }
}
