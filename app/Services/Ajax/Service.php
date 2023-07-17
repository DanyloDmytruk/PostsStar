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

    public function change_user_avatar($userId, $avatar)
    {
        $user = User::find($userId);

        //delete old photo
        if (file_exists(public_path('avatars') . '/' . $user->avatar)) {
            unlink(public_path('avatars') . '/' . $user->avatar);
        }

        //set new photo
        $avatarName = time() . $user->name[0] . '.' . $avatar->getClientOriginalExtension();
        $avatar->move(public_path('avatars'), $avatarName);

        //add to db
        $user->avatar = $avatarName;
        $user->save();

        return true;
    }
}
