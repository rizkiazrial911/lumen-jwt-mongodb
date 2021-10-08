<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function send_email()
    {
        Mail::raw('This is the email body.', function ($message) {
          $message->to('rizkiazrial.1910@gmail.com')
            ->subject('Lumen email test');
        });
        if (Mail::failures()) {
          return 'Sorry! Please try again latter :(';
        } else {
          return 'Great! eMail successfully sent ;)';
        }
    }
}
