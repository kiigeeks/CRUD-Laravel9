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
    public function definition()
    {
        return [
            'judul' => $this->faker->sentence(mt_rand(2,8)),
            'category_id' => mt_rand(1,3),
            'user_id' => mt_rand(1,3),//1-3
            'slug' => $this->faker->unique()->slug(),
            'desc' => collect($this->faker->paragraphs(mt_rand(5,10)))//5-10 paragraph
                    ->map(fn($p) => "<p>$p</p>")
                    ->implode('')
        ];
    }
}
