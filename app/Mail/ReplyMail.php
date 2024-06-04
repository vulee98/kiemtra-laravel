<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;


class ReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $replyMessage;
    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('trannguyennhatkha1002@gmail.com', 'From Kha'),
            replyTo: [
                new Address('trannguyennhatkha1002@gmail.com', 'To user'),
            ],
            subject: 'Gửi phản hồi từ shop bánh',
        );
    }
    public function __construct($contact, $replyMessage)
    {
        $this->contact = $contact;
        $this->replyMessage = $replyMessage;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reply')
                    ->subject('Reply to your comment')
                    ->with([
                        'contact' => $this->contact,
                        'replyMessage' => $this->replyMessage,
                    ]);
    }
}