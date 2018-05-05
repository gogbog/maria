<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;
use App\CmsLogs;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Input;
use  Config;
use Session;

class NewsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function create() 
    {
    	return view('backend.news.create');
    }

    public function store()
    {
    	 $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
            'short_desc' => 'required',
        ]);


        $article = News::create([
        	'title' => request()->get('title'),
        	'description' => request()->get('description'),
        	'short_desc' => request()->get('short_desc'),
        	'img' => 0,
        ]);

        if (request()->file('img') != null) {
        	 $filename = $this->uploadImage(request()->file('img'), $article->id);
        	 $article->img = $filename;
        	 $article->save();
        }

        CmsLogs::create([
            'admin_id' => \Auth::user()->id,
            'action'   => "Създаде статия с име ". request()->get('title'),
        ]);

        request()->session()->flash('success_message', 'Статията беше създадена успешно!');
        return redirect()->route('news.all');
    }

    public function all() 
    {
    	$data['articles'] = News::orderBy('created_at', 'desc')->get();
    	return view('backend.news.all', $data);
    }

    public function edit()
    {
    	$data['edit'] = true;
        $data['id'] = request()->id;
        $item = News::find($data['id']);
        $data['article'] = $item;

         if (request()->isMethod('post')) {

            $post = (object)Input::get();
            $data['item'] = $post;

            try {

                $item->title = $post->title;
                $item->short_desc = $post->short_desc;
                $item->description = $post->description;

                 if (request()->file('img') != null) {

                        $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/blog/' . $item->product_id;
                        
                        $sizes = Config::get('images.sizes.articles');

                        foreach ($sizes as $size)
                        {
                            @unlink($dir . '/' . $size . '/' . $item->img);
                        }

                        @unlink($dir . '/' . $item->img);

                     $filename = $this->uploadImage(request()->file('img'), $item->id);
                     $item->img = $filename;
                 }

                 $item->save();

                 

              CmsLogs::create([
                    'admin_id' => \Auth::user()->id,
                    'action'   => "Промени статия с име ". request()->get('title'),
                ]);

                Session::flash('success_message', trans('backend.messages.success.created'));
                return redirect()->route('news.all');

            } catch (Exception $e) {
                return view('Backend::events.create')->withErrors($e->getMessage())->with($data);
            }
        }

        return view('backend.news.create', $data);
    }

     public function deleteFile(Request $request)
    {
        $success = false;
        $errormessage = "unknown error";

        if ($request->ajax() && $request->isMethod('post')) {

                $article_id = (int)$request->get('id');

                $item = News::where('id', $article_id)->first();
                if (!empty($item))
                {
                    try
                    {
                          $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/blog/' . $item->product_id;
                        
                        $sizes = Config::get('images.sizes.articles');

                        foreach ($sizes as $size)
                        {
                            @unlink($dir . '/' . $size . '/' . $item->img);
                        }

                        @unlink($dir . '/' . $item->img);

                         $item->img = 0;
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

     protected function uploadImage($file, $product_id = "temp")
     {
        $filename = Config::get('images.prefix.articles') . '_' . time() . '.' . $file->getClientOriginalExtension();
        $sizes = Config::get('images.sizes.articles');

        $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/blog';

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $dir .= '/' . $product_id;

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

            $manager->make($file)->resize($width, $height)->save($dir . '/' . $width . 'x' . $height . '/' . $filename);
        }

        return $filename;
    }

    public function delete() {
        $success = false;
        $errormessage = "unknown error";
        $request = request();
        if ($request->ajax() && $request->isMethod('post') && !empty($request->get('id'))) {
            try {

                $id = $request->get('id');
                $article = News::find($id);
                $article_title = $article->title;

                if (strlen($article->img) > 1)
                {
                    $sizes = Config::get('images.sizes.articles');

                    $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/uploads/blog/' . $id;

                    foreach ($sizes as $size)
                    {
                        @unlink($dir . '/' . $size . '/' . $article->img);
                        rmdir($dir . '/' . $size);
                    }


                    @unlink($dir . '/' . $article->img);
                    rmdir($dir);
                }


                $article->delete();

                CmsLogs::create([
                    'admin_id' => \Auth::user()->id,
                    'action'   => "Изтри статия с име ". $article_title,
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
