<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateentreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entrees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('cod');
            $table->integer('quantite');
            $table->integer('prixa');
            $table->integer('prixp');
            $table->integer('prixae');
			$table->integer('montantp');
            $table->string('dat');
            $table->string('eta');
            $table->integer('fournisseur_id')->unsigned();
            $table->integer('article_id')->unsigned();
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
        Schema::dropIfExists('entrees');
    }
}
