<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSokanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::create('sokan', function (Blueprint $table) {
        //     $table->string('full_name', 40);
        //     $table->string('id_number', 10)->nullable()->index();
        //     $table->string('first_name', 20);
        //     $table->string('s_name', 20)->nullable();
        //     $table->string('th_name', 20)->nullable();
        //     $table->string('fo_name', 20);
        //     $table->string('mather_name', 30)->nullable();
        //     $table->string('adress', 20)->nullable();
        //     $table->string('dob', 10)->nullable();
        //     $table->string('gender', 10);

        //     // Fulltext index for 'full_name'
        //     $table->fullText('full_name');

        //     // Set the table engine and charset
        //     $table->engine = 'InnoDB';
        //     $table->charset = 'utf8mb4';
        //     $table->collation = 'utf8mb4_0900_ai_ci';
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sokan');
    }
}
