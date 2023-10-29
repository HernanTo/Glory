<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = \App\Models\User::create([
            'cc' => '1022330332',
            'ft_name' => 'Hernán',
            'sc_name' => '',
            'fi_lastname' => 'Torres',
            'sc_lastname' => '',
            'phone_number' => '3132093326',
            'address' => 'Bogotá',
            'email' => 'hernanto.ott@outlook.com',
            'password' => Hash::make('12345678'),
            'pass_change' => '1',
            'profile_photo_path' => 'default.png',
            'is_active' => '1'
        ]);
        $admin->assignRole('Administrador');

        $seller = \App\Models\User::create([
            'cc' => '1020304050',
            'ft_name' => 'Vendedor',
            'sc_name' => '',
            'fi_lastname' => '',
            'sc_lastname' => '',
            'phone_number' => '2',
            'address' => 'Bogotá',
            'password' => Hash::make('1020304050'),
            'pass_change' => '0',
            'profile_photo_path' => 'default.png',
            'is_active' => '1'
        ]);
        $seller->assignRole('Vendedor');

        $ClienteWeb = \App\Models\User::create([
            'cc' => '9080706050',
            'ft_name' => 'Cliente Web',
            'sc_name' => '',
            'fi_lastname' => '',
            'sc_lastname' => '',
            'phone_number' => '3',
            'address' => 'Bogotá',
            'password' => Hash::make('9080706050'),
            'pass_change' => '0',
            'profile_photo_path' => 'default.png',
            'is_active' => '1'
        ]);
        $ClienteWeb->assignRole('Cliente Web');
    }
}
