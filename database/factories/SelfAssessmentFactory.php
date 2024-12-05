<?php

namespace Database\Factories;

use App\Models\SelfAssessment;
use Illuminate\Database\Eloquent\Factories\Factory;

class SelfAssessmentFactory extends Factory
{
    protected $model = SelfAssessment::class;

    public function definition()
    {
        return [
            'title_en' => $this->faker->sentence,
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
