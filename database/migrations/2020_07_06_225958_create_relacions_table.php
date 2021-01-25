<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('type');
            $table->integer('Stype');
            $table->longText('name');
            $table->longText('slug');
            $table->longText('picture');
            $table->date('published');

            $table->unsignedBigInteger('serie_id');
            $table->foreign('serie_id')->references('id')->on('series')->onDelete('cascade');

            $table->unsignedBigInteger('relacion_id');
            $table->foreign('relacion_id')->references('id')->on('series')->onDelete('cascade');


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
        Schema::dropIfExists('relacions');
    }
}
