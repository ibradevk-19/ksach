<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWordFoodTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('word_food', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->integer('id_num')->nullable();;
            $table->string('wife_name')->nullable();;
            $table->integer('wife_id_num')->nullable();;
            $table->integer('family_count')->nullable();;
            $table->integer('marital_status')->nullable();;
            $table->string('mobile')->nullable();;
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('word_food');
    }
}
