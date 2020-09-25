<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Camp;
use App\User;
use Auth;

class camp_mail extends Mailable
{
    use Queueable, SerializesModels;
    private $idCampana;
    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($idCampana,$user)
    {
        $this->idCampana=$idCampana;
        $this->user=$user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $camp=Camp::with('user')->findOrFail($this->idCampana);
        $user=$this->user;
        return $this->view('emails.camp',['camp'=>$camp,'user'=>$user]);
    }
}
