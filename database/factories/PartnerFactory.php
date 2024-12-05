<?php

namespace Database\Factories;

use App\Models\Partner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PartnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partner::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->company, // Generate a fake company name
            'image' => $this->faker->imageUrl(640, 480, 'business'), // Generate a fake image URL
            'country' => $this->faker->country, // Generate a fake country name
            'website' => $this->faker->url, // Generate a fake website URL
            'description_en' => $this->faker->paragraph, // Generate a fake paragraph of text
            'created_at' => now(), // Set the current date and time
            'updated_at' => now(), // Set the current date and time
        ];
    }
}
