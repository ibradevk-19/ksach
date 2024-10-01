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
            $table->integer('male_count')->nullable();
            $table->integer('female_count')->nullable();
            $table->integer('children_under_2')->nullable();
            $table->integer('children_under_3')->nullable();
            $table->integer('children_5_to_16')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('document')->nullable();
            $table->boolean('is_breadwinner_disabled')->default(false);
            $table->boolean('has_chronic_disease')->default(false);
            $table->boolean('war_victim')->default(false);
            $table->string('income_source')->nullable();
            $table->decimal('average_income', 10, 2)->nullable();
            $table->boolean('is_employee')->default(false);
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('housing_complex')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('street')->nullable();
            $table->string('nearest_landmark')->nullable();
            $table->boolean('is_displaced')->default(false);
            $table->boolean('is_owner')->default(false);
            $table->string('housing_type')->nullable();
            $table->string('housing_condition')->nullable();
            $table->boolean('war_damage')->default(false);
            $table->string('damage_type')->nullable();
            $table->string('repair_status')->nullable();
            $table->boolean('has_disability')->default(false);
            $table->string('disability_type')->default(false);
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
