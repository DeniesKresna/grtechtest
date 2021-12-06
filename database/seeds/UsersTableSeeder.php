<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'name' => "Admin",
                'email' => 'admin@grtech.com.my',
                'password' => bcrypt('password'),
            ],[
                'name' => "User",
                'email' => 'user@grtech.com.my',
                'password' => bcrypt('password'),
            ]
        ]);
    }
}
