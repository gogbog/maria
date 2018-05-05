<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PhotoAlbums;
use App\Pictures;
use App\CmsLogs;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Input;
use  Config;
use Session;

class PhotoAlbumsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function create() 
    {
    	return view('backend.photo_albums.create');
    }

    public function store()
    {
    	 $this->validate(request(), [
            'title' => 'required',
        ]);


        $album = PhotoAlbums::create([
        	'title' => request()->get('title'),
        	'photo' => 0,
            'background' => 0,
        ]);


        $photos = Pictures::where('token', request()->get('unique_token'))->get();

        if (count($photos) > 0) {
        	foreach ($photos as $photo) {
        		$photo->album_id = $album->id;
        		$photo->save();
        	}
        }

        if (request()->file('img') != null) {
        	 $filename = $this->uploadImage(request()->file('img'), $album->id);
        	 $album->photo = $filename;
        	 $album->save();
        }

        if (request()->file('background') != null) {
             $filename = $this->uploadBackground(request()->file('background'), $album->id);
             $album->background = $filename;
             $album->save();
        }

        CmsLogs::create([
            'admin_id' => \Auth::user()->id,
            'action'   => "Създаде албум за снимки с име ". request()->get('title'),
        ]);

        request()->session()->flash('success_message', 'Албума беше създаден успешно!');
        return redirect()->route('photo_albums.all');
    }

    public function all() 
    {
    	$data['albums'] = PhotoAlbums::orderBy('created_at', 'desc')->get();
    	return view('backend.photo_albums.all', $data);
    }

    public function edit()
    {
    	$data['edit'] = true;
        $data['id'] = request()->id;
        $item = PhotoAlbums::find($data['id']);
        $data['album'] = $item;

         if (request()->isMethod('post')) {

            $post = (object)Input::get();
            $data['item'] = $post;

            try {

                $item->title = $post->title;

                 $photos = Pictures::where('token', request()->get('unique_token'))->get();

			        if (count($photos) > 0) {
			        	foreach ($photos as $photo) {
			        		$photo->album_id = $item->id;
			        		$photo->save();
			        	}
			        }


                 if (request()->file('img') != null) {

                        $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/photo_albums/' . $item->product_id;
                        
                        $sizes = Config::get('images.sizes.photo_album');

                        foreach ($sizes as $size)
                        {
                            @unlink($dir . '/' . $size . '/' . $item->img);
                        }

                        @unlink($dir . '/' . $item->img);

                     $filename = $this->uploadImage(request()->file('img'), $item->id);
                     $item->photo = $filename;
                    }

                   if (request()->file('background') != null) {

                        $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/photo_albums/' . $item->product_id;

                        @unlink($dir . '/' . $item->background);

                     $filename = $this->uploadBackground(request()->file('background'), $item->id);
                     $item->background = $filename;
                 }

                 $item->save();

                 

              CmsLogs::create([
                    'admin_id' => \Auth::user()->id,
                    'action'   => "Промени албум с име ". request()->get('title'),
                ]);

                Session::flash('success_message', trans('backend.messages.success.created'));
                return redirect()->route('photo_albums.all');

            } catch (Exception $e) {
                return view('Backend::photo_albums.create')->withErrors($e->getMessage())->with($data);
            }
        }

        return view('backend.photo_albums.create', $data);
    }

  

      public function uploadPictureFile(Request $request)
    {
        $success = false;
        $errormessage = "unknown error";

        if ($request->ajax() && $request->isMethod('post')) {

                $file = request()->file('file');
                $token = request()->get('token');
                $rand = rand(11111,99999);
                
   				$filename = Config::get('images.prefix.photos') . '_' . time() + rand() . '.' . $file->getClientOriginalExtension();

        		$dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/photos';

        		 if (!is_dir($dir)) {
		            mkdir($dir);
		        }


                try
                {
                	$manager = new ImageManager();
         
       				$manager->make($file)->save($dir . '/' . $filename);

       				$album = Pictures::create([
			        	'album_id' => 0,
			        	'image' => $filename,
			        	'token' => $token,
			        ]);


                    $success = true;
                }
                catch (Exception $e)
                {
                    $errormessage = $e->getMessage();
                }
            
        }

        return json_encode(array('success' => $success, 'errormessage' => $errormessage));
    }

     protected function uploadImage($file, $album_id = "temp")
     {
        $filename = Config::get('images.prefix.album') . '_' . time() . '.' . $file->getClientOriginalExtension();
        $sizes = Config::get('images.sizes.photo_album');

        $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/photo_albums';

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $dir .= '/' . $album_id;

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $manager = new ImageManager();
         
        $manager->make($file)->save($dir . '/' . $filename);

        foreach ($sizes as $size) {
            if (strstr($size, 'x')) {
                $exp = explode('x', $size);
                $width = $exp[0];
                $height = $exp[1];
            } else {
                $width = $size;
                $height = $size;
            }

            if (!is_dir($dir . '/' . $width . 'x' . $height)) {
                mkdir($dir . '/' . $width . 'x' . $height);
            }

            $manager->make($file)->crop($width, $height)->save($dir . '/' . $width . 'x' . $height . '/' . $filename);
        }

        return $filename;
    }

    protected function uploadBackground($file, $album_id = "temp")
     {

        $filename = 'bg_' . Config::get('images.prefix.album') . '_' . time() . '.' . $file->getClientOriginalExtension();
        $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/photo_albums';

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $dir .= '/' . $album_id;

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $manager = new ImageManager();
         

        $manager->make($file)->save($dir . '/' . $filename);

        return $filename;
    }

    public function deleteFile(Request $request)
    {
        $success = false;
        $errormessage = "unknown error";

        if ($request->ajax() && $request->isMethod('post')) {

                $album_id = (int)$request->get('id');

                $item = PhotoAlbums::where('id', $album_id)->first();

                if (!empty($item))
                {
                    try
                    {
                        $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/photo_albums/' . $item->id;
                        
                        $sizes = Config::get('images.sizes.photo_album');

                        foreach ($sizes as $size)
                        {
                            @unlink($dir . '/' . $size . '/' . $item->photo);
                            rmdir($dir . '/' . $size);
                        }

                        @unlink($dir . '/' . $item->photo);

                         $item->photo = 0;
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

     public function deleteBackground(Request $request)
    {
        $success = false;
        $errormessage = "unknown error";

        if ($request->ajax() && $request->isMethod('post')) {

                $album_id = (int)$request->get('id');

                $item = PhotoAlbums::where('id', $album_id)->first();

                if (!empty($item))
                {
                    try
                    {
                        $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/photo_albums/' . $item->id;
                        
                   
                        @unlink($dir . '/' . $item->background);

                         $item->background = 0;
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

    public function deletePicture(Request $request)
    {
        $success = false;
        $errormessage = "unknown error";

        if ($request->ajax() && $request->isMethod('post')) {

                $photo_id = (int)$request->get('id');

                $item = Pictures::where('id', $photo_id)->first();

                if (!empty($item))
                {
                    try
                    {
                        $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/photos';
                        

                        @unlink($dir . '/' . $item->image);

                         $item->delete();

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
                $album = PhotoAlbums::find($id);
                $pictures = Pictures::where('album_id', $album->id)->get();
                $album_title = $album->title;

                $picDir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/photos';
                $albumDir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/photo_albums/' . $request->get('id');
                        
                $sizes = Config::get('images.sizes.photo_album');


                if (strlen($album->photo) > 1) {
                    foreach ($sizes as $size)
                    {
                        @unlink($albumDir . '/' . $size . '/' . $album->photo);
                        rmdir($albumDir . '/' . $size);
                    }

                    @unlink($albumDir . '/' . $album->photo);
                    @unlink($albumDir . '/' . $album->background);
                    rmdir($albumDir);
                }

                

                if (count($pictures) > 0) {
                    foreach ($pictures as $picture) {
                         @unlink($picDir . '/' . $picture->image);
                         $picture->delete();
                    }
                }
                


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
