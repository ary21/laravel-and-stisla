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
        $this->call(DemoSeeder::class);
        $this->call(ManydemoSeeder::class);
        $this->call(CategoriesSeeder::class);
        $this->call(MastersSeeder::class);
        
        // $this->call(UsersTableSeeder::class);
    }
}
