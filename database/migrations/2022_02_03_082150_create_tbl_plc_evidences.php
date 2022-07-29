<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblPlcEvidences extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_plc_evidences', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('year');
            $table->String('fiscal_year');
            $table->String('plc_category');
            $table->String('plc_evidences');
            $table->String('date_uploaded');
            $table->String('uploaded_by');
            $table->integer('status');
            $table->String('revised_by');
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
        Schema::dropIfExists('tbl_plc_evidences');
    }
}
