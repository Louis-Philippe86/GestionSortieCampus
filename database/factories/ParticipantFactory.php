<?php

namespace Database\Factories;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Participant>
 */
class ParticipantFactory extends Factory
{
    public $timestamps=false;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nom'=>fake()->lastName(),
            'prenom'=>fake()->firstName(),
            'telephone'=>fake()->unique()->numerify('0#########'),
            'email'=>fake()->email(),
            'password'=>fake()->password(6,10),
            'adminitrateur'=>false,
            'actif'=>false,
            'campus_id'=>fake()->numberBetween(1,3),
            'sortie_id'=>fake()->numberBetween(1,5),


        ];
    }


}
