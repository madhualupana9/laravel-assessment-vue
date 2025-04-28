<?php

namespace App\Services;

use App\Models\Detail;
use App\Models\User;

class UserService
{
    public function saveUserDetails(User $user)
    {
        $this->saveDetail($user, 'Full name', $user->fullName);
        $this->saveDetail($user, 'Middle initial', $user->middleInitial);
        $this->saveDetail($user, 'Avatar', $user->photo);
        $this->saveDetail($user, 'Gender', $user->prefixname);
    }

    protected function saveDetail(User $user, string $key, ?string $value)
    {
        $user->details()->updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'type' => 'user_info']
        );
    }
}