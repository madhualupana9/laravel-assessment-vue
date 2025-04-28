<?php

namespace App\Listeners;

use App\Events\UserSaved;
use App\Services\UserService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserDetailsSaved;

class SaveUserBackgroundInformation implements ShouldQueue
{
    public function __construct(private UserService $userService) {}

    public function handle(UserSaved $event)
    {
        $this->userService->saveUserDetails($event->user);
        
        // Send email notification
        Mail::to($event->user->email)->send(
            new UserDetailsSaved($event->user)
        );
    }
}
