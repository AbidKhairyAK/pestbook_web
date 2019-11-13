<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory;

class ConsultationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Factory::create();

        for ($i=1; $i <= 30; $i++) { 
        	$s = rand(0, 1);
	        $data[] = [
        		'user_id' => 1,
        		'type_id' => rand(1, 3),
        		'title' => $faker->sentence().'?',
        		'indication' => $faker->paragraph(),
                'original' => null,
        		'thumbnail' => null,
        		'status' => $s,
        		'answer' => $s ? $faker->paragraph() : null,
                'created_at' => now(),
                'updated_at' => now(),
	        ];
    	}

        DB::table('consultations')->truncate();
        DB::table('consultations')->insert($data);
    }
}
