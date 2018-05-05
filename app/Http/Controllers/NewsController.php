<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;

class NewsController extends Controller
{
    public function all() 
    {
        $data['dark_version'] = true;
    	$data['articles'] = News::orderBy('created_at', 'DESC')->get();
        $data['hide_player'] = true;
    	return view('frontend.news.all', $data);
    }

    public function detail()
    {
        $data['dark_version'] = true;
        $data['hide_player'] = true;
    	$id = request()->id;
    	$data['article'] = News::find($id);
        if ($data['article'] == null) {
            return view('frontend.pages.404');
        }
    	$data['recent_art'] = News::orderBy('created_at', 'DESC')->limit(6)->get();
    	return view('frontend.news.detail', $data);
    }
}
