<?php

namespace Modules\Customer\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Models\Customer;

class CustomerDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $customers      = [
        //     [
        //         'title'             => 'Mr.',
        //         'first_name'        => 'Lim',
        //         'middle_name'       => '',
        //         'last_name'         => 'Socheat',
        //         'gender'            => 'M',
        //         'phone'             => '+85599993483',
        //         'phone_verified_at' => now(),
        //         'email'             => 'limsocheat111@gmail.com',
        //         'email_verified_at' => now(),
        //         'password'          => bcrypt('12345678'),
        //     ]
        // ];

        // foreach ($customers as $customer) :
        //     $c  = Customer::updateOrCreate([
        //         'phone' => $customer['phone'],
        //     ], $customer);

        //     $c->settings()->set('locale', 'km');
        // endforeach;

        Customer::factory(10)->create();
    }
}
