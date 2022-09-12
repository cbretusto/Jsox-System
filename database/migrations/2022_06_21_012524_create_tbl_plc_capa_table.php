<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPlcCapaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_plc_capa', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('sa_id')->unsigned();
            $table->bigInteger('rcm_id')->unsigned();
            $table->longText('analysis');
            $table->string('in_charge');
            $table->string('prepared_by');
            $table->string('approved_by');
            $table->string('issued_date');
            $table->string('due_date');
            $table->string('commitment_date');
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
        Schema::dropIfExists('tbl_plc_capa');
    }
}
