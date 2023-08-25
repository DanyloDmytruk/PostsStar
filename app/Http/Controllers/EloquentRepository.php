<?php

namespace App\Http\Controllers;

use App\Http\Controllers;
use App\Models\Posts;
use Illuminate\Database\Eloquent\Collection;

class EloquentRepository implements PostsRepository
{
    public function search(string $query = ''): Collection
    {
        return Posts::query()
            ->where('content', 'like', "%{$query}%")
            ->orWhere('title', 'like', "%{$query}%")
            ->get();
    }
}