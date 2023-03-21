<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_managements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rapidx_name')->nullable();
            $table->string('username')->nullable();
            $table->string('email')->nullable();
            $table->string('department')->nullable();
            $table->unsignedTinyInteger('status')->default(1)->comment = '1-active, 2-inactive';
            $table->bigInteger('user_level_id')->unsigned()->comment = '1-user, 2-admin, 3-super admin';
            $table->unsignedTinyInteger('logdel')->default(0)->comment = '0-show, 1-hide';
            $table->timestamps();
            
            // Foreign Key
            $table->foreign('user_level_id')->references('id')->on('user_levels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_managements');
    }
}
