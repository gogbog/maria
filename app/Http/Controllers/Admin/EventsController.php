<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CmsLogs;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Input;
use  Config;
use Session;
use App\Events;

class EventsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }

    public function create() 
    {
    	return view('backend.events.create');
    }

    public function store()
    {
    	 $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'place' => 'required',
            'hour' => 'required',
            'date' => 'required',
        ]);


        $event = Events::create([
        	'title' => request()->get('title'),
        	'description' => request()->get('description'),
        	'price' => request()->get('price'),
        	'place' => request()->get('place'),
        	'hour' => request()->get('hour'),
        	'date' => request()->get('date'),
        ]);


        CmsLogs::create([
            'admin_id' => \Auth::user()->id,
            'action'   => "Създаде събитие с име ". request()->get('title'),
        ]);

        request()->session()->flash('success_message', 'Статията беше създадена успешно!');
        return redirect()->route('events.all');
    }

    public function all() 
    {
    	$data['events'] = Events::orderBy('created_at', 'desc')->get();
    	return view('backend.events.all', $data);
    }

    public function edit()
    {
    	$data['edit'] = true;
        $data['id'] = request()->id;
        $item = Events::find($data['id']);
        $data['event'] = $item;

         if (request()->isMethod('post')) {

            $post = (object)Input::get();
            $data['item'] = $post;

            try {

                $item->title = $post->title;
                $item->description = $post->description;
                $item->price = $post->price;
                $item->place = $post->place;
                $item->date = $post->date;
                $item->hour = $post->hour;

                $item->save();

                 

              CmsLogs::create([
                    'admin_id' => \Auth::user()->id,
                    'action'   => "Промени статия с име ". request()->get('title'),
               ]);

                Session::flash('success_message', trans('backend.messages.success.created'));
                return redirect()->route('events.all');

            } catch (Exception $e) {
                return view('Backend::events.create')->withErrors($e->getMessage())->with($data);
            }
        }

        return view('backend.events.create', $data);
    }

        public function delete() {

        $success = false;
        $errormessage = "unknown error";
        $request = request();

        if ($request->ajax() && $request->isMethod('post') && !empty($request->get('id'))) {
            try {

                $id = $request->get('id');
                $event = Events::find($id);
                $event_title = $event->title;


                $event->delete();

                CmsLogs::create([
                    'admin_id' => \Auth::user()->id,
                    'action'   => "Изтри събитие с име ". $event_title,
                ]);

                $success = true;
            } catch (Exception $e) {
                $errormessage = $e->getMessage();
            }
        }
        else
        {
             $errormessage = trans('Не съществува');
        }

        return array('success' => $success, 'errormessage' => $errormessage);

    }

}
