<?php

namespace Database\Factories;

use App\Models\Participant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

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
        $uncryptedPassword = $this->faker->password(4,10);
        $cryptedPassword = Hash::make($uncryptedPassword);
        return [
            'nom'=>fake()->lastName(),
            'prenom'=>fake()->firstName(),
            'telephone'=>fake()->unique()->numerify('0#########'),
            'email'=>fake()->email(),
            'password_not_crypted'=>$uncryptedPassword,
            'password'=>$cryptedPassword,
            'adminitrateur'=>false,
            'actif'=>false,
            'campus_id'=>fake()->numberBetween(1,3),
            'sortie_id'=>fake()->numberBetween(1,5),


        ];
    }


}
