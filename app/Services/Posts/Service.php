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

}
