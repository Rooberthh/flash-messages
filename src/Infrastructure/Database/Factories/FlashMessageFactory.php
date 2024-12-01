<?php

namespace Rooberthh\FlashMessage\Infrastructure\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FlashMessageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'parent_id' => new FlashMessageFactory(),
            'status' => $this->faker->status,
            'channel' => $this->faker->word,
            'title' => $this->faker->title,
            'description' => $this->faker->description,
        ];
    }
}
