<?php

namespace Modules\Academic\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AcademicGenerationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Academic\Models\AcademicGeneration::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid'      => $this->faker->uuid,
            'major_id'  => function () {
                return \Modules\Academic\Models\Major::factory()->create()->id;
            },
            'name'      => $this->faker->word,
        ];
    }
}
