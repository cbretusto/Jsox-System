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
            $table->string('rcm_internal_control_counter')->nullable();
            $table->string('category')->nullable();
            $table->string('prepared_by')->nullable();
            $table->string('approved_by')->nullable();
            $table->string('issued_date')->nullable();
            $table->string('due_date')->nullable();
            $table->string('second_half_prepared_by')->nullable();
            $table->string('second_half_approved_by')->nullable();
            $table->string('second_half_issued_date')->nullable();
            $table->string('second_half_due_date')->nullable();
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
