<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('12345678'),
            'created_at' => '2022-08-24 17:09:51',
            'updated_at' => '2022-08-24 17:09:51',
            'author' => '1',
            'admin' => '1',

        ]);

        DB::table('teams')->insert([
            'user_id' => 1,
            'name' => 'admins team',
            'personal_team' => 1,
            'created_at' => '2022-08-24 17:09:51',
            'updated_at' => '2022-08-24 17:09:51',
        ]);
    }
}
