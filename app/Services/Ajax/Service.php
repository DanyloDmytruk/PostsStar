<?php

namespace App\Services\Ajax;

use App\Models\CommentLikes;
use App\Models\Comments;
use App\Models\User;
use App\Models\Posts;
use App\Models\PostTag;
use App\Models\Tags;
use App\Models\PostLikes;

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

    public function create_post($userId, $image, $title, $content, $category, $tags): bool
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
            } else {
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

    public function delete_post($id, $authorId)
    {
        Posts::where('id', $id)->where('author_id', $authorId)->delete();
    }

    public function update_post($id, $authorId, $content, $tags)
    {
        $post = Posts::where('id', $id)->where('author_id', $authorId)->firstOrFail();

        //Change content
        $post->content = $content;

        //Add tags to post
        foreach (explode(',', trim($tags)) as $tag) {
            $tag_id = -1;
            $tagRow = Tags::where('title', $tag)->first();

            if (!$tagRow) //If tag does not exists, create it
            {
                $tag_id = Tags::create([
                    'title' => $tag
                ])->id;
            } else {
                $tag_id = $tagRow->id;
            }

            //Link tags to post
            PostTag::firstOrCreate([
                'tag_id' => $tag_id,
                'post_id' => $post->id,
            ]);
        }

        $post->save();

        \Cache::put('post_'.$id, $post);

        return true;
    }

    public function create_comment($content, $authorId, $postId)
    {

        Comments::create([
            'content' => $content,
            'author_id' => $authorId,
            'post_id' => $postId,
        ]);

        return true;
    }

    public function update_comment($commentId, $content, $authorId)
    {

        $comment = Comments::where('author_id', $authorId)->where('id', $commentId)->first();
        if(!$comment)
        {
            return false;
        }

        $comment->content = $content;
        $comment->save();

        return true;
    }

    public function like_post($authorId, $postId)
    {
        if (PostLikes::where('post_id', $postId)->where('author_id', $authorId)->count() == 0) {
            $post = Posts::find($postId);
            $post->likes++;
            $post->save();


            PostLikes::firstOrCreate([
                'post_id' => $postId,
                'author_id' => $authorId,
            ]);
        }

        return PostLikes::where('post_id', $postId)->count(); //return post likes
    }

    public function dislike_post($authorId, $postId)
    {

        if (PostLikes::where('post_id', $postId)->where('author_id', $authorId)->count() != 0) {
            $post = Posts::find($postId);
            $post->likes--;
            $post->save();


            PostLikes::where('author_id', $authorId)->where('post_id', $postId)->delete();
        }

        return PostLikes::where('post_id', $postId)->count(); //return post likes
    }

    public function like_comment($authorId, $commentId)
    {

        if (CommentLikes::where('comment_id', $commentId)->where('author_id', $authorId)->count() == 0) {
            $comment = Comments::find($commentId);
            $comment->likes++;
            $comment->save();


            CommentLikes::firstOrCreate([
                'comment_id' => $commentId,
                'author_id' => $authorId,
            ]);
        }

        return CommentLikes::where('comment_id', $commentId)->count(); //return comment likes
    }

    public function dislike_comment($authorId, $commentId)
    {

        if (CommentLikes::where('comment_id', $commentId)->where('author_id', $authorId)->count() != 0) {
            $comment = Comments::find($commentId);
            $comment->likes--;
            $comment->save();

            CommentLikes::where('author_id', $authorId)->where('comment_id', $commentId)->delete();
        }

        return CommentLikes::where('comment_id', $commentId)->count(); //return comment likes
    }

    public function unban_user($userId)
    {
        if(auth()->user()->role === 'admin')
        {
            $user = User::find($userId);
            $user->is_banned = false;
            $user->save();

            return true;
        }

        return false;
    }

    public function ban_user($userId)
    {
        if(auth()->user()->role === 'admin')
        {
            $user = User::find($userId);
            $user->is_banned = true;
            $user->save();

            return true;
        }

        return false;
    }

    public function delete_comment($id)
    {
        $comment = Comments::find($id);

        if(auth()->user()->role === 'admin' || $comment->author->id === auth()->user()->id)
        {
            $comment->delete();

            return true;
        }

        return false;
    }
}
