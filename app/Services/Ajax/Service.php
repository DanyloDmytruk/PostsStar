<?php

namespace App\Services\Ajax;

use App\Models\User;
use App\Models\Posts;
use App\Models\PostTag;
use App\Models\Tags;

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

    public function create_post($userId, $image, $title, $content, $category, $tags) : bool
    {
        $user = User::find($userId);

        //Check post with author same title exists, then return false
        if (Posts::where('title', $title)->where('author_id', $userId)->first()) {
            return false;
        }

        //Move post image
        $postImageName = time() . $user->name[0] . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('img') . '/posts/', $postImageName);

        //Create post
        $Post = Posts::create([
            'title' => $title,
            'image' => $postImageName,
            'content' => $content,
            'likes' => 0,
            'is_published' => true,
            'category_id' => $category,
            'author_id' => $userId,
        ]);

        //Add tags to post
        foreach (explode(',', trim($tags)) as $tag) {
            $tag_id = -1;
            $tagRow = Tags::where('title', $tag)->first();

            if (!$tagRow) //If tag does not exists, create it
            {
                $tag_id = Tags::create([
                    'title' => $tag
                ])->id;
            }
            else
            {
                $tag_id = $tagRow->id;
            }

            //Link tags to post
            PostTag::create([
                'tag_id' => $tag_id,
                'post_id' => $Post->id,
            ]);
        }

        return true;
    }

    public function delete_post($id, $authorId){
        Posts::where('id', $id)->where('author_id', $authorId)->delete();
    }
}
