<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Search\Searchable;


class Posts extends Model
{
    use Searchable;
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;

    public function category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }

    public function usersLiked()
    {
        return $this->belongsToMany(User::class, 'post_likes', 'post_id', 'author_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tags::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class, 'post_id', 'id');
    }
}
