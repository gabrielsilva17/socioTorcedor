<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbClubHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_club_history', function (Blueprint $table) {
            $table->bigIncrements('cd_club_history')->unsigned()->comment('Table key code PK, Identity');
            $table->string('ds_changed_field', 255)->nullable()->comment('Changed field');
            $table->string('vl_new_value', 255)->nullable()->comment('New value changed');
            $table->string('vl_old_value', 255)->nullable()->comment('Old value changed');
            $table->integer('cd_club')->nullable()->comment('Identity club PK');
            $table->integer('cd_author')->nullable()->comment('Identity user author PK');

            $table
                ->foreign('cd_club', 'fk_club_history')
                ->references('cd_club')
                ->on('tb_club');

            $table
                ->foreign('cd_author', 'fk_user_history_author')
                ->references('cd_user')
                ->on('tb_user');

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
            $table->dropForeign('fk_club_history');
            $table->dropForeign('fk_user_history_author');
        });
        Schema::dropIfExists('tb_club_history');
    }
}
