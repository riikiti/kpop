<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\AlbumUser;
use App\Models\Logs;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlbumUserController extends Controller
{
    public function store(Request $request): View
    {
        $validatedData = $request->validate([
            'album_id' => 'required',
        ]);
// Проверить существование комбинации user_id и course_id
        $exists = AlbumUser::where('user_id', auth()->id())
            ->where('album_id', $validatedData['album_id'])
            ->exists();
        if (!$exists) {
            AlbumUser::create([
                'user_id' => auth()->id(),
                'album_id' => $validatedData['album_id'],
            ]);
            $album = Album::query()->where('id', $validatedData['album_id'])->first();
            Logs::create([
                'content' => 'Пользователь оставил запрос на покупку альбома '. $album->name,
                'user_id' => auth()->id()
            ]);
        } else {
            return view('profile.edit', ['user' => auth()->user()]);
        }
        return view('profile.edit', ['user' => auth()->user()]);
    }
}
