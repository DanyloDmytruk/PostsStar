<?php

namespace App\Services\Ajax;

use App\Models\User;

class Service
{
    public function change_user_bio($userId, $bio)
    {
        $user = User::find($userId);

        if ($user && strlen($bio) <= 70) {

            $user->bio = $bio;
            $user->save();

            return true;
        } else {
            return false;
        }
    }
}
