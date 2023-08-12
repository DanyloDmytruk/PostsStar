<?php

namespace App\Http\Resources\Posts;

use Illuminate\Http\Resources\Json\JsonResource;

class ReadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "title" => $this->title,
            "image" => $this->image,
            "content" => $this->content,
            "likes" => $this->likes,
            "me_liked" => $this->me_liked,
            "is_published" => $this->is_published,
            "category" => $this->category,
            "author" => $this->author,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
