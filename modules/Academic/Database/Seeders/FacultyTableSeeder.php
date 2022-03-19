<?php

namespace Modules\Academic\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Academic\Models\Faculty;

class FacultyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $faculties      = [
            [
                'name'      => [
                    'en'    => 'Business Administration and Tourism',
                    'km'    => 'គ្រប់គ្រងពាណិច្ចកម្ម​ និងទេសចរណ៍',
                ],
            ],
            [
                'name'      => [
                    'en'    => 'Science and Technology',
                    'km'    => 'វិទ្យាសាស្រ្ត និងបច្ចេកវិទ្យា',
                ],
            ],
            [
                'name'      => [
                    'en'    => 'Arts, Humanities and Education',
                    'km'    => 'សិល្បៈ មនុស្សសាស្ត្រ និងការអប់រំ',
                ],
            ],
            [
                'name'      => [
                    'en'    => 'Agriculture andd Food Processing',
                    'km'    => 'កសិកម្ម និងកែច្នៃអាហារ',
                ],
            ],
            [
                'name'      => [
                    'en'    => 'Sociology and Community Development',
                    'km'    => 'សង្គមសាស្ត្រ និងអភិវឌ្ឍន៍សហគមន៍',
                ],
            ],
            [
                'name'      => [
                    'en'    => 'Institute of Foreign Languages',
                    'km'    => 'វិទ្យាស្ថានភាសាបរទេស',
                ],
            ],
        ];

        foreach ($faculties as $faculty) :
            Faculty::updateOrCreate(
                [
                    'name->en'  => $faculty['name'][app()->getLocale()],
                ],
                $faculty
            );
        endforeach;
    }
}
