<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use Session;

class SimplePageController extends Controller
{
    public function biography() {
    	$data['dark_version'] = true;
    	$data['hide_player'] = true;
    	return view('frontend.pages.biography', $data);
    }

      public function contactUs() {
      	$data['dark_version'] = true;
      	$data['hide_player'] = true;
    	return view('frontend.pages.contactUs', $data);
    }

    public function sendEmail(Request $request)
	{
		$data = array();

		if ($request->isMethod('post')) {

			try {

				$this->validate($request, [
					'first_name' => 'required',
					'last_name' => 'required',
					'email' => 'required',
					'subject' => 'required',
					'comment' => 'required',
				]);

				$emailData['first_name'] = $request->first_name;
				$emailData['last_name'] = $request->last_name;
				$emailData['email'] = 'gogbog@abv.bg';
				$emailData['comment'] = $request->comment;
				$emailData['subject'] = 'Контакти';
				 
				  Mail::send('frontend.emails.contacts', ['data' => $emailData], function ($message) {
		            $message->from('gogbog@abv.bg', 'Laravel');

		            $message->to('gogbog@abv.bg')->cc('gogbog@abv.bg');
		        });
				  
				Session::flash('success_message', 'Успешно пратихте съобщението си!');
				return redirect()->route('contactUs');

			} catch (Exception $e) {
				return view('frontend.pages.contactUs')->withErrors($e->getMessage())->with($data);
			}
		}
		return view('frontend.pages.contactUs', $data);
	}
}
