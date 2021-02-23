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
        $this->call(AvaliableSeeder::class);
        $this->call(FrequencySeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(ProfileSeeder::class);
    }
}
