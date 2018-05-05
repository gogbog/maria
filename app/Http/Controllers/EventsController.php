<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events;

class EventsController extends Controller
{
    public function all() 
    {
    	$data['events'] = Events::orderBy('created_at', 'DESC')->get();
        $data['hide_player'] = true;
    	return view('frontend.events.all', $data);
    }

    public function detail()
    {
    	$id = request()->id;
    	$data['event'] = Events::find($id);
        $data['dark_version'] = true;
        $data['hide_player'] = true;

    	$date = date_create($data['event']->date);
		$data['date'] = date_format($date, 'm-d-Y');
		
    	return view('frontend.events.detail', $data);
    }
}
