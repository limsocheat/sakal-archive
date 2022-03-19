<?php

namespace Modules\Academic\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MajorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Academic\Models\Major::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid'          => $this->faker->uuid,
            'faculty_id'    => function () {
                return \Modules\Academic\Models\Faculty::factory()->create()->id;
            },
            'name'          => $this->faker->name,
            'description'   => $this->faker->sentence(),
        ];
    }
}
