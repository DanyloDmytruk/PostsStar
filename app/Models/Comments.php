<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comments extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = false;

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function post()
    {
        return $this->belongsTo(Posts::class, 'post_id', 'id');
    }

}
