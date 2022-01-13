<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Movie;
use App\Models\Season;

class SeasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Season::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'og_name' => $this->faker->word,
            'description' => $this->faker->text,
            'picture' => $this->faker->word,
            'number' => $this->faker->randomNumber(),
            'movie_id' => Movie::factory(),
        ];
    }
}
