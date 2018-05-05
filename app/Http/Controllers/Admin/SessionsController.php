<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class SessionsController extends Controller
{

	public function __construct() {
		$this->middleware('guest', ['except' => 'destroy']);
	}
    public function create() 
    {
    	return view('backend.pages.login');
    }

    public function store()
    {

    	if(! auth()->attempt(request(['email', 'password'])))
    	{
    		return back()->withErrors(['message' => 'Грешно име или парола!']);
    	}

    	return redirect()->route('dashboard');
    }

    public function destroy()
    {
    	auth()->logout();

    	return redirect()->route('login');
    }
}
