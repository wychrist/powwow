<?php

namespace App\Mail\OnlineContact;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Notifies the secretary about a new online contact
 *
 */
class SendEmailToSecretary extends Mailable
{
    use Queueable, SerializesModels;

    private array $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.online_contact.send-email-to-secretary')
            ->subject(config('app.site_name'). ' - New online contact')
            ->with($this->data);
    }
}
