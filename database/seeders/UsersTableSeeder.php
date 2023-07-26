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
                'name' => 'João Maria',
                'email' => 'joao@lds.com',
                'password' => Hash::make('123456'),
            ],
            [
                'name' => 'Maria João',
                'email' => 'maria@lds.com',
                'password' => Hash::make('123456'),
            ],
        ]);
    }
}
