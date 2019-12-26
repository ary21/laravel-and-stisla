<?php

use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $demo = new \App\User;
        $demo->username = "demo";
        $demo->name = "Site Demo";
        $demo->email = "demo@demo.com";
        $demo->roles = json_encode(["ADMIN"]);
        $demo->password = \Hash::make("demo12345");
        $demo->avatar = "";
        $demo->phone = "08123456789";
        $demo->address = "Pekanbaru, Riau";

        $demo->save();
    }
}
