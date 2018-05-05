<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PhotoAlbums;
use App\Pictures;

class GalleryController extends Controller
{
     public function albums() 
    {
        $data['dark_version'] = true;
    	$data['albums'] = PhotoAlbums::orderBy('created_at', 'DESC')->get();
        $data['hide_player'] = true;
    	return view('frontend.gallery.albums', $data);
    }

    public function single()
    {
    	$id = request()->id;
    	$data['album'] = PhotoAlbums::find($id);
        $data['hide_player'] = true;
        if ($data['album'] == null) {
            return view('frontend.pages.404');
        }
    	$data['photos'] = Pictures::where('album_id', $data['album']->id)->get();
    	return view('frontend.gallery.single', $data);
    }
}
