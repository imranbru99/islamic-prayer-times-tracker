<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Post;
use App\Models\User;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug,
            'meta' => $this->faker->word,
            'content' => $this->faker->paragraphs(3, true),
            'image' => $this->faker->word,
            'status' => $this->faker->numberBetween(-10000, 10000),
            'sub_category_id' => $this->faker->word,
            'author_id' => User::factory(),
        ];
    }
}
