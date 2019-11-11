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
    	DB::table('users')->truncate();
        DB::table('users')->insert([
        	[
        		'name'		=> 'abid',
        		'email'		=> 'abid@abid',
        		'password'	=> bcrypt('abid'),
        	],
        	[
        		'name'		=> 'admin',
        		'email'		=> 'admin@admin',
        		'password'	=> bcrypt('admin'),
        	],
        ]);
    }
}
