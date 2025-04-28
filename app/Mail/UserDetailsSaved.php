<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserDetailsSaved extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public User $user) {}

    public function build()
    {
        return $this->subject('User Details Saved')
                    ->view('emails.user_details_saved') // your blade file
                    ->with([
                        'user' => $this->user,
                        'details' => $this->user->details,
                    ]);
    }
}
