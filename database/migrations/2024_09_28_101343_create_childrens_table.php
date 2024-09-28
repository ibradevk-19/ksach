<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChildrensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('childrens', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('beneficial_id')->unsigned();
            $table->string('name');
            $table->string('gender');
            $table->string('identity_number');
            $table->date('birth_date');
            $table->boolean('is_disabled')->default(false);
            $table->boolean('has_chronic_disease')->default(false);
            $table->boolean('war_victim')->default(false);
            $table->boolean('is_orphan')->default(false);
            $table->boolean('is_student')->default(false);
            $table->boolean('is_graduate')->default(false);
            $table->string('educational_qualification');
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
        Schema::dropIfExists('childrens');
    }
}
