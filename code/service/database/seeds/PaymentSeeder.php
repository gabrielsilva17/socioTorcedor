<?php

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::unguard();
        $this->createPayment();

    }

    private function createPayment()
    {
        DB::table('tb_payment')->insert([
            'nm_name' => 'Boleto',
            'ts_create' => new \DateTime()
        ]);

        DB::table('tb_payment')->insert([
            'nm_name' => 'Cartão de Crédito',
            'ts_create' => new \DateTime()
        ]);

    }

}
