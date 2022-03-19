<?php

namespace Modules\Academic\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Academic\Models\AcademicGeneration;
use Modules\Academic\Models\AcademicYear;
use Modules\Academic\Models\Faculty;
use Modules\Academic\Models\Major;
use Modules\Student\Models\Student;

class AcademicCardFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Academic\Models\AcademicCard::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid'                      => $this->faker->uuid,
            'code'                      => $this->faker->unique()->randomNumber(6),
            'student_id'                => function () {
                return Student::factory()->create()->id;
            },
            'faculty_id'                => function () {
                return Faculty::factory()->create()->id;
            },
            'major_id'                  => function () {
                return Major::factory()->create()->id;
            },
            'academic_year_id'          => function () {
                return AcademicYear::factory()->create()->id;
            },
            'academic_generation_id'    => function () {
                return AcademicGeneration::factory()->create()->id;
            },
            'expired_at'                => $this->faker->dateTime(),
        ];
    }
}
