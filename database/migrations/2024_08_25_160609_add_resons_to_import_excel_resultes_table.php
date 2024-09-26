<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResonsToImportExcelResultesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('import_excel_resultes', function (Blueprint $table) {
            $table->string('reson_one')->nullable();
            $table->string('reson_tow')->nullable();
            $table->string('reson_th')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('import_excel_resultes', function (Blueprint $table) {
            //
        });
    }
}
