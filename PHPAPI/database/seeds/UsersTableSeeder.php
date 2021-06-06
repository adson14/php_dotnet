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
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            ],
            [
                'email'    => 'user@company2.com',
                'name'     => 'First Name 2',
                'surname'     => 'Last name 2',                
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
            ],
        ];

        User::query()->insert($users);
    }
}
