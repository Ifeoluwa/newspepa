<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
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
           'username' => 'iconway',
            'email_address' => 'newspepa@iconwaymedia.com',
            'password' => bcrypt('P@55w0rd'),
            'user_type' => 1
        ]);
    }
}
