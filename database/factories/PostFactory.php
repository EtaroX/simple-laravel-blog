<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $this->faker->addProvider(new \DavidBadura\FakerMarkdownGenerator\FakerProvider($this->faker));
        $this->faker->addProvider(new \Mmo\Faker\PicsumProvider($this->faker));

        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence(),
            'body' => $this->faker->markdown(),
            'photo' => $this->faker->picsumUrl(500, 100),
            'tag' => $this->faker->word(),
        ];
    }
    public function hasLikes(): self
    {
        return $this->state([
            'likes' => $this->faker->numberBetween(1, 100),
            'dislikes' => $this->faker->numberBetween(1, 100),
        ]);
    }
}
