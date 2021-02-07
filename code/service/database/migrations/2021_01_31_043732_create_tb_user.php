<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_user', function (Blueprint $table) {
            $table->bigIncrements('cd_user')->unsigned()->comment('Table key code PK, Identity');
            $table->string('nm_name', 255)->nullable()->comment('Name user');
            $table->string('nm_nickname', 255)->nullable()->comment('Nickname user');
            $table->string('nm_name_dad', 255)->nullable()->comment('User father name');
            $table->string('nm_name_mom', 255)->nullable()->comment('User mother name');
            $table->string('nu_cpf',11)->nullable()->comment('User cpf identity');
            $table->string('nu_home_phone', 30)->nullable()->comment('Home phone number');
            $table->string('nu_business_phone', 30)->nullable()->comment('Business phone number');
            $table->string('nu_cell_phone', 30)->nullable()->comment('Cell phone phone number');
            $table->string('ds_address', 255)->nullable()->comment('User address');
            $table->integer('nu_uf')->nullable()->comment('User UF');
            $table->string('nm_municipality', 255)->nullable()->comment('User municipality');
            $table->string('nm_neighborhood', 255)->nullable()->comment('User neighborhood');
            $table->string('ds_add_address', 255)->nullable()->comment('User add user address');
            $table->string('ar_photo_user', 255)->nullable()->comment('User photo location');
            $table->timestamp('ts_user_birth')->nullable()->comment('User birthday');
            $table->string('ps_password')->nullable()->comment('User password');
            $table->integer('nu_attempts')->nullable()->comment('User number of attempts');
            $table->integer('cd_profile')->nullable()->comment('Identity profile PK');

            $table
                ->foreign('cd_profile', 'fk_user_profile')
                ->references('cd_profile')
                ->on('tb_profile');

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
        Schema::table('tb_user', function(Blueprint $table) {
            $table->dropForeign('fk_user_profile');
        });

        Schema::dropIfExists('tb_user');
    }
}
