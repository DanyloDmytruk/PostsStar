<?php

namespace App\Services\Ajax;

use App\Models\User;
use App\Models\Posts;
use App\Models\PostTag;

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

    public function create_post($userId, $image, $title, $content, $category, $tags)
    {
        $user = User::find($userId);

        //Move post image
        $postImageName = time() . $user->name[0] . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('posts').'/img/', $postImageName);

        //Create post
        Posts::create([
            'title' => $title,
            'image' => $postImageName,
            'content' => $content,
            'likes' => 0,
            'is_published' => true,
            'category_id' => $category,
            'author_id' => $userId,
        ]);

        //Add tags to post
    }
}
