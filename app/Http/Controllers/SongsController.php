<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MusicAlbums;
use App\Songs;

class SongsController extends Controller
{
    public function single()
    {
    	$id = request()->id;
    	$data['song'] = Songs::find($id);

    	if ($data['song'] == null) {
            return view('frontend.pages.404');
        }
    	$data['hide_player'] = true;

        if ($data['song']->mp3 == 0) {
            $data['dark_version'] = true;
        }

    	$data['albums'] = MusicAlbums::orderBy('created_at', 'DESC')->limit(5)->get();
    	$data['songs'] = Songs::orderBy('created_at', 'DESC')->limit(5)->get();
    	return view('frontend.songs.single', $data);
    }
}
