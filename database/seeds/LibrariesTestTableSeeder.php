<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibrariesTestTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
        	[
    			'type_id' => 1,
        		'name' => 'ind nama',
    			'description' => 'ind deskripsi',
    			'indication' => 'ind indikasi',
    			'control' => 'ind kontrol',
        		'name_en' => 'en name',
    			'description_en' => 'en description',
    			'indication_en' => 'en indication',
    			'control_en' => 'en control',
                'created_at' => now(),
                'updated_at' => now(),
        	],
        ];

    	DB::table('libraries')->truncate();
    	DB::table('libraries')->insert($data);
    }
}
