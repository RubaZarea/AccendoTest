<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmittedHomeworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_homework', function (Blueprint $table) {
           $table->id();
           $table->bigInteger('homework_id')->unsigned();
           $table->foreign('homework_id')
                  ->references('id')
                  ->on('homework')
                  ->onDelete('cascade');
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');
            $table->string('solution_file');
            $table->boolean('is_marked');
            $table->integer('mark')->nullable();
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
        Schema::dropIfExists('submitted_homework');
    }
}
