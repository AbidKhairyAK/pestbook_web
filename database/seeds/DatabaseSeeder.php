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
        $this->call(UsersTableSeeder::class);
        $this->call(LibrariesTestTableSeeder::class);
        // $this->call(ConsultationsTableSeeder::class);
        // $this->call(NotificationsTableSeeder::class);
        // $this->call(LibrariesTableSeeder::class);
        // $this->call(ImagesTableSeeder::class);
    }
}
