<?php

namespace Database\Factories;

use App\Models\SelfQuestions;
use Illuminate\Database\Eloquent\Factories\Factory;

class SelfQuestionsFactory extends Factory
{
    protected $model = SelfQuestions::class;

    public function definition()
    {
        return [
            'self_id' => \App\Models\SelfAssessment::factory(), // Automatically creates a related SelfAssessment
            'answer' => $this->faker->sentence,
            'options' => $this->faker->sentence,
            'question_en' => $this->faker->sentence,
            'created_at' => $this->faker->dateTime(),
        ];
    }
}
