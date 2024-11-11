<?php

namespace Database\Factories;

use App\Models\TravelRequests;
use Illuminate\Database\Eloquent\Factories\Factory;

class TravelRequestsFactory extends Factory
{
    protected $model = TravelRequests::class;

    public function definition()
    {
        return [
            'applicant_name' => $this->faker->name(),
            'destination' => $this->faker->city(),
            'start_date' => $this->faker->date(),
            'return_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['solicitado', 'aprovado', 'cancelado']),
        ];
    }
}
