<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class seedDb extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'id' => 1,
            'name'  => 'admin',
            'email' => 'example@mail.ru',
            'password' => Hash::make(123456),
            'role' =>  1
        ]]);

        $categories = [
            [
                'id' => 1,
                'name' => 'Котики'
            ],
            [
                'id' => 2,
                'name' => 'Автопроишествия'
            ],
            [
                'id' => 3,
                'name' => 'Детское видео'
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
