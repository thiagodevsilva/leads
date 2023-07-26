<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@lds.com',
                'password' => Hash::make('12345678'),
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'João Maria',
                'email' => 'joao@lds.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
            ],
            [
                'id' => 3,
                'name' => 'Maria João',
                'email' => 'maria@lds.com',
                'password' => Hash::make('12345678'),
                'role' => 'user',
            ],
        ]);
    }
}
