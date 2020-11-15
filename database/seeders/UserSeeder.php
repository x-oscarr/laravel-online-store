<?php

namespace Database\Seeders;

use App\Models\User;
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
        $users = array_map(function ($item) {
            $item['password'] = Hash::make($item['password']);
            return $item;
        },self::USERS);
        User::insert($users);
    }

    private const USERS = [
        [
            'name' => 'Ivan Medichenko',
            'email' => 'oscarrweb@gmail.com',
            'phone_number' => '380993418747',
            'password' => 'nasya_homak',
            'role' => User::ROLE_ADMIN,
            'rating' => 100,
        ],
        [
            'name' => 'Admin',
            'email' => 'admin@root7.ru',
            'phone_number' => '38099999999',
            'password' => 'qazwsxedc123admin',
            'role' => User::ROLE_ADMIN,
            'rating' => 100,
        ],
        [
            'name' => 'Manager',
            'email' => 'manager@root7.ru',
            'phone_number' => '38099999998',
            'password' => 'qazwsxedc123manager',
            'role' => User::ROLE_MANAGER,
            'rating' => 90,
        ]
    ];
}
