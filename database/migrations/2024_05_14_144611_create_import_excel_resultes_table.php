<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportExcelResultesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_excel_resultes', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->integer('id_num');
            $table->string('wife_name');
            $table->integer('wife_id_num');
            $table->integer('family_count');
            $table->integer('marital_status');
            $table->string('mobile');
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
        Schema::dropIfExists('import_excel_resultes');
    }
}
