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
            $table->bigInteger('rcm_id')->unsigned();
            $table->string('category')->nullable();
            $table->string('counter')->nullable();
            $table->string('control_id')->nullable();
            $table->string('key_control')->nullable();
            $table->string('it_control')->nullable();
            $table->string('internal_control')->nullable();
            $table->unsignedTinyInteger('status')->default(0)->comment = '0-Show Internal Controls in SA, 1-Show Internal Control in RCM only';
            $table->string('validity')->nullable();
            $table->string('completeness')->nullable();
            $table->string('accuracy')->nullable();
            $table->string('cut_off')->nullable();
            $table->string('valuation')->nullable();
            $table->string('presentation')->nullable();
            $table->string('preventive')->nullable();
            $table->string('detective')->nullable();
            $table->string('manual')->nullable();
            $table->string('automatic')->nullable();
            $table->string('system')->nullable();
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
