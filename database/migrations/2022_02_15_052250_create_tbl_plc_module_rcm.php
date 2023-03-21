<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPLCModuleRcm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_plc_module_rcm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('status')->default(0)->comment = '1-active,2-Inactive';
            $table->string('fiscal_year')->nullable();
            $table->string('category')->nullable();
            $table->string('control_objective')->nullable();
            $table->longText('risk_summary')->nullable();
            $table->longText('risk_detail')->nullable();
            $table->string('debit')->nullable();
            $table->string('credit')->nullable();
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
        Schema::dropIfExists('tbl_plc_module_rcm');
    }
}
