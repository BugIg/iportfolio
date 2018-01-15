<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@iportfolio.guru',
                'password' => 'admin1290',
                'role' => 'admin'
            ],
            [
                'name' => 'Customer',
                'email' => 'customer@iportfolio.guru',
                'password' => 'customer1290',
                'role' => 'customer'
            ],
        ];

        DB::table('users')->insert($users);
    }
}
