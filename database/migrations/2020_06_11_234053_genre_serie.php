<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GenreSerie extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('genre_serie', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('genre_id');
            $table->unsignedBigInteger('serie_id');

            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            $table->foreign('serie_id')->references('id')->on('series')->onDelete('cascade');

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
        Schema::dropIfExists('genre_serie');
    }
}
