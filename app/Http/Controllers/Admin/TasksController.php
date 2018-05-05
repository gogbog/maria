<?php

namespace App\Http\Controllers\Admin;

use App\Tasks;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TasksController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    
    public function store()
    {
    	$success = false;
        $errormessage = "unknown error";
    	try {
    		$task = request()->get('task');
	    	$task = Tasks::create([
	    		'task' => $task
	    	]);
	    	$success = true;
    	 } catch (Exception $e) {
            $errormessage = $e->getMessage();
        }

    	return array('success' => $success, 'errormessage' => $errormessage, 'task' => $task);
    }

    public function changeStatus() {
        $id = request()->get('id');
        $success = false;
        $errormessage = "unknown";

        try
        {
            $task = Tasks::find($id);
            
            if ($task->status == 1) 
            {
               $task->status = 0;
            }
            else 
            {
               $task->status = 1;
            }
            
            $task->save();
            $success = true;
        }
        catch (Exception $e) {
            $errormessage = $e->getMessage();
        }

        return array('success' => $success, 'errormessage' => $errormessage);
    }

    public function deleteCompleted() 
    {
        $success = false;
        $errormessage = "unknown";

        try
        {
            $tasks = Tasks::where('status', 1)->get();
            if (count($tasks))
            {
                foreach ($tasks as $task) {
                    $task->delete();
                }
            }
            $success = true;
        }
        catch (Exception $e) {
            $errormessage = $e->getMessage();
        }

        return array('success' => $success, 'errormessage' => $errormessage);
    }
}
