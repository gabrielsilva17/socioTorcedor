<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTwisted extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_twisted', function (Blueprint $table) {
            $table->bigIncrements('cd_twisted')->unsigned()->comment('Table key code PK, Identity');
            $table->string('nm_twisted', 255)->nullable()->comment('Name twisted');
            $table->integer('cd_club')->nullable()->comment('Identity club PK');
            $table->integer('cd_user_director')->nullable()->comment('Identity user director PK');

            $table
                ->foreign('cd_club', 'fk_club_twisted')
                ->references('cd_club')
                ->on('tb_club');

            $table
                ->foreign('cd_user_director', 'fk_user_twisted')
                ->references('cd_user')
                ->on('tb_user');

            $table->timestamp('ts_foundation')->nullable()->comment('Date foundation');
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
        Schema::table('tb_twisted', function(Blueprint $table) {
            $table->dropForeign('fk_club_twisted');
            $table->dropForeign('fk_user_twisted');
        });
        Schema::dropIfExists('tb_twisted');
    }
}
