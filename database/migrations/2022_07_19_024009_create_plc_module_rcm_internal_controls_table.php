<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlcModuleRcmInternalControlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plc_module_rcm_internal_controls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('rcm_id');
            $table->string('category')->nullable();
            $table->string('counter')->nullable();
            $table->string('internal_control')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->comment = '0-Show Internal Controls in SA, 1-Show Internal Control in RCM only';
            $table->unsignedTinyInteger('logdel')->default(0)->comment = '0-show,1-hide';
            $table->timestamps();

            $table->foreign('rcm_id')->references('id')->on('tbl_plc_module_rcm');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plc_module_rcm_internal_controls');
    }
}
