<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Movie;
use App\Models\User;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'name_original' => $this->faker->word,
            'alt_name' => $this->faker->word,
            'slug' => $this->faker->slug,
            'category_id' => Category::factory(),
            'description' => $this->faker->text,
            'status_movie' => $this->faker->word,
            'tagline' => $this->faker->word,
            'year' => $this->faker->randomNumber(),
            'chanel' => $this->faker->word,
            'language' => $this->faker->word,
            'duration' => $this->faker->word,
            'source_url' => $this->faker->text,
            'picture' => $this->faker->word,
            'screen_url' => $this->faker->word,
            'date_pub_rus' => $this->faker->dateTime(),
            'date_pub_world' => $this->faker->dateTime(),
            'published_at' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(["PUBLISHED","DISABLE","MODERATION"]),
            'author_id' => User::factory(),
        ];
    }
}
