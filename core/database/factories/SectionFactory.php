<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Section;

class SectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Section::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'icon' => $this->faker->word,
            'faq' => $this->faker->word,
            'answer' => $this->faker->word,
            'contact' => $this->faker->word,
            'testimonial' => $this->faker->word,
        ];
    }
}
