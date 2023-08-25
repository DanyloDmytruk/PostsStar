<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;

interface PostsRepository
{
    public function search(string $query = ''): Collection;
}