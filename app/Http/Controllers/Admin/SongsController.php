<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CmsLogs;
use App\Songs;
use App\MusicAlbums;
use Illuminate\Support\Facades\Input;
use  Config;
use Session;

class SongsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function create() 
    {
    	$data['albums'] = MusicAlbums::orderBy('created_at', 'desc')->get();
    	return view('backend.music.create', $data);
    }

    public function store()
    {
    	 $this->validate(request(), [
            'title' => 'required',
        ]);


        $song = Songs::create([
        	'title' => request()->get('title'),
        	'album_id' => request()->get('album_id'),
        	'youtube_url' => request()->get('youtube_url'),
        	'lyrics' => request()->get('lyrics'),
        	'mp3' => 0,
        ]);

        if (request()->file('mp3') != null) {

            $music_file = request()->file('mp3');
            $filename = time() . '.' . $music_file->getClientOriginalExtension();

            $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/music';

            if (!is_dir($dir)) {
                mkdir($dir);
            }

            $dir .= '/' . $song->id;

            if (!is_dir($dir)) {
                mkdir($dir);
            }

            $music_file->move($dir . '/' , $filename);

        	$song->mp3 = $filename;
        }

        $song->save();

        CmsLogs::create([
            'admin_id' => \Auth::user()->id,
            'action'   => "Създаде песен с име ". request()->get('title'),
        ]);

        request()->session()->flash('success_message', 'Песента беше създадена успешно!');
        return redirect()->route('music.all');
    }

    public function all() 
    {
    	$data['songs'] = Songs::orderBy('created_at', 'desc')->get();
    	return view('backend.music.all', $data);
    }


    public function edit()
    {
        $data['edit'] = true;
        $data['id'] = request()->id;
        $item = Songs::find($data['id']);
        $data['song'] = $item;
        $data['albums'] = MusicAlbums::orderBy('created_at', 'desc')->get();

         if (request()->isMethod('post')) {

            $post = (object)Input::get();
            $data['item'] = $post;
            
            $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/music/' . $item->id;

            try {

                $item->title = $post->title;
                $item->lyrics = $post->lyrics;
                $item->youtube_url = $post->youtube_url;
                $item->album_id = $post->album_id;


                if (request()->file('mp3') != null) {
                    
                    if(strlen($item->mp3) > 1)
                    {
                        @unlink($dir . '/' . $item->mp3);
                    }

                    $music_file = request()->file('mp3');
                    $filename = time() . '.' . $music_file->getClientOriginalExtension();


                    $music_file->move($dir . '/' , $filename);

                    $item->mp3 = $filename;
                }

                 $item->save();

                 

                CmsLogs::create([
                    'admin_id' => \Auth::user()->id,
                    'action'   => "Промени песен с име ". request()->get('title'),
                ]);

                Session::flash('success_message', trans('backend.messages.success.created'));
                return redirect()->route('music.all');

            } catch (Exception $e) {
                return view('Backend::music.create')->withErrors($e->getMessage())->with($data);
            }
        }

        return view('backend.music.create', $data);
    }

     public function changeStatus() {
        $id = request()->get('id');
        $success = false;
        $errormessage = "unknown";

        try
        {
            $song = Songs::find($id);
            
            if ($song->status == 1) 
            {
               $song->status = 0;
            }
            else 
            {
               $song->status = 1;
            }
            
            Session::forget('playlist_new');
            $song->save();
            $success = true;
        }
        catch (Exception $e) {
            $errormessage = $e->getMessage();
        }

        return array('success' => $success, 'errormessage' => $errormessage);
    }

    public function delete() 
    {
         $success = false;
        $errormessage = "unknown error";
        $request = request();

        if ($request->ajax() && $request->isMethod('post') && !empty($request->get('id'))) {
            try {

                $id = $request->get('id');
                $song = Songs::find($id);
                $song_title = $song->title;
                $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/music/' . $song->id;
               

                if($song->mp3 != 0)
                {
                     @unlink($dir . '/' . $song->mp3);
                     // rmdir($dir);
                }

                $song->delete();

                CmsLogs::create([
                    'admin_id' => \Auth::user()->id,
                    'action'   => "Изтри песен с име ". $song_title,
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
