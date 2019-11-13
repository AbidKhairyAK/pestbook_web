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
                'email'     => 'abid@abid',
        		'phone'		=> '08233748234',
        		'password'	=> bcrypt('abid'),
        	],
        	[
        		'name'		=> 'admin',
        		'email'		=> 'admin@admin',
                'phone'     => '08123743823',
        		'password'	=> bcrypt('admin'),
        	],
        ]);
    }
}
