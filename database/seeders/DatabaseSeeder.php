<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;

use App\Models\Posts;
use App\Models\Tags;
use App\Models\PostTag;
use App\Models\User;

use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    protected $model = Posts::class;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Categories::create([
            'title' => 'dogs'
        ]);

        Categories::create([
            'title' => 'cats'
        ]);

        Categories::create([
            'title' => 'fishes'
        ]);

        Categories::create([
            'title' => 'hamsters'
        ]);

        Tags::create([
            'title' => 'food'
        ]);

        Tags::create([
            'title' => 'house'
        ]);

        Tags::create([
            'title' => 'shit'
        ]);

        Tags::create([
            'title' => 'vitamines'
        ]);
        
        User::factory(10)->create();
        Posts::factory(100)->create();
        

        $tagsIDs = DB::table('tags')->pluck('id');
        $postsIDs = DB::table('posts')->pluck('id');

        PostTag::create([
            'post_id' => $postsIDs[0],
            'tag_id' => $tagsIDs[0],
        ]);

        PostTag::create([
            'post_id' => $postsIDs[0],
            'tag_id' => $tagsIDs[2],
        ]);

        PostTag::create([
            'post_id' => $postsIDs[1],
            'tag_id' => $tagsIDs[1],
        ]);

        PostTag::create([
            'post_id' => $postsIDs[2],
            'tag_id' => $tagsIDs[1],
        ]);

        PostTag::create([
            'post_id' => $postsIDs[3],
            'tag_id' => $tagsIDs[2],
        ]);

        

    }
}
