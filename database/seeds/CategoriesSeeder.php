<?php

use App\Categories;
use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categories::insert([
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'name' => 'Makanan'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'name' => 'Minuman'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'name' => 'Juice'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'name' => 'Nasi Rawon'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'name' => 'Ayam Tulang Lunak'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'name' => 'Mixball'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'name' => 'Ala Carte'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'name' => 'Paket Hemat'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'name' => 'Paket Frozen'],
        ]);
    }
}
