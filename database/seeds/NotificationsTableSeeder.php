<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('notifications')->truncate();
        DB::table('notifications')->insert([
            [
                'user_id'   => null,
                'title'     => 'test title general',
                'body'      => 'test body general',
                'type'      => 'general',
                'target'    => null,
                'is_read'   => 1,
            ],
            [
                'user_id'   => null,
                'title'     => 'test title library',
                'body'      => 'test body library',
                'type'      => 'library',
                'target'    => '1',
                'is_read'   => 0,
            ],
            [
                'user_id'   => 1,
                'title'     => 'test title consultation 1',
                'body'      => 'test body consultation 1',
                'type'      => 'general',
                'target'    => '1',
                'is_read'   => 0,
            ],
            [
                'user_id'   => 2,
                'title'     => 'test title consultation 2',
                'body'      => 'test body consultation 2',
                'type'      => 'general',
                'target'    => '2',
                'is_read'   => 0,
            ],
        ]);
    }
}
