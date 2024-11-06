<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $data; // Add data property to pass dynamic content

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from('fazil@expertlogicsol.com')
                    ->subject('Contact Us Mail')
                    ->view('emails.contactUs') // Create this view in resources/views/emails/example.blade.php
                    ->with('data', $this->data); // Pass data to the view
    }
}
