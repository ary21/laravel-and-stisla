<?php

use App\Masters;
use Illuminate\Database\Seeder;

class MastersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Masters::insert([
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'value' => 'Walkin', 'extra' => '0', 'type' => 'orderType'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'value' => 'GoFood', 'extra' => '20', 'type' => 'orderType'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'value' => 'GrabFood', 'extra' => '20', 'type' => 'orderType'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'value' => 'Cash', 'extra' => '', 'type' => 'paymentType'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'value' => 'Kredit', 'extra' => '', 'type' => 'paymentType'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'value' => 'Debit', 'extra' => '', 'type' => 'paymentType'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'value' => 'GoPay', 'extra' => '', 'type' => 'paymentType'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'value' => 'Dana', 'extra' => '', 'type' => 'paymentType'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'value' => 'OVO', 'extra' => '', 'type' => 'paymentType'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'value' => 'LinkAja', 'extra' => '', 'type' => 'paymentType'],
            ['created_at' => date('Y-m-d H:i:s'), 'created_by' => '1', 'value' => 'Jenius', 'extra' => '', 'type' => 'paymentType'],
        ]);
    }
}
