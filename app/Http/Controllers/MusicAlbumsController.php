<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MusicAlbums;
use App\Songs;

class MusicAlbumsController extends Controller
{
    public function all() 
    {
    	$data['albums'] = MusicAlbums::orderBy('created_at', 'ASC')->get();
    	return view('frontend.albums.all', $data);
    }

    public function single()
    {
    	$id = request()->id;
    	$data['album'] = MusicAlbums::find($id);
        if ($data['album'] == null) {
            return view('frontend.pages.404');
        }
    	$data['songs'] = Songs::where('album_id', $id)->get();
    	return view('frontend.albums.single', $data);
    }
}
