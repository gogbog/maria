<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\CmsLogs;
use App\Tasks;
use App\Songs;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

	public function __construct() {
    	$this->middleware('auth');
    }
    
    public function store() {
    	$data['tasks'] = Tasks::orderBy('created_at', 'DESC')->get();
    	$data['songs'] = Songs::withSongs()->get();


    	

        $data['logs'] = CmsLogs::join('users', 'users.id', '=', 'cms_logs.admin_id')->orderBy('cms_logs.created_at', 'DESC')->get();
    	return view('backend.pages.dashboard', $data);
    }
}
