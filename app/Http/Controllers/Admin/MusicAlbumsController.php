<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CmsLogs;
use App\MusicAlbums;
use App\Songs;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Input;
use  Config;
use Session;

class MusicAlbumsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function create() 
    {
    	return view('backend.music_albums.create');
    }

    public function store()
    {
    	 $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
        ]);


        $album = MusicAlbums::create([
        	'title' => request()->get('title'),
        	'description' => request()->get('description'),
        	'disc_image' => 0,
        	'album_image' => 0,
        	'background_image' => 0
        ]);

        if (request()->file('disc_image') != null) {
        	 $disc_image = $this->uploadImage(request()->file('disc_image'), $album->id, 'disc');
        	 $album->disc_image = $disc_image;
        }

         if (request()->file('album_image') != null) {
        	 $album_image = $this->uploadImage(request()->file('album_image'), $album->id, 'album');
        	 $album->album_image = $album_image;
        }

         if (request()->file('background_image') != null) {
        	 $background_image = $this->uploadImage(request()->file('background_image'), $album->id, 'background');
        	 $album->background_image = $background_image;
        }

        $album->save();

        CmsLogs::create([
            'admin_id' => \Auth::user()->id,
            'action'   => "Създаде албум с име ". request()->get('title'),
        ]);

        request()->session()->flash('success_message', 'Албума беше създаден успешно!');
        return redirect()->route('music_albums.all');
    }

      public function all() 
    {
    	$data['albums'] = MusicAlbums::orderBy('created_at', 'desc')->get();
    	return view('backend.music_albums.all', $data);
    }


    public function edit()
    {
        $data['edit'] = true;
        $data['id'] = request()->id;
        $item = MusicAlbums::find($data['id']);
        $data['album'] = $item;

         if (request()->isMethod('post')) {

            $post = (object)Input::get();
            $data['item'] = $post;
            $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/music_albums/' . $item->id;

            try {

                $item->title = $post->title;
                $item->description = $post->description;


                if (request()->file('disc_image') != null) {
                    
                    if(strlen($item->disc_image) > 1)
                    {
                        @unlink($dir . '/' . $item->disc_image);
                    }

                    $disc_name = $this->uploadImage(request()->file('disc_image'), $item->id, 'disc');
                    $item->disc_image = $disc_name;
                }

                if (request()->file('album_image') != null) {
                        if(strlen($item->album_image) > 1)
                    {
                        @unlink($dir . '/' . $item->album_image);
                    }
                    $album_name = $this->uploadImage(request()->file('album_image'), $item->id, 'album');
                    $item->album_image = $album_name;
                }

                if (request()->file('background_image') != null) {
                    if(strlen($item->background_image) > 1)
                    {
                        @unlink($dir . '/' . $item->background_image);
                    }
                    $bg_name = $this->uploadImage(request()->file('background_image'), $item->id, 'background');
                    //delete pervius photo
                    $item->background_image = $bg_name;
                }

                 $item->save();

                 

              CmsLogs::create([
                    'admin_id' => \Auth::user()->id,
                    'action'   => "Промени албум с име ". request()->get('title'),
                ]);

                Session::flash('success_message', trans('backend.messages.success.created'));
                return redirect()->route('music_albums.all');

            } catch (Exception $e) {
                return view('Backend::music_albums.create')->withErrors($e->getMessage())->with($data);
            }
        }

        return view('backend.music_albums.create', $data);
    }


      protected function uploadImage($file, $product_id = "temp", $type)
     {
        $filename = $type . '_' . time() . '.' . $file->getClientOriginalExtension();

        $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/music_albums';

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $dir .= '/' . $product_id;

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $manager = new ImageManager();
        $width = 0;
        $height = 0;

        // switch ($type) {
        // 	case 'disc':
        // 		$width = 193;
        // 		$height = 184;
        // 		$manager->make($file)->resize($width, $height)->save($dir . '/' . $filename);
        // 		break;
        // 	case 'album':
        // 		$width = 203;
        // 		$height = 203;
        // 			$manager->make($file)->resize($width, $height)->save($dir . '/' . $filename);
        // 		break;
        // 	case 'background':
        // 			$manager->make($file)->save($dir . '/' . $filename);
        // 		break;
        // }

        $manager->make($file)->save($dir . '/' . $filename);
         

        return $filename;
    }

    public function deleteFile(Request $request)
    {
        $success = false;
        $errormessage = "unknown error";

        if ($request->ajax() && $request->isMethod('post')) {

                $album_id = (int)$request->get('id');
                $type = $request->get('type');

                $item = MusicAlbums::where('id', $album_id)->first();
                if (!empty($item))
                {
                    try
                    {
                        $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/music_albums/' . $item->id;
                        
                        switch ($type) {
                            case 'disk_image':
                                 @unlink($dir . '/' . $item->disc_image);
                                 $item->disc_image = 0;
                                break;
                            case 'album_image':
                                 @unlink($dir . '/' . $item->album_image);
                                 $item->album_image = 0;
                                break;
                            case 'background_image':
                                 @unlink($dir . '/' . $item->background_image);
                                 $item->background_image = 0;
                                break;
                        }
                          $item->save();

                        //Add log
                   

                        $success = true;
                    }
                    catch (Exception $e)
                    {
                        $errormessage = $e->getMessage();
                    }
                }
        }

        return json_encode(array('success' => $success, 'errormessage' => $errormessage));
    }

    public function delete()
    {
         $success = false;
        $errormessage = "unknown error";
        $request = request();

        if ($request->ajax() && $request->isMethod('post') && !empty($request->get('id'))) {
            try {

                $id = $request->get('id');
                $album = MusicAlbums::find($id);
                $songs = Songs::where('album_id', '=', $album->id)->get();
                $album_title = $album->title;
                $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/music_albums/' . $album->id;


                if (strlen($album->disc_image) > 1) 
                {
                     @unlink($dir . '/' . $album->disc_image);
                }

                if (strlen($album->album_image) > 1) 
                {
                     @unlink($dir . '/' . $album->album_image);
                }

                if (strlen($album->background_image) > 1) 
                {
                     @unlink($dir . '/' . $album->background_image);
                }

                if (count($songs) > 0) {
                    foreach ($songs as $song) {
                        $song->album_id = 0;
                        $song->save();
                    }
                }
                //change subsongs to zero album


                $album->delete();

                CmsLogs::create([
                    'admin_id' => \Auth::user()->id,
                    'action'   => "Изтри албум с име ". $album_title,
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
