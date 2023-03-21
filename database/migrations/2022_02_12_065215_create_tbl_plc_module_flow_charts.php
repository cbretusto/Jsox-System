<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPLCModuleFlowCharts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_plc_module_flow_charts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('rev_history_id')->unsigned();
            $table->unsignedTinyInteger('flow_chart_status')->default(0)->comment = '1-active,2-Inactive';
            $table->string('category')->nullable();
            $table->string('flow_chart')->nullable();
            $table->string('process_owner')->nullable();
            $table->string('revision_date')->nullable();
            $table->string('no_revision')->nullable();
            $table->string('version_no')->nullable();
            $table->string('date_uploaded')->nullable();
            $table->string('uploaded_by')->nullable();
            $table->unsignedTinyInteger('logdel')->default(0)->comment = '0-show,1-hide';
            $table->timestamps();
            
            $table->foreign('rev_history_id')->references('id')->on('tbl_plc_modules');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_plc_module_flow_charts');
    }
}
