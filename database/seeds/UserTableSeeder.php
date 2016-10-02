<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'birthday' => Carbon\Carbon::createFromFormat('d/m/Y', '22/11/1994'),
            'role'	=> 'admin',
            'email' => 'setkyar16@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
