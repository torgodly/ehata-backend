<?php

namespace App\Mail;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;


    public Post $post;
    public $postImage;

    /**
     * Create a new message instance.
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
        $this->postImage = $post->getFirstMediaUrl('images');
    }

    public function build()
    {
        return $this->subject('Our Latest Newsletter')
            ->view('mail.newsletter', ['post' => $this->post, 'postImage' => $this->postImage]);
    }

}
