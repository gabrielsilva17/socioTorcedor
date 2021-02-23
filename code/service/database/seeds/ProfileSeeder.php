<?php

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Profile::unguard();
        $this->createProfile();
    }

    private function createProfile()
    {
        DB::table('tb_profile')->insert([
            'nm_name' => 'Administrador',
            'ds_profile' => 'Perfil com acesso em todas as funcionalidades do sistema.',
            'ts_create' => new \DateTime()
        ]);

        DB::table('tb_profile')->insert([
            'nm_name' => 'Sócio',
            'ds_profile' => 'Perfil com acesso aos dados do Sócio',
            'ts_create' => new \DateTime()
        ]);
    }

}
