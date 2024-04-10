<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostLikedNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $likerName;
    public $postOwnerName;

    public function __construct($likerName, $postOwnerName)
    {
        $this->likerName = $likerName;
        $this->postOwnerName = $postOwnerName;
    }

    public function build()
    {
        return $this->subject('Your post has been liked!')
                    ->markdown('emails.post-liked-notification');
    }
}
