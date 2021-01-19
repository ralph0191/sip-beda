<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipFiles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internship_files', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('internship_data_id')->unsigned();
            $table->string('file_name')->default('');
            $table->string('file_url')->default('');

            $table->foreign('internship_data_id')->references('id')->on('internship_data');
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
        Schema::dropIfExists('internship_files');
    }
}
