<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbUserHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_user_history', function (Blueprint $table) {
            $table->bigIncrements('cd_user_history')->unsigned()->comment('Table key code PK, Identity');
            $table->string('ds_changed_field', 255)->nullable()->comment('Changed field');
            $table->string('vl_new_value', 255)->nullable()->comment('New value changed');
            $table->string('vl_old_value', 255)->nullable()->comment('Old value changed');
            $table->integer('cd_user')->nullable()->comment('Identity user PK');
            $table->integer('cd_author')->nullable()->comment('Identity user author PK');

            $table
                ->foreign('cd_user', 'fk_user_history')
                ->references('cd_user')
                ->on('tb_user');

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
        Schema::table('tb_user_history', function(Blueprint $table) {
            $table->dropForeign('fk_user_history');
            $table->dropForeign('fk_user_history_author');
        });
        Schema::dropIfExists('tb_user_history');
    }
}
