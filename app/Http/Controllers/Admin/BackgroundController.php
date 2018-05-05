<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\CmsLogs;

class BackgroundController extends Controller
{
    public function store()
    {
    	if (request()->file('img') != null) {
        	 $filename = $this->uploadImage(request()->file('img'));
        }

         CmsLogs::create([
            'admin_id' => \Auth::user()->id,
            'action'   => "Промени фона на главната страница",
        ]);

        return redirect()->route('dashboard');
    }

       protected function uploadImage($file)
     {
        $filename = 'header.jpg';

        $dir = $_SERVER['DOCUMENT_ROOT'] . '/frontend/img/header';

        if (!is_dir($dir)) {
            mkdir($dir);
        }

        $manager = new ImageManager();
         
        @unlink($dir . '/' . $filename);
        $manager->make($file)->save($dir . '/' . $filename);

        return $filename;
    }
}
