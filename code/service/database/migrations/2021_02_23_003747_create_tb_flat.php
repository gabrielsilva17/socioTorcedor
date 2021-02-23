<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbFlat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_flat', function (Blueprint $table) {
            $table->bigIncrements('cd_flat')->unsigned()->comment('Table key code PK, Identity');
            $table->string('nm_name', 255)->nullable()->comment('Name flat');
            $table->string('vl_monthly_value', 255)->nullable()->comment('Monthy value');
            $table->string('vl_annual_value', 255)->nullable()->comment('Annual value');
            $table->string('ds_description', 255)->comment('Description flat');
            $table->boolean('fl_authenticate_document')->default(0)->comment('Authenticate document');
            $table->integer('cd_available')->comment('Identity avaible PK');
            $table->integer('cd_payment')->comment('Identity payment type PK');
            $table->integer('cd_frequency')->comment('Identity frequency type PK');

            $table
                ->foreign('cd_available', 'fk_flat_available')
                ->references('cd_available')
                ->on('tb_available');

            $table
                ->foreign('cd_payment', 'fk_flat_payment')
                ->references('cd_payment')
                ->on('tb_payment');

            $table
                ->foreign('cd_frequency', 'fk_flat_frequency')
                ->references('cd_frequency')
                ->on('tb_frequency');

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
            $table->dropForeign('fk_flat_frequency');
            $table->dropForeign('fk_flat_payment');
            $table->dropForeign('fk_flat_available');
        });

        Schema::dropIfExists('tb_flat');
    }
}
