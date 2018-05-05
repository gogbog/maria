<?php

namespace App\Http\Controllers;
use App\MusicAlbums;
use Session;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function welcome()
    {
    	$data['music_albums'] = MusicAlbums::orderBy('created_at', 'ASC')->limit(4)->get();
    	// $data['hide_player'] = true;
    	return view('frontend.pages.index', $data);
    }
}
