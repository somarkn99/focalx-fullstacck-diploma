<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsLetterController extends Controller
{
    public function send(Request $request)
    {
        // $email['name'] = $request->name;
        // $email['subject'] = $request->subject;
        // $email['msg'] = $request->msg;

        // SendEmailJob::dispatch($email);
        Mail::to('6be2c993e4ec@drmail.in')->send(new SendEmail);
        return 'Done';
    }
}
