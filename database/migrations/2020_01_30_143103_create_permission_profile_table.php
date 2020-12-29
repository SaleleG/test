<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
         Schema::dropIfExists('permission_profile');
        Schema::create('permission_profile', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('profile_id')->unsigned();
   
          /*  $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');*/
    
            $table->primary(['permission_id','profile_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permission_profile_');
    }
}
