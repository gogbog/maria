<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function login() {
    	return view('backend.login.login');
    }

    public function create()
    {

    	$success = false;
        $errormessage = "unknown error";

    	if(!auth()->attempt(request(['email', 'password'])))
    	{
    		$errormessage = "Грешно име или парола!";
    	}
    	else
    	{
    		$success = true;
    	}
    	return json_encode(array('success' => $success, 'errormessage' => $errormessage));
    }

     public function destroy()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
