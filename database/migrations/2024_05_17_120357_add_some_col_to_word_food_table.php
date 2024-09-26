<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeColToWordFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('word_food', function (Blueprint $table) {
            $table->bigInteger('family_id')->nullable()->unsigned();
            $table->foreign('family_id')
                ->references('id')->on('families');

            $table->bigInteger('actor_id')->nullable()->unsigned();
            $table->foreign('actor_id')
                ->references('id')->on('actors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('word_food', function (Blueprint $table) {
            //
        });
    }
}
