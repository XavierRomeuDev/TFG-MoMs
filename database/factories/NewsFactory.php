<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence, // Generates a random title
            'image' => $this->faker->imageUrl, // Generates a random image URL
            'description_en' => $this->faker->paragraph, // Generates a random English description
            'created_at' => now(), // Sets the current timestamp
            'updated_at' => now(), // Sets the current timestamp
        ];
    }
}
