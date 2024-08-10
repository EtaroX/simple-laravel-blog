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

        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence(),
            'body' => $this->faker->markdown(),
            'photo' => $this->faker->imageUrl(),
            'tag' => $this->faker->word(),
        ];
    }
}
