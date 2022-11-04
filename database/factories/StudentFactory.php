<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentFactory extends Factory
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
            'name' => $faker->name(),
            'password' => '456', // password
            'phone' =>$faker->phoneNumber(),
            'email' => $faker->unique()->safeEmail(),
        ];
    }
}
