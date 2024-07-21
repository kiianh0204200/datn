<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductComment>
 */
class ProductCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'product_id' => 1,
            'email' => $this->faker->email,
            'name' => $this->faker->name,
            'messages' => $this->faker->text,
            'rating' => $this->faker->numberBetween(1, 5),
        ];
    }
}
