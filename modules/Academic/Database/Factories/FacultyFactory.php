<?php

namespace Modules\Academic\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FacultyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Academic\Models\Faculty::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid'          => $this->faker->uuid,
            'name'          => $this->faker->name,
            'description'   => $this->faker->sentence(),
            'active'        => true,
        ];
    }
}
