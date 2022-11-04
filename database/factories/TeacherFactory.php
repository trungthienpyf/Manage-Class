<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TeacherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('vi_VN');

        return [
            'name' => $faker->firstNameFemale() . ' '.$faker->firstNameMale() . ' '. $faker->lastName(),
            'phone' =>  $faker->phoneNumber(),
            'password' => '123', // password
            'level' => '1',
        ];
    }
}
