<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbClub extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_club', function (Blueprint $table) {
            $table->bigIncrements('cd_club')->unsigned()->comment('Table key code PK, Identity');
            $table->string('nm_social_reason', 255)->nullable()->comment('Social resason');
            $table->string('nm_fantasy', 255)->nullable()->comment('Name Fantasy');
            $table->integer('nu_cnpj')->nullable()->comment('Club cnpj identity');
            $table->integer('nu_cpf_responsible')->nullable()->comment('Responsible person cpf identity');
            $table->string('nm_responsible_person', 255)->nullable()->comment('Club responsible person name');
            $table->string('nu_business_phone', 30)->nullable()->comment('Club Business phone number');
            $table->string('nu_cell_phone', 30)->nullable()->comment('Club Cell phone phone number');
            $table->string('ds_address', 255)->nullable()->comment('Club address');
            $table->integer('nu_uf')->nullable()->comment('Club UF');
            $table->string('nm_municipality', 255)->nullable()->comment('Club municipality');
            $table->string('nm_neighborhood', 255)->nullable()->comment('Club neighborhood');
            $table->string('ds_add_address', 255)->nullable()->comment('Club add user address');
            $table->timestamp('ts_user_birth')->nullable()->comment('Club birthday');
            $table->integer('nu_attempts')->nullable()->comment('Club number of attempts');
            $table->timestamp('ts_create')->comment('Record creation date');
            $table->timestamp('ts_update')->nullable()->comment('Record update date');
            $table->softDeletes('ts_removed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_club');
    }
}
