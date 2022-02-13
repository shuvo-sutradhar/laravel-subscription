<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    //
    public function index() {
        return view('support');
    }


    public function send(Request $request) {
        $user = auth()->user();
        $msg =$request->message;
        $subject =$request->subject;

        if($msg == '' || $subject == '') {
            return back()->with(['alert' => 'Please make sure fill out the subject and message', 'alert_type' => 'error']) 
                    ->withInput($request->all());
        }

        Mail::send('mail.support', compact('user', 'msg'), function($mail) use ($user, $subject){
            $mail->from($user->email, $user->name);
            $mail->to('support@weteach.io')->subject("New Support Inquire". '-' . $subject );
        });

        return back()->with(['alert' => 'Successfully sent your request. Please allow up to 24-48 hours for a response.', 'alert_type' => 'success']);
    }
}
