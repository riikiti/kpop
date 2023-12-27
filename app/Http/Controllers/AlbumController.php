<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Comment;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlbumController extends Controller
{
    public function show($id)
    {
        $album = Album::find($id);
        return view('album',['album'=>$album]);
    }


    public function addComment(Request $request): View
    {
        $validatedData = $request->validate([
            'album_id' => 'required',
            'user_id' => 'required',
            'body' => 'required',
        ]);

        Comment::create([
            'album_id' => intval($validatedData['album_id']),
            'user_id' => intval($validatedData['user_id']),
            'body' => $validatedData['body'],
        ]);

        $album_one = Album::query()->where('id', $validatedData['album_id'])->first();
        Logs::create([
            'content' => 'Пользователь оставил коментарий к  ' . $album_one->title,
            'user_id' => auth()->id()
        ]);


        return view('profile.edit', ['user' => auth()->user()]);
    }
}
