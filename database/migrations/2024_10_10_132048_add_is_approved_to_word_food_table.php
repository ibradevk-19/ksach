<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsApprovedToWordFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('word_food', function (Blueprint $table) {
            $table->integer('is_approved')->default(1);
            $table->integer('form_src')->default(1); //1 main form // 2 actor form // 3 admin form
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
