<?php

namespace App\Services\Posts;

class Service
{
    public function trim_post_content_for_list($maxCharCount = 60, $inputString)
    {
        $shortenedSentence = substr($inputString, 0, $maxCharCount); // Get the substring up to 60 characters
        $lastSpaceIndex = strrpos($shortenedSentence, ' '); // Find the last space in the substring
        $shortenedSentence = substr($shortenedSentence, 0, $lastSpaceIndex); // Remove any partial word at the end
        return $shortenedSentence;
    }

    public function get_post_date($dateTimestamp)
    {
        if (time() < $dateTimestamp + 60 * 5) {
            return 'few minutes ago';
        } else {
            return date("H:i j/n/Y", $dateTimestamp);
        }
    }


    public function format_paginative_posts_ajax($posts)
    {
        //Posts::where('author_id', auth()->user()->id)->paginate(10);
        $result = array();
        foreach ($posts as $post) {
            $elementPost = array(
                "id" => $post->id,
                "title" => $post->title,
                "date" => $this->get_post_date(strtotime($post->created_at)),
                "content" => strlen($post->content) > 60 ? $this->trim_post_content_for_list(80, $post->content) . '...' : $post->content,
                "category" => $post->category->title,
                "tags" => array(),
            );

            foreach($post->tags as $tag)
            {   
                array_push($elementPost["tags"], $tag);
            }


            array_push($result, $elementPost);
        }

        return json_encode($result);
    }
}
