<?php

use App\Models\Payment;
use Illuminate\Database\Seeder;

class FrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::unguard();
        $this->createFrequency();

    }

    private function createFrequency()
    {
        DB::table('tb_frequency')->insert([
            'nm_name' => 'Anual',
            'ts_create' => new \DateTime()
        ]);

        DB::table('tb_frequency')->insert([
            'nm_name' => 'Mensal',
            'ts_create' => new \DateTime()
        ]);

    }

}
