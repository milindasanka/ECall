<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class mailpost extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
    }
    public function sendmail($mail,$subject,$htmlContent){
        $array['view'] = 'emails.newsletter';
        $array['subject'] = $subject;
        $array['from'] = env('MAIL_FROM_ADDRESS');
        $array['content'] = $htmlContent;
        try {
            Mail::to($mail)->queue(new SendMail($array));
        } catch (\Exception $e) {
            dd($e);
        }
    }
}
