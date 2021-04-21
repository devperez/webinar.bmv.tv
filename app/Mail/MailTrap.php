<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class MailTrap extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $users = User::all();
        //dd($users[0]);
        return $this->markdown('mails.exempl')
        -> from('webinar@bmv.tv'. 'MailTrap')
        -> subject('Connexion à la plateforme Webinar')
        -> markdown('mails.exempl')
        -> with([
            'name' => '{{ $user->firstname }} {{ $user->name }}',
            'link' => 'https://webinar.bmv.tv'
            ]);
    }
}
