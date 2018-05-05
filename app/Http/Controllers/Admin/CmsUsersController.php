<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\CmsLogs;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CmsUsersController  extends Controller
{
	public function __construct()     {
    	$this->middleware('auth');
    }

    public function store() 
    {

          $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);


        User::create([
        	'first_name' => request()->get('first_name'),
        	'last_name' => request()->get('last_name'),
        	'email' => request()->get('email'),
        	'password' => Hash::make(request()->get('password'))
        ]);

        CmsLogs::create([
            'admin_id' => Auth::user()->id,
            'action'   => "Създаде админ с имейл ". request()->get('email'),
        ]);

        request()->session()->flash('success_message', 'Админа беше добавен успешно!');
        return redirect()->route('cms_users.all');

    }

    public function edit()
    {
        $data['edit'] = true;
        $data['id'] = request()->id;
        $data['admin'] = User::find($data['id']);
        return view('backend.cms-users.create', $data);
    }

    public function update()
    {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);


        $id =  request()->get('admin_id');

        $customer = User::find($id);
        $customer->first_name = request()->get('first_name');
        $customer->last_name = request()->get('last_name');
        $customer->email = request()->get('email');
        $customer->password = Hash::make(request()->get('password'));
        $customer->save();

        CmsLogs::create([
            'admin_id' => Auth::user()->id,
            'action'   => "Промени админ с имейл ". request()->get('email'),
        ]);


        request()->session()->flash('success_message', 'Админа е променен успешно!');
        return redirect()->route('cms_users.all');
    }

    public function all() 
    {
    	$data['cms_users'] = User::orderBy('created_at', 'desc')->get();
    	return view('backend.cms-users.all', $data);
    }

    
     public function create() 
     {
    	return view('backend.cms-users.create');
    }

     public function delete() {
        $success = false;
        $errormessage = "unknown error";
        $request = request();
        if ($request->ajax() && $request->isMethod('post') && !empty($request->get('id'))) {
            try {
                $id = $request->get('id');
                $admin = User::find($id);
                $admin_email = $admin->email;
                if (!empty($id)) {
                    $admin->delete();
                }

                CmsLogs::create([
                    'admin_id' => Auth::user()->id,
                    'action'   => "Изтри админ с имейл ". $admin_email,
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
