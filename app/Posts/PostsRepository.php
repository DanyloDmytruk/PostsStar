<?php

namespace App\Posts;

use Illuminate\Database\Eloquent\Collection;

interface PostsRepository
{
    public function search(string $query = ''): Collection;
}