<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Person;
use App\Models\User;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Person::class;

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
            'slug' => $this->faker->slug,
            'birthday' => $this->faker->word,
            'biography' => $this->faker->text,
            'inst' => $this->faker->word,
            'twitter' => $this->faker->word,
            'picture' => $this->faker->word,
            'status' => $this->faker->randomElement(["PUBLISHED","DISABLE","MODERATION"]),
            'author_id' => User::factory(),
        ];
    }
}
