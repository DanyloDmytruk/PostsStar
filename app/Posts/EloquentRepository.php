<?php

namespace App\Posts;

use App\Models\Posts as Post;
use Illuminate\Database\Eloquent\Collection;


class EloquentRepository implements PostsRepository
{
    public function search(string $query = ''): Collection
    {
        return Post::query()
            ->where('content', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->get();
    }
}