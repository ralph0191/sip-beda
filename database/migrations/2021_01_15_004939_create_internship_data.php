<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internship_data', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('student_id')->unsigned();
            $table->bigInteger('internship_requirements_id')->unsigned();
            $table->string('file_url')->defaults('');
            $table->string('remarks')->defaults('');
            $table->tinyInteger('status');
            
            $table->foreign('student_id')->references('id')->on('students');
            $table->foreign('internship_requirements_id')->references('id')->on('internship_requirements');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internship_data');
    }
}
