<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Categories;

class PostsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categoriesIDs = DB::table('categories')->pluck('id');
        $authorsIDs = DB::table('users')->pluck('id');

        return [
            'title' => $this->faker->title(),
            'image' => $this->faker->imageUrl(),
            'content' => $this->faker->text(),
            'likes' => random_int(1, 100),
            'is_published' => 1,
            'category_id' => $this->faker->randomElement($categoriesIDs),
            'author_id' => $this->faker->randomElement($authorsIDs),
        ];
    }
}
