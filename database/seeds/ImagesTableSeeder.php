<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	for ($i=1; $i <= 12; $i++) { 
	        $data[] = [
        		'library_id' => ceil($i/2),
                'original' => $i.'.jpg',
        		'thumbnail' => $i.'.jpg',
	        ];
    	}

        DB::table('images')->truncate();
        // DB::table('images')->insert($data);
    }
}
