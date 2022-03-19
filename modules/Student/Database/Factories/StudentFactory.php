<?php

namespace Modules\Student\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Student\Models\Student::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid'          => $this->faker->uuid,
            'first_name'    => $this->faker->firstName,
            'last_name'     => $this->faker->lastName,
            'email'         => $this->faker->unique()->safeEmail,
            'password'      => $this->faker->password,
            'gender'        => $this->faker->randomElement(['male', 'female']),
            'nationality'   => $this->faker->country,
            'date_of_birth' => $this->faker->date(), // generate date of birth from faker
        ];
    }
}
