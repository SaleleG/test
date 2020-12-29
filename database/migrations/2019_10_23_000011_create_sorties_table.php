<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesortiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sorties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->integer('quantite');
            $table->integer('montantv');
			$table->integer('montantp');
            $table->string('datev');
            $table->string('eta');
            $table->integer('client_id')->unsigned();
            $table->integer('article_id')->unsigned();
            $table->integer('agent_id')->unsigned();
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
        Schema::dropIfExists('sorties');
    }
}
