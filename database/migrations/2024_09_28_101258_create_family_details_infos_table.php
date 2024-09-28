<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilyDetailsInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('family_details_infos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('beneficial_id')->unsigned();
            $table->integer('male_count');
            $table->integer('female_count');
            $table->integer('children_under_2');
            $table->integer('children_under_3');
            $table->integer('children_5_to_16');
            $table->string('marital_status');
            $table->string('document');
            $table->boolean('is_breadwinner_disabled')->default(false);
            $table->boolean('has_chronic_disease')->default(false);
            $table->boolean('war_victim')->default(false);
            $table->string('income_source');
            $table->decimal('average_income', 10, 2);
            $table->boolean('is_employee')->default(false);
            $table->string('province');
            $table->string('city');
            $table->string('housing_complex');
            $table->string('neighborhood');
            $table->string('street');
            $table->string('nearest_landmark');
            $table->boolean('is_displaced')->default(false);
            $table->boolean('is_owner')->default(false);
            $table->string('housing_type');
            $table->string('housing_condition');
            $table->boolean('war_damage')->default(false);
            $table->string('damage_type');
            $table->string('repair_status');
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
        Schema::dropIfExists('family_details_infos');
    }
}
