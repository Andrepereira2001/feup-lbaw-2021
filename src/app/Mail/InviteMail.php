<?php

namespace App\Mail;

use App\Models\Project;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $projectName;
    public $userName;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invite, $url)
    {
      $this->projectName = Project::find($invite->id_project)->name;
      $this->userName = User::find($invite->id_user)->name;
      $this->url = $url;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invite');
    }
}
