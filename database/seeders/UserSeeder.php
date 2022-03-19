<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Create Lim Socheat Account
         * 
         * @var User $user
         */
        $administrator              = User::updateOrCreate(
            [
                'email'             => 'limsocheat111@gmail.com',
            ],
            [
                'name'              => 'Lim Socheat',
                'password'          => bcrypt('12345678'),
                'email_verified_at' => now(),
            ]
        );

        $administrator->assignRole(Role::ADMINISTRATOR);
    }
}
