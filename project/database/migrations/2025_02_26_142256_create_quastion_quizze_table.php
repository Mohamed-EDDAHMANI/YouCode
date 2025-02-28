<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuastionQuizzeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quastion_quizze', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('quizze_id');
            $table->foreign('quizze_id')->references('id')->on('quizzes')->onDelete('cascade');
            $table->unsignedBigInteger('quastion_id');
            $table->foreign('quastion_id')->references('id')->on('quastions')->onDelete('cascade');
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
        Schema::dropIfExists('quastion_quizze');
    }
}
