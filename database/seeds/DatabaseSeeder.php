<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypesTableSeeder::class);
        // $this->call(LibrariesTableSeeder::class);
        // $this->call(ImagesTableSeeder::class);
        // $this->call(ConsultationsTableSeeder::class);
    }
}
