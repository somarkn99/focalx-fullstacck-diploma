<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewsLetterController extends Controller
{
    public function send(Request $request)
    {
        $email['to'] = $request->to;
        $email['name'] = $request->name;
        $email['subject'] = $request->subject;
        $email['msg'] = $request->msg;

        SendEmailJob::dispatch($email);
    }
}
