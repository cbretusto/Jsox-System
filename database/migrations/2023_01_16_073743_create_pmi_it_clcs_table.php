<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmiItClcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmi_it_clcs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no');
            $table->string('fiscal_year');
            $table->string('control_objectives');
            $table->string('internal_controls');
            $table->unsignedTinyInteger('status')->default(1)->comment = '1-active,2-Inactive';
            $table->unsignedTinyInteger('logdel')->default(0)->comment = '0-show,1-hide';
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
        Schema::dropIfExists('pmi_it_clcs');
    }
}
