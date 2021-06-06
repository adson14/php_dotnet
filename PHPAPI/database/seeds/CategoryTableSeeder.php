<?php

use App\User;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userId = 7;
        
        $roles = [
            [
                'name' => 'user',
                'type' => 'despesa',
                'user_id' => $userId,
            ],
            [
                'name' => 'user2',
                'type' => 'despesa',
                'user_id' => $userId,
            ],
            [
                'name' => 'user3',
                'type' => 'despesa',
                'user_id' => $userId,
            ],
        ];

        \App\Models\Category::query()->insert($roles);
    }
}
