<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MainTemplate extends Mailable
{
    use Queueable, SerializesModels;

    public $keys;
    public $template;
    public $title;
    public $body;
    public $special;
    public $event;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $args)
    {
        $this->keys = $args['keys'] ?? [];
        $this->template = $args['template'] ?? '';
        $this->title = $args['title'] ?? '';
        $this->body = $args['body'] ?? '';
        $this->special = $args['special'] ?? '';
        $this->subject = $args['subject'] ?? '';
        $this->event = $args['event'] ?? null;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('no-reply@lifestyle.expert')
            ->subject($this->subject)
            ->view('emails.template')
            ->text('emails.plain');
    }
}
