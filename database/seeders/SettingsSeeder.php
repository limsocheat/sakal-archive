<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        setting()->set([
            'general'       => [
                'app_name'  => 'Laravel',
            ],
            'mail'          => [
                'mailer'        => env('MAIL_MAILER', 'smtp'),
                'host'          => env('MAIL_HOST', 'smtp.mailtrap.io'),
                'port'          => env('MAIL_PORT', 2525),
                'username'      => env('MAIL_USERNAME', 'username'),
                'password'      => env('MAIL_PASSWORD', 'password'),
                'encryption'    => env('MAIL_ENCRYPTION', 'tls'),
                'from_address'  => env('MAIL_FROM_ADDRESS', ''),
                'from_name'     => env('MAIL_FROM_NAME', ''),
            ]
        ]);
        setting()->save();
    }
}
