<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Mail\ExampleMail;
use Illuminate\Support\Facades\Mail;

class ExampleEmailController extends Controller
{
    //

    public function sendEmail()
    {
        $data = [
            'title' => 'This is the Email Title',
            'message' => 'This is the body of the email message.',
            'button_text' => 'Click Here',
            'button_url' => 'https://www.example.com'
        ];

        $recipients = [
            'christiankencana99@gmail.com',
            'it12@amt.co.id',
            'it11@amt.co.id'
        ];

        // send rapidly
        Mail::to($recipients)->send(new ExampleMail($data));

        // // send with one by one 
        // foreach ($recipients as $recipient) {
        //     Mail::to($recipient)->send(new ExampleMail($data));
        // }

        // // send with cc and bcc
        // $to = 'recipient1@example.com';
        // $cc = ['recipient2@example.com', 'recipient3@example.com'];
        // $bcc = ['recipient4@example.com', 'recipient5@example.com'];
        // Mail::to($to)->cc($cc)->bcc($bcc)->send(new ExampleMail($data));

        return 'Email has been sent!';
    }
}
