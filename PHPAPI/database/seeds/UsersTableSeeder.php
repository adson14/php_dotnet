<?php

use App\Models\Category;
use App\User;
use Illuminate\Database\Seeder;

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
                'email'    => 'user@company.com',
                'name'     => 'user',
                'surname'     => 'Last name',
                'password' => env('KEY_USER_TEST'),
            ],
            [
                'email'    => 'user@company2.com',
                'name'     => 'First Name 2',
                'surname'     => 'Last name 2',
                'password' => env('KEY_USER_TEST'),
            ],
        ];

        User::query()->insert($users);
    }
}
