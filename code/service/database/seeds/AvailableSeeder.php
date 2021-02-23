<?php

use App\Models\Payment;
use Illuminate\Database\Seeder;

class AvaliableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::unguard();
        $this->createAvailable();

    }

    private function createAvailable()
    {
        DB::table('tb_available')->insert([
            'nm_name' => 'Site/App',
            'ts_create' => new \DateTime()
        ]);

        DB::table('tb_available')->insert([
            'nm_name' => 'Loja física',
            'ts_create' => new \DateTime()
        ]);

        DB::table('tb_available')->insert([
            'nm_name' => 'Sócio adimplentes',
            'ts_create' => new \DateTime()
        ]);

        DB::table('tb_available')->insert([
            'nm_name' => 'Planos com fidelidade',
            'ts_create' => new \DateTime()
        ]);

        DB::table('tb_available')->insert([
            'nm_name' => 'Planos sem fidelidade',
            'ts_create' => new \DateTime()
        ]);

        DB::table('tb_available')->insert([
            'nm_name' => 'Site e loja física',
            'ts_create' => new \DateTime()
        ]);
    }

}
