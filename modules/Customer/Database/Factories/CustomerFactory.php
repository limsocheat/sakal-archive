<?php

namespace Modules\Customer\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Customer\Models\Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'         => $this->faker->title,
            'first_name'    => $this->faker->firstName,
            'middle_name'   => $this->faker->firstName,
            'last_name'     => $this->faker->lastName,
            'gender'        => $this->faker->randomElement(['male', 'female']),
            'phone'         => $this->faker->phoneNumber,
            'email'         => $this->faker->safeEmail(),
        ];
    }
}
