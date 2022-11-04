<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
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
            'price' =>$faker->randomNumber(3),

        ];
    }
}
