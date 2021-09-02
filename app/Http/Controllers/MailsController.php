<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Mail;

use PDF;

class MailsController extends Controller
{
    public function basic_email()
    {
        $data = array('name'=>"Ashi milonee");
        $pdf = PDF::loadView('Books.test', $data);
        Mail::send(['text'=>'mail'], $data, function ($message) {
            $message->to('urvashi2705@gmail.com', "Ashi's book")->subject('Laravel Basic Testing Mail')->attachData($pdf->output(), 'borrowBook.pdf');
            $message->from('urvashi.hiranandani@brainvire.com', 'ashi milonee');
        });
        echo "Basic Email Sent. Check your inbox.";
    }
    public function html_email()
    {
        $data = array('name'=>"Ashi milonee");
        Mail::send('mail', $data, function ($message) {
            $message->to('urvashi2705@gmail.com', "Ashi's book")->subject('Laravel HTML Testing Mail')->attachData($pdf->output(), "borrow.pdf");
            ;
            $message->from('urvashi.hiranandani@brainvire.com', 'ashi milonee');
        });
        echo "HTML Email Sent. Check your inbox.";
    }
    public function attachment_email()
    {
        $data = array('name'=>"Ashi milonee");
        Mail::send('mail', $data, function ($message) {
            $message->to('urvashi2705@gmail.com', "Ashi's book")->subject('Laravel Testing Mail with Attachment');
            $message->attach('C:\Users\91966\Desktop\LaravelProject\public\upload\1629287703.jpg');
         // $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
            $message->from('urvashi.hiranandani@brainvire.com', 'Virat Gandhi');
        });
        echo "Email Sent with attachment. Check your inbox.";
    }
}
