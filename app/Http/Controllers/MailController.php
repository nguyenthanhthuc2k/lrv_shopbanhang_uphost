<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();

class MailController extends Controller
{
    public function send_mail(){
    	 //send mail
        $to_name = "Nguyen Thanh Thuc";
        $to_email = "nguyenthanhthuc92@gmail.com";//send to this email

        $data = array("name"=>"Hi.","body"=>"Nội dung"); //body of mail.blade.php
    
        Mail::send('pages.email.send-mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('test mail nhé');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        //return redirect('/')->with('message','');
        //--send mail

    }
}
