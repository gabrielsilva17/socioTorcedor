<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_profile', function (Blueprint $table) {
            $table->bigIncrements('cd_profile')->unsigned()->comment('Table key code PK, Identity');
            $table->string('nm_name', 255)->nullable()->comment('Name profile');
            $table->string('ds_profile', 255)->nullable()->comment('Description profile');
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
        Schema::dropIfExists('tb_profile');
    }
}
