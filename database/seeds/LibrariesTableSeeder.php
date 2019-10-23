<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LibrariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$names = ['kutu putih', 'ulat grayak', 'layu fusarium', 'bercak daun', 'overwatering', 'kurang nutrisi'];

    	foreach ($names as $key => $value) {
    		if ($key<=1) { $type=1; }
    		elseif ($key<=3) { $type=2; }
    		elseif ($key<=5) { $type=3; }
    		
    		$data[] = [
    			'name' => $value,
    			'type_id' => $type,
    			'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse laoreet vel enim tristique vestibulum. Quisque eget pulvinar metus, vitae faucibus diam. Cras at tempus ante, in dictum odio.',
    			'indication' => 'Curabitur diam nunc, sagittis vitae lorem dictum, ultrices finibus leo. Fusce vulputate ante vel magna volutpat consectetur. Donec nec vehicula enim, eget auctor lectus. Maecenas lacinia vel nisl eu rutrum.',
    			'control' => 'In eget lorem ac ligula lacinia aliquet a eget augue. Maecenas elementum elit pretium luctus tincidunt. Praesent iaculis dui tellus, non euismod ligula dignissim in. Duis non tincidunt purus. Curabitur vitae ornare massa. Curabitur elementum ligula ac sodales semper.',
                'created_at' => now(),
                'updated_at' => now(),
    		];
    	}

    	DB::table('libraries')->truncate();
    	DB::table('libraries')->insert($data);
    }
}
