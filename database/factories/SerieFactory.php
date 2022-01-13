<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Season;
use App\Models\Serie;

class SerieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Serie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'or_name' => $this->faker->word,
            'number' => $this->faker->randomNumber(),
            'description' => $this->faker->text,
            'realease_date' => $this->faker->dateTime(),
            'picture' => $this->faker->word,
            'season_id' => Season::factory(),
        ];
    }
}
